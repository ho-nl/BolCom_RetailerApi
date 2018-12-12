<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Handler\Offer\GenerateOfferCsvHandler;
use BolCom\RetailerApi\Model\Offer\Command\GenerateOfferCvs;
use BolCom\RetailerApi\Model\Offer\PublishStatus;

class GenerateOfferCsvHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke()
    {
        $handler = new GenerateOfferCsvHandler(
            new Client(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET))
        );

        $handler(GenerateOfferCvs::with(
            PublishStatus::PUBLISHED()
        ));
    }
}
