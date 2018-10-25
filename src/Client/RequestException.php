<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Client;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RequestException extends \GuzzleHttp\Exception\RequestException
{
    public static function create(
        RequestInterface $request,
        ResponseInterface $response = null,
        \Exception $previous = null,
        array $ctx = []
    ) {
        if ($response === null || !($response->getBody() instanceof JsonResponse)) {
            parent::create($request, $response);
        }

        /** @noinspection PhpUndefinedMethodInspection */
        $errorResponse = $response->getBody()->json();

        $additional = '';
        if (isset($errorResponse['violations'])) {
            $additional .= implode(', ', array_map(function($violation) {
                return $violation['reason'];
            }, $errorResponse['violations']));
        }

        $newResponse = $response->withStatus(
            $response->getStatusCode(),
            sprintf('%s: %s', $errorResponse['detail'], $additional)
        );

        return parent::create($request, $newResponse);
    }
}
