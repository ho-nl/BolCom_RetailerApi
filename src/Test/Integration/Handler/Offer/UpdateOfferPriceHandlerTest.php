<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Offer;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Offer\Command\UpdateOfferPrice;
use BolCom\RetailerApi\Model\Offer\OfferId;
use BolCom\RetailerApi\Model\Offer\Pricing;

class UpdateOfferPriceHandlerTest extends \PHPUnit\Framework\TestCase
{
    /** @var \BolCom\RetailerApi\Infrastructure\MessageBus $messageBus */
    private $messageBus;

    protected function setUp(): void
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, true));
        $this->messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);
    }

    public function testPriceWithinBoundry()
    {
        $this->messageBus->dispatch(UpdateOfferPrice::with(
            OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5'),
            Pricing::fromArray([
                'bundlePrices' => [
                    ['quantity' => 1, 'unitPrice' => 12],
                    ['quantity' => 10, 'unitPrice' => 1]
                ]
            ])
        ));
    }

    public function testPriceOufOfBoundry()
    {
        $this->expectException(\Assert\InvalidArgumentException::class);
        $this->messageBus->dispatch(UpdateOfferPrice::with(
            OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5'),
            Pricing::fromArray([
                'bundlePrices' => [
                    ['quantity' => 1, 'unitPrice' => 99999]
                ]
            ])
        ));
    }
}
