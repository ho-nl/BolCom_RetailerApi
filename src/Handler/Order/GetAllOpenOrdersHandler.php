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
    public function __invoke(GetAllOpenOrders $getAllOpenOrders): ?OrderList
    {
        $response = $this->client->get('/retailer-demo/orders', [
            'page' => $getAllOpenOrders->page(),
            'fulfilment-method' => $getAllOpenOrders->fulfilmentMethod()->value(),
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        $response = \GuzzleHttp\json_decode((string) $response->getBody(), true);

        return OrderList::fromArray($response);
    }
}
