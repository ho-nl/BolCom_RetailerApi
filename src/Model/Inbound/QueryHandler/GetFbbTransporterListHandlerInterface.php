<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\CommandHandler\Inbound\Query;

use BolCom\RetailerApi\Model\Inbound\FbbTransporters;
use BolCom\RetailerApi\Model\Inbound\Query\GetFbbTransporterList;

interface GetFbbTransporterListHandlerInterface
{
    public function __invoke(GetFbbTransporterList $getFbbTransporterList) : FbbTransporters;
}
