<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Order;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\Rma\GetAllReturnsHandler;
use BolCom\RetailerApi\Model\Rma\Query\GetAllReturns;
use BolCom\RetailerApi\Model\Shipment\FulfilmentMethod;

class GetAllReturnsHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke(): void
    {
        $handler = new GetAllReturnsHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, 'https://api.bol.com/retailer-demo/'))
        );

        $handler(GetAllReturns::with(1, false, FulfilmentMethod::FBR()));
    }
}
