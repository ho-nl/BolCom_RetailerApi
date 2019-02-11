<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Order;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Order\OrderId;
use BolCom\RetailerApi\Model\Order\Query\GetOrder;

class GetOrderHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke()
    {
        $clientPool = ClientPool::configure(new ClientConfig(
            BOL_CLIENT_ID,
            BOL_CLIENT_SECRET,
            'https://api.bol.com/retailer-demo/'
        ));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $messageBus->dispatch(GetOrder::with(OrderId::fromString('7616222250')));
    }
}
