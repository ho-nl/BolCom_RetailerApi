<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Client;


use kamermans\OAuth2\GrantType\ClientCredentials;
use kamermans\OAuth2\Persistence\FileTokenPersistence;
use kamermans\OAuth2\Signer;

class Oauth2Middleware
{

    /** @var \kamermans\OAuth2\OAuth2Middleware */
    private $middleware;

    public function __construct(
        string $apiKey,
        string $apiSecret,
        string $tokenFilePath
    ) {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://login.bol.com/token']);
        $clientCredentials = new ClientCredentials($client, [
            'client_id' => $apiKey,
            'client_secret' => $apiSecret
        ]);
        $this->middleware = new \kamermans\OAuth2\OAuth2Middleware($clientCredentials);
        $this->middleware->setTokenPersistence(new FileTokenPersistence($tokenFilePath));
    }

    public function __invoke(callable $handler)
    {
        return $this->middleware->__invoke($handler);
    }
}
