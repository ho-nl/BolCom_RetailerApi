<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\CommandHandler;

use BolCom\RetailerApi\Model\Offer\Command\CreateOfferExport;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;

interface CreateOffersExportFileHandlerInterface
{
    /**
     * @param CreateOfferExport $createOffersExportFile
     *
     * @return ProcessStatus
     *@throws \RuntimeException
     *
     */
    public function __invoke(CreateOfferExport $createOffersExportFile): ProcessStatus;
}
