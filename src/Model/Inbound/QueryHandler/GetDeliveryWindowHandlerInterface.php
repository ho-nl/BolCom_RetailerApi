<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\CommandHandler\Inbound\Query;

use BolCom\RetailerApi\Model\Inbound\Query\GetDeliveryWindow;
use BolCom\RetailerApi\Model\Inbound\TimeslotList;

interface GetDeliveryWindowHandlerInterface
{
    public function __invoke(GetDeliveryWindow $getDeliveryWindow) : TimeslotList;
}
