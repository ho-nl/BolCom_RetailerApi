<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Shipment\QueryHandler;

use BolCom\RetailerApi\Model\Shipment\Query\GetShipmentList;
use BolCom\RetailerApi\Model\Shipment\ShipmentList;

interface GetShipmentListHandlerInterface
{
    /**
     * @param GetShipmentList $getShipmentList
     *
     * @return ShipmentList|null
     */
    public function __invoke(GetShipmentList $getShipmentList);
}
