<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\ProcessStatus;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByProcessId;
use BolCom\RetailerApi\Model\ProcessStatus\QueryHandler\GetStatusByProcessIdHandlerInterface;

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
    public function __invoke(GetStatusByProcessId $getStatusByProcessId): ProcessStatus
    {
        $response = $this->client->get("process-status/{$getStatusByProcessId->id()}", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        return ProcessStatus::fromArray($response->getBody()->json());
    }
}
