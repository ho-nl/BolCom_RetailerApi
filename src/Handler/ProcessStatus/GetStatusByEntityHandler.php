<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\ProcessStatus;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatuses;
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByEntity;
use BolCom\RetailerApi\Model\ProcessStatus\QueryHandler\GetStatusByEntityHandlerInterface;

class GetStatusByEntityHandler implements GetStatusByEntityHandlerInterface
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
    public function __invoke(GetStatusByEntity $getStatusByEntity): ?ProcessStatuses
    {
        $response = $this->client->get('process-status', [
            'query' => [
                'entity-id' => $getStatusByEntity->entityId()->toString(),
                'event-type' => $getStatusByEntity->eventType()->toString(),
                'page' => $getStatusByEntity->page(),
            ],
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        $response = $response->getBody()->json();

        return ! empty($response) ? ProcessStatuses::fromArray($response) : null;
    }
}
