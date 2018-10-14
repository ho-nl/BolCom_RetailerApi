<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Order\CommandHandler;

use BolCom\RetailerApi\Model\Order\Command\CancelOrder;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;

interface CancelOrderHandlerInterface
{
    public function __invoke(CancelOrder $cancelOrder) : ProcessStatus;
}
