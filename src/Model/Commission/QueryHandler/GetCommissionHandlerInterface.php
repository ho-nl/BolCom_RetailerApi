<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Commission\QueryHandler;

use BolCom\RetailerApi\Model\Commission\Commission;
use BolCom\RetailerApi\Model\Commission\Query\GetCommission;

interface GetCommissionHandlerInterface
{
    public function __invoke(GetCommission $getCommission): Commission;
}
