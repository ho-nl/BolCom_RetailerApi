<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Client;

interface ResponseInterface extends \Psr\Http\Message\ResponseInterface
{
    public function getBody(): JsonResponse;
}
