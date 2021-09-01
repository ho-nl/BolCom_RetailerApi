<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Rma;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Rma\Query\GetAllReturns;
use BolCom\RetailerApi\Model\Rma\QueryHandler\GetAllReturnsHandlerInterface;
use BolCom\RetailerApi\Model\Rma\ReturnItemList;

class GetAllReturnsHandler implements GetAllReturnsHandlerInterface
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
    public function __invoke(GetAllReturns $getAllReturns)
    {
        $response = $this->client->get('returns', [
            'query' => [
                'page' => $getAllReturns->page(),
                'handled' => $getAllReturns->handled(),
                'fulfilment-method' => $getAllReturns->fulfilmentMethod()->value()
            ],
            'headers' => [
                'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER
            ]
        ]);

        $response = $response->getBody()->json();

        if (! empty($response)) {
            foreach ($response['returns'] as &$return) {
                // Current return includes milliseconds: 2018-12-20T11:34:50.237+01:00
                // Convert this timestamp into ISO 8601 format.
                $return['registrationDateTime'] = (new \DateTime($return['registrationDateTime']))
                    ->format(\DateTime::ATOM);

                if (isset($return['processingDateTime'])) {
                    $return['processingDateTime'] = (new \DateTime($return['processingDateTime']))
                        ->format(\DateTime::ATOM);
                }
            }

            return ReturnItemList::fromArray($response);
        }

        return null;
    }
}
