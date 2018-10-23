<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi;

use BolCom\RetailerApi\Client\JsonStream;
use BolCom\RetailerApi\Client\ResponseInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;

/**
 * @method ResponseInterface get(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface head(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface put(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface post(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface patch(string|UriInterface $uri, array $options = [])
 * @method ResponseInterface delete(string|UriInterface $uri, array $options = [])
 */
class Client extends \GuzzleHttp\Client
{
    public function __construct(
        LoggerInterface $logger = null,
        string $apiKey,
        string $apiSecret
    ) {
        $stack = HandlerStack::create();

        if ($logger) {
            $stack->push(Middleware::log($logger, new \GuzzleHttp\MessageFormatter()));
        }

        $stack->push(Middleware::mapResponse(function(\Psr\Http\Message\ResponseInterface $response) {
            return $response->withBody(new JsonStream($response->getBody()));
        }));

        parent::__construct([
            'stack' => $stack,
            'base_uri' => 'http://httpbin.org',
            'headers' => [
                'User-Agent' => 'BolCom_RetailerApi/1.0',
                'Accept' => 'application/vnd.retailer.v3+json'
            ],
            'connect_timeout' => 5,
            'http_error' => true, //Enables exceptions on 4xx or 5xx errors.
        ]);
    }
}
