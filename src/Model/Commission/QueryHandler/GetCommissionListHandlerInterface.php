<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Commission\QueryHandler;

use BolCom\RetailerApi\Model\Commission\CommissionList;
use BolCom\RetailerApi\Model\Commission\Query\GetCommissionList;

interface GetCommissionListHandlerInterface
{
    public function __invoke(GetCommissionList $getCommissionList) : CommissionList;
}
