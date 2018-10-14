<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\QueryHandler;

use BolCom\RetailerApi\Model\Order\OrderList;
use BolCom\RetailerApi\Model\Order\Query\GetAllOpenOrders;

interface GetAllOpenOrdersHandlerInterface
{
    public function __invoke(GetAllOpenOrders $getAllOpenOrders) : OrderList;
}
