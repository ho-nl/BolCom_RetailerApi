<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi;

use BolCom\RetailerApi\Client\JsonResponseMiddleware;
use BolCom\RetailerApi\Client\AcceptHeaderMiddleware;
use BolCom\RetailerApi\Client\Oauth2Middleware;
use BolCom\RetailerApi\Client\RequestExceptionMiddleware;
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
        string $storagepath = '/tmp/bol_access_token.json',
        string $apiUrl = 'https://api.bol.com/',
        string $apiKey = '4c25a73d-31a4-402d-ac4c-83f0f869bca1',
        string $apiSecret = 'CqXYlOHp3t-8WSu_FWTZi1GU7ivy9opskEGKEvj4K5WrJh1Tkdj0K0FvRDrMnxV1oIIJ2T4mBeloaXxMuOp93Q'
    ) {
        $stack = new HandlerStack(\GuzzleHttp\choose_handler());

        $stack->push(Middleware::redirect(), 'allow_redirects');
        $stack->push(Middleware::cookies(), 'cookies');
        $stack->push(Middleware::prepareBody(), 'prepare_body');
        $stack->push(new Oauth2Middleware($apiKey, $apiSecret, $storagepath), 'oauth');
        $stack->push(new AcceptHeaderMiddleware());
        $stack->push(new RequestExceptionMiddleware(), 'http_errors');

        $logger && $stack->push(Middleware::log($logger, new \GuzzleHttp\MessageFormatter()));
        $stack->push(new JsonResponseMiddleware());

        parent::__construct([
            'handler' => $stack,
            'base_uri' => $apiUrl,
            'headers' => [ 'User-Agent' => 'bol-com/retailer-api/1.0' ],
            'connect_timeout' => 10,
            'auth' => 'oauth'
        ]);
    }
}
