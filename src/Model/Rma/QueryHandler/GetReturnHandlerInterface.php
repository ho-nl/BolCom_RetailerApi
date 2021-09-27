<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Rma\QueryHandler;

use BolCom\RetailerApi\Model\Rma\Query\GetReturn;
use BolCom\RetailerApi\Model\Rma\ReturnResult;

interface GetReturnHandlerInterface
{
    /**
     * @param GetReturn $getReturn
     *
     * @return ReturnResult
     */
    public function __invoke(GetReturn $getReturn): ReturnResult;
}
