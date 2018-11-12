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
        string $clientId,
        string $clientSecret,
        LoggerInterface $logger = null,
        string $storagepath = '/tmp/bol_access_token.json',
        string $clientUrl = 'https://api.bol.com/'
    ) {
        $stack = $this->handlerStack($clientId, $clientSecret, $storagepath, $logger);

        parent::__construct([
            'handler' => $stack,
            'base_uri' => $clientUrl,
            'headers' => ['User-Agent' => 'bol-com/retailer-api/1.0'],
            'connect_timeout' => 10,
            'auth' => 'oauth'
        ]);
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $storagepath
     * @param null|LoggerInterface $logger
     *
     * @return HandlerStack
     */
    protected function handlerStack(
        string $clientId,
        string $clientSecret,
        string $storagepath,
        ?LoggerInterface $logger
    ): HandlerStack {
        $stack = new HandlerStack(\GuzzleHttp\choose_handler());
        $stack->push(Middleware::redirect(), 'allow_redirects');
        $stack->push(Middleware::cookies(), 'cookies');
        $stack->push(Middleware::prepareBody(), 'prepare_body');
        $stack->push(new Oauth2Middleware($clientId, $clientSecret, $storagepath), 'oauth');
        $stack->push(new AcceptHeaderMiddleware());
        $stack->push(new RequestExceptionMiddleware(), 'http_errors');

        $logger && $stack->push(Middleware::log($logger, new \GuzzleHttp\MessageFormatter()));
        $stack->push(new JsonResponseMiddleware());

        return $stack;
    }
}
