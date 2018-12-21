<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Order;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\Order\ShipOrderItemHandler;
use BolCom\RetailerApi\Model\Order\Command\ShipOrderItem;
use BolCom\RetailerApi\Model\Order\OrderItemId;
use BolCom\RetailerApi\Model\Transport\TransportInstruction;

class ShipOrderItemHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke(): void
    {
        $handler = new ShipOrderItemHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, 'https://api.bol.com/retailer-demo/'))
        );

        // @todo; Conflicting transport method: Either provide Transport or ShippingLabelCode.
        // Add checks when buying ShippingLabelCode is being implemented.
        $handler(ShipOrderItem::with(
            OrderItemId::fromString('6107434013'),
            'Shipment Reference',
            null,
            TransportInstruction::fromArray([
                'transporterCode' => 'TNT',
                'trackAndTrace' => '123456789'
            ])
        ));
    }
}
