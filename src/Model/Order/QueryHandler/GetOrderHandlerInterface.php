<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer\QueryHandler;

use BolCom\RetailerApi\Model\Order\Order;
use BolCom\RetailerApi\Model\Order\Query\GetOrder;

interface GetOrderHandlerInterface
{
    public function __invoke(GetOrder $getOrder) : Order;
}
