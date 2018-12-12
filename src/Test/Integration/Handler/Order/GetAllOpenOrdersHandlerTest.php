<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Order;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\Order\GetAllOpenOrdersHandler;
use BolCom\RetailerApi\Model\Order\Query\GetAllOpenOrders;
use BolCom\RetailerApi\Model\Shipment\FulfilmentMethod;

class GetAllOpenOrdersHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke(): void
    {
        $handler = new GetAllOpenOrdersHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, 'https://api.bol.com/retailer-demo/'))
        );

        $handler(GetAllOpenOrders::with(1, FulfilmentMethod::FBR()));
        sleep(1); // Prevent: 429 Too many requests.
    }
}
