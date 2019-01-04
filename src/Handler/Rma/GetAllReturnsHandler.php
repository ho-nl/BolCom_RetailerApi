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
    public function __invoke(GetAllReturns $getAllReturns): ?ReturnItemList
    {
        $response = $this->client->get('returns', [
            'page' => $getAllReturns->page(),
            'handled' => $getAllReturns->handled(),
            'fulfilment-method' => $getAllReturns->fulfilmentMethod()->value(),
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        $response = $response->getBody()->json();

        return ! empty($response) ? ReturnItemList::fromArray($response) : null;
    }
}
