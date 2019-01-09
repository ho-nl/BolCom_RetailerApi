<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Shipment;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Shipment\Query\GetShipmentList;
use BolCom\RetailerApi\Model\Shipment\QueryHandler\GetShipmentListHandlerInterface;
use BolCom\RetailerApi\Model\Shipment\ShipmentList;

class GetShipmentListHandler implements GetShipmentListHandlerInterface
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

    public function __invoke(GetShipmentList $getShipmentList): ?ShipmentList
    {
        $response = $this->client->get('shipments', [
            'page' => $getShipmentList->page(),
            'order-id' => $getShipmentList->orderid()->toString(),
            'fulfilment-method' => $getShipmentList->fulfilmentMethod()->value(),
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        $response = $response->getBody()->json();

        return ! empty($response) ? ShipmentList::fromArray($response) : null;
    }
}
