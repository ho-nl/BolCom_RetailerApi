<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Shipment\QueryHandler;

use BolCom\RetailerApi\Model\Shipment\Query\GetShipment;
use BolCom\RetailerApi\Model\Shipment\Shipment;

interface GetShipmentHandlerInterface
{
    public function __invoke(GetShipment $getShipment) : Shipment;
}
