<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\ProcessStatus;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByProcessId;
use BolCom\RetailerApi\Model\ProcessStatus\QueryHandler\GetStatusByProcessIdHandlerInterface;
use GuzzleHttp\Promise\PromiseInterface;

class GetStatusByProcessIdHandler implements GetStatusByProcessIdHandlerInterface
{
    /** @var Client $client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(GetStatusByProcessId $getStatusByProcessId): PromiseInterface
    {
        $response = $this->client->getAsync("process-status/{$getStatusByProcessId->id()}", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        return $response;
    }
}
