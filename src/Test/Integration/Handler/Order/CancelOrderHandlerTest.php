<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Order;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Order\CancellationReason;
use BolCom\RetailerApi\Model\Order\Command\CancelOrder;
use BolCom\RetailerApi\Model\Order\OrderItemId;

class CancelOrderHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke()
    {
        $clientPool = ClientPool::configure(new ClientConfig(
            BOL_CLIENT_ID,
            BOL_CLIENT_SECRET,
            'https://api.bol.com/retailer-demo/'
        ));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $messageBus->dispatch(CancelOrder::with(
            OrderItemId::fromString('6107434013'),
            CancellationReason::REQUESTED_BY_CUSTOMER()
        ));
    }
}
