<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Rma\CommandHandler;

use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;
use BolCom\RetailerApi\Model\Rma\Command\HandleReturn;

interface HandleReturnHandlerInterface
{
    public function __invoke(HandleReturn $handleReturn): ProcessStatus;
}
