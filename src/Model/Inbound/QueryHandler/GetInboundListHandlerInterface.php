<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\CommandHandler\Inbound\Query;

use BolCom\RetailerApi\Model\Inbound\InboundList;
use BolCom\RetailerApi\Model\Inbound\Query\GetInboundList;

interface GetInboundListHandlerInterface
{
    public function __invoke(GetInboundList $getInboundList) : InboundList;
}
