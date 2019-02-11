<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Order;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Order\Command\ShipOrderItem;
use BolCom\RetailerApi\Model\Order\OrderItemId;
use BolCom\RetailerApi\Model\Transport\TransportInstruction;

class ShipOrderItemHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function testTransportInstruction()
    {
        $clientPool = ClientPool::configure(new ClientConfig(
            BOL_CLIENT_ID,
            BOL_CLIENT_SECRET,
            'https://api.bol.com/retailer-demo/'
        ));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $messageBus->dispatch(ShipOrderItem::with(
            OrderItemId::fromString('6107434013'),
            'Shipment Reference',
            null,
            TransportInstruction::fromArray([
                'transporterCode' => 'TNT',
                'trackAndTrace' => '123456789'
            ])
        ));
    }

    public function testTransportInstructionWithoutTrackAndTrace()
    {
        $clientPool = ClientPool::configure(new ClientConfig(
            BOL_CLIENT_ID,
            BOL_CLIENT_SECRET,
            'https://api.bol.com/retailer-demo/'
        ));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $this->expectException(\InvalidArgumentException::class);
        $messageBus->dispatch(ShipOrderItem::with(
            OrderItemId::fromString('6107434013'),
            'Shipment Reference',
            null,
            TransportInstruction::fromArray([
                'transporterCode' => 'TNT'
            ])
        ));
    }

    public function testShippingLabelCode()
    {
        $clientPool = ClientPool::configure(new ClientConfig(
            BOL_CLIENT_ID,
            BOL_CLIENT_SECRET,
            'https://api.bol.com/retailer-demo/'
        ));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $messageBus->dispatch(ShipOrderItem::with(
            OrderItemId::fromString('6107434013'),
            'Shipment Reference',
            'PLR00000002',
            null
        ));
    }

    public function testShippingLabelCodeAndTransportInstruction()
    {
        $clientPool = ClientPool::configure(new ClientConfig(
            BOL_CLIENT_ID,
            BOL_CLIENT_SECRET,
            'https://api.bol.com/retailer-demo/'
        ));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $this->expectException(\RuntimeException::class);
        $messageBus->dispatch(ShipOrderItem::with(
            OrderItemId::fromString('6107434013'),
            'Shipment Reference',
            'PLR00000002',
            TransportInstruction::fromArray([
                'transporterCode' => 'TNT',
                'trackAndTrace' => '123456789'
            ])
        ));
    }
}
