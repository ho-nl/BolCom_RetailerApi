<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Offer;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Offer\Command\UpdateOfferStock;
use BolCom\RetailerApi\Model\Offer\OfferId;
use BolCom\RetailerApi\Model\Offer\Stock;

class UpdateOfferStockHandlerTest extends \PHPUnit\Framework\TestCase
{
    /** @var \BolCom\RetailerApi\Infrastructure\MessageBus $messageBus */
    private $messageBus;

    protected function setUp(): void
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, true));
        $this->messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);
    }

    public function test__invoke()
    {
        $this->messageBus->dispatch(UpdateOfferStock::with(
            OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5'),
            Stock::fromArray([
                'amount' => 97,
                'managedByRetailer' => false
            ])
        ));
    }
}
