<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi;

use BolCom\RetailerApi\Client\ClientConfigInterface;
use BolCom\RetailerApi\Client\AcceptHeaderMiddleware;
use BolCom\RetailerApi\Client\Oauth2Middleware;
use BolCom\RetailerApi\Client\RequestExceptionMiddleware;
use BolCom\RetailerApi\Client\ResponseSelectorMiddleware;
use BolCom\RetailerApi\Model\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleRetry\GuzzleRetryMiddleware;
use Psr\Log\LoggerInterface;

class Client extends \GuzzleHttp\Client implements ClientInterface
{
    public function __construct(
        ClientConfigInterface $clientConfig,
        LoggerInterface $logger = null,
        string $userAgent = 'bol-com/retailer-api/1.1'
    ) {
        $stack = $this->handlerStack($clientConfig, $logger);

        parent::__construct([
            'handler' => $stack,
            'base_uri' => $clientConfig->clientUrl(),
            'headers' => ['User-Agent' => $userAgent],
            'connect_timeout' => 10,
            'auth' => 'oauth'
        ]);
    }

    /**
     * @param ClientConfigInterface $clientConfig
     * @param null|LoggerInterface $logger
     *
     * @return HandlerStack
     */
    protected function handlerStack(ClientConfigInterface $clientConfig, LoggerInterface $logger = null): HandlerStack
    {
        $stack = new HandlerStack(\GuzzleHttp\choose_handler());
        $stack->push(Middleware::redirect(), 'allow_redirects');
        $stack->push(Middleware::cookies(), 'cookies');
        $stack->push(Middleware::prepareBody(), 'prepare_body');
        $stack->push(new Oauth2Middleware(
            $clientConfig->clientId(),
            $clientConfig->clientSecret(),
            $clientConfig->accessTokenPath()
        ), 'oauth');
        $stack->push(new AcceptHeaderMiddleware());
        $stack->push(new RequestExceptionMiddleware(), 'http_errors');
        $stack->push(GuzzleRetryMiddleware::factory());

        $logger && $stack->push(Middleware::log($logger, new \GuzzleHttp\MessageFormatter()));
        $stack->push(new ResponseSelectorMiddleware());

        return $stack;
    }
}
