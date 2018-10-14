<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\ProcessStatus\QueryHandler;

use BolCom\RetailerApi\Model\Order\Order;
use BolCom\RetailerApi\Model\Order\Query\GetOrder;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByEntity;

interface GetStatusByEntityHandlerInterface
{
    public function __invoke(GetStatusByEntity $getStatusByEntity) : ProcessStatus;
}
