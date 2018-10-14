<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Transport\QueryHandler;

use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;
use BolCom\RetailerApi\Model\Transport\Command\AddTransportInformation;

interface AddTransportInformationHandler
{
    public function __invoke(AddTransportInformation $addTransportInformation) : ProcessStatus;
}
