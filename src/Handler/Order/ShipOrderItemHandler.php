<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Order;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Order\Command\ShipOrderItem;
use BolCom\RetailerApi\Model\Order\CommandHandler\ShipOrderItemHandlerInterface;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;

class ShipOrderItemHandler implements ShipOrderItemHandlerInterface
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
    public function __invoke(ShipOrderItem $orderItem): ProcessStatus
    {
        $payload = $orderItem->payload();
        unset($payload['orderItemId']);

        // Although the API documentation tells us to omit the key "trackAndTrace",
        // an error message is given when we do this. Set it to an empty string which will be accepted.
        if (isset($payload['transport']) && $payload['transport']['trackAndTrace'] === null) {
            $payload['transport']['trackAndTrace'] = '';
        }

        if ($payload['shippingLabelCode'] !== null && $payload['transport'] !== null) {
            throw new \RuntimeException(
                'Conflicting transport method: Either provide Transport or ShippingLabelCode. The current request contains both.' // @codingStandardsIgnoreLine
            );
        }

        $response = $this->client->put("orders/{$orderItem->orderItemId()->toString()}/shipment", [
            'json' => $payload,
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        // Current return includes milliseconds: 2018-12-20T11:34:50.237+01:00
        // Convert this timestamp into ISO 8601 format.
        $response = $response->getBody()->json();
        $response['createTimestamp'] = (new \DateTime($response['createTimestamp']))->format(\DateTime::ATOM);

        return ProcessStatus::fromArray($response);
    }
}
