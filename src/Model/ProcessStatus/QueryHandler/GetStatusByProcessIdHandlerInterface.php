<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\ProcessStatus\QueryHandler;

use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByProcessId;
use GuzzleHttp\Promise\PromiseInterface;

interface GetStatusByProcessIdHandlerInterface
{
    public function __invoke(GetStatusByProcessId $getStatusByProcessId): PromiseInterface;
}
