<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\QueryHandler;

use BolCom\RetailerApi\Model\Offer\Query\ExportFile;
use Psr\Http\Message\StreamInterface;

interface GetExportFileHandlerInterface
{
    /**
     * @return mixed
     */
    public function __invoke(ExportFile $entityId): StreamInterface;
}
