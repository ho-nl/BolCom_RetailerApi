<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Infrastructure\Guzzle;

class AuthenticatedClient
{

    /** @var \GuzzleHttp\Client */
    private $client;

    public function client() : \GuzzleHttp\Client
    {
        if ($this->client === null) {
            $this->client = new \GuzzleHttp\Client([
                'base_uri' => 'http://httpbin.org',
                'headers' => [
                    'User-Agent' => 'BolCom_MagentoModule/1.0',
                    'Accept' => 'application/vnd.retailer.v3+json'
                ],
                'connect_timeout' => 5
            ]);
        }
        return $this->client;
    }

    public function validateResponse(\Psr\Http\Message\ResponseInterface $response) : void
    {
        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 202) {
            return;
        }

        throw new \InvalidArgumentException("{$response->getStatusCode()} {$response->getReasonPhrase()}");
    }
}
