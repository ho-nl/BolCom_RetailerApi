<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\QueryHandler;

use BolCom\RetailerApi\Model\Offer\Query\ExportFileRequest;
use BolCom\RetailerApi\Model\Offer\RetailerExportFileRequest;

interface ExportFileRequestHandlerInterface
{
    /**
     * @return RetailerExportFile
     */
    public function __invoke(ExportFileRequest $exportFile): RetailerExportFileRequest;
}
