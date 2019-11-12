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
    public function __invoke(GetShipmentList $getShipmentList)
    {
        if ($getShipmentList->fulfilmentMethod() !== null && $getShipmentList->orderId() !== null) {
            throw new \RuntimeException(
                'Request contains invalid value(s): query parameters, either provide fulfilment-method or order-id.'
            );
        }

        $response = $this->client->get('shipments', [
            'query' => [
                'page' => $getShipmentList->page(),
                'fulfilment-method' => $getShipmentList->fulfilmentMethod()
                    ? $getShipmentList->fulfilmentMethod()->value()
                    : null,
                'order-id' => $getShipmentList->orderId() ? $getShipmentList->orderId()->toString() : null
            ],
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        $response = $response->getBody()->json();

        if (! empty($response)) {
            foreach ($response['shipments'] as &$shipment) {
                // Current return includes milliseconds: 2018-12-20T11:34:50.237+01:00
                // Convert this timestamp into ISO 8601 format.
                $shipment['shipmentDate'] = (new \DateTime($shipment['shipmentDate']))
                    ->format(\DateTime::ATOM);
            }

            return ShipmentList::fromArray($response);
        }

        return null;
    }
}
