<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\CommandHandler\Inbound\Query;

use BolCom\RetailerApi\Model\Inbound\FbbShippingLabelList;
use BolCom\RetailerApi\Model\Inbound\Query\GetFbbShippingLabel;

interface GetFbbShippingLabelHandlerInterface
{
    public function __invoke(GetFbbShippingLabel $getFbbShippingLabel) : FbbShippingLabelList;
}
