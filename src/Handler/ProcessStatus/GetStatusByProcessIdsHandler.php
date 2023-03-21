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
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByProcessIds;
use BolCom\RetailerApi\Model\ProcessStatus\QueryHandler\GetStatusByProcessIdsHandlerInterface;
use GuzzleHttp\Promise\PromiseInterface;

class GetStatusByProcessIdsHandler implements GetStatusByProcessIdsHandlerInterface
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
    public function __invoke(GetStatusByProcessIds $getStatusByProcessIds): ProcessStatuses
    {
        $promises = [];
        $sharedBaseUri = $this->client->getConfig('base_uri')->__toString() === ClientConfig::TEST_API_URL ? ClientConfig::SHARED_TEST_API_URL : ClientConfig::SHARED_API_URL;
        foreach ($getStatusByProcessIds->ids() as $id) {
            $promises[] = $this->client->getAsync("process-status/{$id}", [
                'base_uri' => $sharedBaseUri,
                'headers' => [
                    'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER,
                ],
            ]);
        }

        $fulfilledPromises = array_filter(\GuzzleHttp\Promise\settle($promises)->wait(), function (array $promise) {
            return $promise['state'] === PromiseInterface::FULFILLED;
        });

        $response['processStatuses'] = array_map(static function (array $promise) {
            // Current return includes milliseconds: 2018-12-20T11:34:50.237+01:00
            // Convert this timestamp into ISO 8601 format.
            $response = $promise['value']->getBody()->json();
            $response['createTimestamp'] = (new \DateTime($response['createTimestamp']))->format(\DateTime::ATOM);

            return $response;
        }, $fulfilledPromises);

        return ProcessStatuses::fromArray($response);
    }
}
