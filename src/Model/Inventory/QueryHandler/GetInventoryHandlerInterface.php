<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Inventory\QueryHandler;

use BolCom\RetailerApi\Model\Inventory\InventoryOfferList;
use BolCom\RetailerApi\Model\Inventory\Query\GetInventory;

interface GetInventoryHandlerInterface
{
    /**
     * @param GetInventory $getInventory
     *
     * @return InventoryOfferList|null
     */
    public function __invoke(GetInventory $getInventory);
}
