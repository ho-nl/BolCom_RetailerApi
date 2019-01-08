<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\ShippingLabel;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\ShippingLabel\GetShippingLabelsHandler;
use BolCom\RetailerApi\Model\Order\OrderItemId;
use BolCom\RetailerApi\Model\ShippingLabel\Query\GetShippingLabels;

class GetShippingLabelsTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke(): void
    {
        $this->markTestSkipped('Unable to fetch shipping labels, contacted bol.com about this issue.');

        $handler = new GetShippingLabelsHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, 'https://api.bol.com/retailer-demo/'))
        );

        $handler(GetShippingLabels::with(OrderItemId::fromString('6107434013')));
    }
}
