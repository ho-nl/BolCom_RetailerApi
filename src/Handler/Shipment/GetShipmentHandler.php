<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Shipment;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Shipment\Query\GetShipment;
use BolCom\RetailerApi\Model\Shipment\QueryHandler\GetShipmentHandlerInterface;
use BolCom\RetailerApi\Model\Shipment\Shipment;

class GetShipmentHandler implements GetShipmentHandlerInterface
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
    public function __invoke(GetShipment $getShipment): Shipment
    {
        $response = $this->client->get("shipments/{$getShipment->shipmentId()->toScalar()}", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        $response = $response->getBody()->json();
        $response['shipmentItems'] = array_map(function (array $item) {
            $item['latestDeliveryDate'] = (new \DateTime($item['latestDeliveryDate']))->format('Y-m-d');

            return $item;
        }, $response['shipmentItems']);

        return Shipment::fromArray($response);
    }
}
