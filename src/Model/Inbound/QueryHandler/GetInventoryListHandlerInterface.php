<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\CommandHandler\Inbound\Query;

use BolCom\RetailerApi\Model\Inbound\InventoryList;
use BolCom\RetailerApi\Model\Inbound\Query\GetInventoryList;

interface GetInventoryListHandlerInterface
{
    public function __invoke(GetInventoryList $getInventoryList) : InventoryList;
}
