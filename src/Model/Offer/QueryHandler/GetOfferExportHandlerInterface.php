<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\QueryHandler;

use BolCom\RetailerApi\Model\Offer\Query\GetOffer;
use BolCom\RetailerApi\Model\Offer\Query\GetOfferExport;
use BolCom\RetailerApi\Model\Offer\RetailerOfferExportList;

interface GetOfferExportHandlerInterface
{
    /**
     * @param GetOffer $offerExport
     *
     * @return array
     */
    public function __invoke(GetOfferExport $offerExport): RetailerOfferExportList;
}
