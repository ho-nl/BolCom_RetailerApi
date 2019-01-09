<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\ProcessStatus;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\ProcessStatus\GetStatusByProcessIdHandler;
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByProcessId;

class GetStatusByProcessIdHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke(): void
    {
        $this->markTestSkipped('Unable to fetch Process Status, contacted bol.com about this issue.');

        $handler = new GetStatusByProcessIdHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, 'https://api.bol.com/retailer-demo/'))
        );

        $handler(GetStatusByProcessId::with(6107432387));
    }
}
