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
        $response = $this->client->get("orders/{$getOrder->orderId()}", [
            'headers' => [
                'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER
            ]
        ]);

        return Order::fromArray($response->getBody()->json());
    }
}
