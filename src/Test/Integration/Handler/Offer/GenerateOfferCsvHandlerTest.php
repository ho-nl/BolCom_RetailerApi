<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Test\Integration\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Handler\Offer\GenerateOfferCsvHandler;
use BolCom\RetailerApi\Model\Offer\Command\GenerateOfferCvs;
use BolCom\RetailerApi\Model\Offer\PublishStatus;
use PHPUnit\Framework\TestCase;

class GenerateOfferCsvHandlerTest extends TestCase
{

    public function test__invoke()
    {
        $handler = new GenerateOfferCsvHandler(new Client(null, __DIR__ . '/../token.json'));

        $csv = $handler(GenerateOfferCvs::with(
            PublishStatus::published()
        ));

        echo $csv->url();
    }
}
