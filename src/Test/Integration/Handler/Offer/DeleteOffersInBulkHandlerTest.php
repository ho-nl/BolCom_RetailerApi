<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\Offer\DeleteOffersInBulkHandler;
use BolCom\RetailerApi\Model\Offer\Command\DeleteOffersInBulk;
use BolCom\RetailerApi\Model\Offer\Condition;
use BolCom\RetailerApi\Model\Offer\RetailerOfferIdentifier;

class DeleteOffersInBulkHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke()
    {
        $handler = new DeleteOffersInBulkHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET))
        );

        $handler(DeleteOffersInBulk::with(
            RetailerOfferIdentifier::fromArray([
                'ean' => '9781785882364',
                'condition' => Condition::IS_NEW
            ])
        ));
    }
}
