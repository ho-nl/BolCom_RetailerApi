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
                'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER_V4
            ]
        ]);

        $response = $response->getBody()->json();

        // Current return includes milliseconds: 2018-12-20T11:34:50.237+01:00
        // Convert this timestamp into ISO 8601 format.
        $response['shipmentDateTime'] = (new \DateTime($response['shipmentDateTime']))->format(\DateTime::ATOM);
        $response['shipmentItems'] = array_map(static function (array $item) {
            $item['fulfilment']['latestDeliveryDate'] =
                (new \DateTime($item['fulfilment']['latestDeliveryDate']))->format('Y-m-d');

            return $item;
        }, $response['shipmentItems']);

        return Shipment::fromArray($response);
    }
}
