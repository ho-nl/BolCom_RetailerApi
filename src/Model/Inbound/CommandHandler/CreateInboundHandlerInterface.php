<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Inbound\CommandHandler;

use BolCom\RetailerApi\Model\Inbound\Command\CreateInbound;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;

interface CreateInboundHandlerInterface
{
    public function __invoke(CreateInbound $createInbound) : ProcessStatus;
}
