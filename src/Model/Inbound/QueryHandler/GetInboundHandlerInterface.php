<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\CommandHandler\Inbound\Query;

use BolCom\RetailerApi\Model\Inbound\Inbound;
use BolCom\RetailerApi\Model\Inbound\Query\GetInbound;

interface GetInboundHandlerInterface
{
    public function __invoke(GetInbound $getInbound) : Inbound;
}
