<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Reduction\QueryHandler;

use BolCom\RetailerApi\Model\Reduction\Query\GetLatestReductionsFilename;
use BolCom\RetailerApi\Model\Reduction\ReductionList;

interface GetLatestReductionsFilenameHandlerInterface
{
    public function __invoke(GetLatestReductionsFilename $getLatestReductionsFilename) : ReductionList;
}
