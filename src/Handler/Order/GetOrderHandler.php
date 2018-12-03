<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Order;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Order\QueryHandler\GetOrderHandlerInterface;
use BolCom\RetailerApi\Model\Order\Order;
use BolCom\RetailerApi\Model\Order\Query\GetOrder;

class GetOrderHandler implements GetOrderHandlerInterface
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
    public function __invoke(GetOrder $getOrder): Order
    {
        $response = $this->client->get("/retailer-demo/orders/{$getOrder->orderId()}", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        $response = \GuzzleHttp\json_decode((string) $response->getBody(), true);

        return Order::fromArray($response);
    }
}
