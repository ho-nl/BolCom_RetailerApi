<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ResponseSelectorMiddleware
{
    public function __invoke(callable $handler)
    {
        return function (RequestInterface $request, array $options) use ($handler) {
            return $handler($request, $options)->then(
                function (ResponseInterface $response) {
                	$contentTypes = $response->getHeader('content-type');
                	$csvContentTypes = array_filter($contentTypes, function ($val) {return false !== stripos($val, 'csv');});
                	if ($csvContentTypes) {
                		return $response->withBody(new CsvResponse($response->getBody()));
					}
					return $response->withBody(new JsonResponse($response->getBody()));
                }
            );
        };
    }
}
