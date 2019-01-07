<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Order;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\Rma\HandleReturnHandler;
use BolCom\RetailerApi\Model\Rma\Command\HandleReturn;
use BolCom\RetailerApi\Model\Rma\HandlingResult;
use BolCom\RetailerApi\Model\Rma\QuantityReturned;
use BolCom\RetailerApi\Model\Rma\RmaId;

class HandleReturnHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke(): void
    {
        $handler = new HandleReturnHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, 'https://api.bol.com/retailer-demo/'))
        );

        $handler(HandleReturn::with(
            RmaId::fromScalar(31234567),
            HandlingResult::RETURN_RECEIVED(),
            QuantityReturned::fromScalar(1)
        ));
    }
}
