<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Client;

use Psr\Http\Message\RequestInterface;

class AcceptHeaderMiddleware
{
    /**
     * Enforce api_version and api_type
     *
     * @param callable $handler
     * @return \Closure
     */
    public function __invoke(callable $handler): callable
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            if (! $request->hasHeader('Accept')) {
                throw new \InvalidArgumentException(
                    'Accept header is explicitly required, consult https://api.bol.com/retailer/public/redoc/ for options.'
                );
            }
            $request = $request->withHeader('Content-Type', $request->getHeader('Accept'));

            return $handler($request, $options);
        };
    }
}
