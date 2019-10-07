<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Offer;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Offer\Command\UpdateOffer;
use BolCom\RetailerApi\Model\Offer\DeliveryCode;
use BolCom\RetailerApi\Model\Offer\OfferId;
use BolCom\RetailerApi\Model\Offer\RetailerOfferUpdate;
use BolCom\RetailerApi\Model\Offer\FulfilmentMethod;

class UpdateOfferHandlerTest extends \PHPUnit\Framework\TestCase
{
    /** @var \BolCom\RetailerApi\Infrastructure\MessageBus $messageBus */
    private $messageBus;

    protected function setUp()
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, true));
        $this->messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);
    }

    public function test__invoke()
    {
        $this->messageBus->dispatch(UpdateOffer::with(
            OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5'),
            RetailerOfferUpdate::fromArray([
                'referenceCode' => 'SKU123',
                'onHoldByRetailer' => false,
                'unknownProductTitle' => 'My Title',
                'fulfilment' => [
                    'type' => FulfilmentMethod::FBR,
                    'deliveryCode' => DeliveryCode::DC12d
                ]
            ])
        ));
    }

    public function testUpdateNewOfferWithFBBAndDelivery()
    {
        $this->expectException(\RuntimeException::class);
        $this->messageBus->dispatch(UpdateOffer::with(
            OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5'),
            RetailerOfferUpdate::fromArray([
                'referenceCode' => 'SKU123',
                'onHoldByRetailer' => false,
                'unknownProductTitle' => 'My Title',
                'fulfilment' => [
                    'type' => FulfilmentMethod::FBB,
                    'deliveryCode' => DeliveryCode::DC12d
                ]
            ])
        ));
    }
}
