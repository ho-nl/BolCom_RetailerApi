<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Client;

class ClientConfig implements ClientConfigInterface
{
    /** @var string $clientId */
    private $clientId;

    /** @var string $clientSecret */
    private $clientSecret;

    /** @var string $clientUrl */
    private $clientUrl;

    /** @var string $accessTokenPath */
    private $accessTokenPath;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $clientUrl
     * @param string $accessTokenPath
     */
    public function __construct(
        string $clientId,
        string $clientSecret,
        string $clientUrl = 'https://api.bol.com/retailer/',
        string $accessTokenPath = '/tmp/bol_access_token.json'
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->clientUrl = $clientUrl;
        $this->accessTokenPath = $accessTokenPath;
    }

    public function clientId(): string
    {
        return $this->clientId;
    }

    public function clientSecret(): string
    {
        return $this->clientSecret;
    }

    public function clientUrl(): string
    {
        return $this->clientUrl;
    }

    public function accessTokenPath(): string
    {
        return $this->accessTokenPath;
    }
}
