<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\ProcessStatus;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Client\ClientConfig;
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
    public function __invoke(GetStatusByEntity $getStatusByEntity)
    {
        $sharedBaseUri = $this->client->getConfig('base_uri')->__toString() === ClientConfig::TEST_API_URL ? ClientConfig::SHARED_TEST_API_URL : ClientConfig::SHARED_API_URL;
        $response = $this->client->get('process-status', [
            'base_uri' => $sharedBaseUri,
            'query' => [
                'entity-id' => $getStatusByEntity->entityId()->toString(),
                'event-type' => $getStatusByEntity->eventType()->toString(),
                'page' => $getStatusByEntity->page(),
            ],
            'headers' => [
                'Accept' => ClientConfig::ACCEPT_HEADER,
            ],
        ]);

        $response = $response->getBody()->json();

        return !empty($response) ? ProcessStatuses::fromArray($response) : null;
    }
}
