<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\ShippingLabel\QueryHandler;

use BolCom\RetailerApi\Model\ShippingLabel\Query\GetShippingLabels;
use BolCom\RetailerApi\Model\ShippingLabel\ShippingLabelList;

interface GetShippingLabelsHandlerInterface
{
    public function __invoke(GetShippingLabels $getShippingLabels) : ShippingLabelList;
}
