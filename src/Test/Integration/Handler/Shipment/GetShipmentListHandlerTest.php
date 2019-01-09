<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Shipment;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\Shipment\GetShipmentListHandler;
use BolCom\RetailerApi\Model\Order\OrderId;
use BolCom\RetailerApi\Model\Shipment\FulfilmentMethod;
use BolCom\RetailerApi\Model\Shipment\Query\GetShipmentList;

class GetShipmentListHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke(): void
    {
        $this->markTestSkipped('Unable to fetch shipments, contacted bol.com about this issue.');

        $handler = new GetShipmentListHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, 'https://api.bol.com/retailer-demo/'))
        );

        $handler(GetShipmentList::with(1, FulfilmentMethod::FBR(), OrderId::fromString('7616222250')));
    }
}
