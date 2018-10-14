<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Reduction\QueryHandler;

use BolCom\RetailerApi\Model\Reduction\Query\GetReductionList;
use BolCom\RetailerApi\Model\Reduction\ReductionList;

interface GetReductionListHandlerInterface
{
    public function __invoke(GetReductionList $getReductionList) : ReductionList;
}
