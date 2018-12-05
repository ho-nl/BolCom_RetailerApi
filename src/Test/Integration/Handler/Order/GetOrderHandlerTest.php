<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Handler\Order\GetOrderHandler;
use BolCom\RetailerApi\Model\Order\OrderId;
use BolCom\RetailerApi\Model\Order\Query\GetOrder;

class GetOrderHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke()
    {
        $handler = new GetOrderHandler(
            new Client(BOL_CLIENT_ID, BOL_CLIENT_SECRET, null, __DIR__ . '/../token.json')
        );

        $handler(GetOrder::with(OrderId::fromString('7616222250')));
        sleep(8); // Prevent: 429 Too many requests.
    }
}
