<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JsonResponseMiddleware
{
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            return $handler($request, $options)->then(
                function (ResponseInterface $response) {
                    return $response->withBody(new JsonResponse($response->getBody()));
                }
            );
        };
    }
}
