<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Order;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Order\QueryHandler\GetAllOpenOrdersHandlerInterface;
use BolCom\RetailerApi\Model\Order\OrderList;
use BolCom\RetailerApi\Model\Order\Query\GetAllOpenOrders;

class GetAllOpenOrdersHandler implements GetAllOpenOrdersHandlerInterface
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
    public function __invoke(GetAllOpenOrders $getAllOpenOrders)
    {
        $response = $this->client->get('orders', [
            'query' => [
                'page' => $getAllOpenOrders->page(),
                'fulfilment-method' => $getAllOpenOrders->fulfilmentMethod()->value()
            ],
            'headers' => [
                'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER_V4
            ]
        ]);

        $response = $response->getBody()->json();

        return ! empty($response) ? OrderList::fromArray($response) : null;
    }
}
