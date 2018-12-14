<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\QueryHandler;

use BolCom\RetailerApi\Model\Offer\Query\GetOfferCsv;

interface GetOfferCsvHandlerInterface
{
    //@todo Return type is undefined
    public function __invoke(GetOfferCsv $getOfferCsv): void;
}
