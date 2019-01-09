<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\ProcessStatus;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\ProcessStatus\GetStatusByEntityHandler;
use BolCom\RetailerApi\Model\ProcessStatus\EntityId;
use BolCom\RetailerApi\Model\ProcessStatus\EventType;
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByEntity;

class GetStatusByEntityHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke(): void
    {
        $this->markTestSkipped('Unable to fetch Process Status, contacted bol.com about this issue.');

        $handler = new GetStatusByEntityHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, 'https://api.bol.com/retailer-demo/'))
        );

        $handler(GetStatusByEntity::with(
            EntityId::fromString('6107432387'),
            EventType::fromValue('CANCEL_ORDER'),
            1
        ));
    }
}
