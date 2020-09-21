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
    /** @var \BolCom\RetailerApi\Infrastructure\MessageBus $messageBus */
    private $messageBus;

    protected function setUp()
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, true));
        $this->messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);
    }

    public function testTransportInstruction()
    {
        $this->messageBus->dispatch(ShipOrderItem::with(
            OrderItemId::fromString('6107434013'),
            'Shipment Reference',
            TransportInstruction::fromArray([
                'transporterCode' => 'TNT',
                'trackAndTrace' => '123456789'
            ])
        ));
    }

    public function testTransportInstructionWithoutTrackAndTrace()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->messageBus->dispatch(ShipOrderItem::with(
            OrderItemId::fromString('6107434013'),
            'Shipment Reference',
            TransportInstruction::fromArray([
                'transporterCode' => 'TNT'
            ])
        ));
    }
}
