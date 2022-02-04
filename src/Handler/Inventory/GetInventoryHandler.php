<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Inventory;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Inventory\InventoryOfferList;
use BolCom\RetailerApi\Model\Inventory\Query\GetInventory;
use BolCom\RetailerApi\Model\Inventory\QueryHandler\GetInventoryHandlerInterface;

class GetInventoryHandler implements GetInventoryHandlerInterface
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
    public function __invoke(GetInventory $getInventory)
    {
        $response = $this->client->get('inventory', [
            'query' => [
                'page' => $getInventory->page(),
                'quantity' => null === $getInventory->quantity() ? null : implode(',', $getInventory->quantity()),
                'stock' => null === $getInventory->stock() ? null : $getInventory->stock()->value(),
                'state' => null === $getInventory->state() ? null : $getInventory->state()->value(),
                'query' => $getInventory->query()
            ],
            'headers' => [
                'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER_V4
            ]
        ]);

        $response = $response->getBody()->json();

        return ! empty($response) ? InventoryOfferList::fromArray($response) : null;
    }
}
