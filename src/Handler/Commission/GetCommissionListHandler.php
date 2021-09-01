<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Commission;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Commission\CommissionList;
use BolCom\RetailerApi\Model\Commission\Query\GetCommissionList;
use BolCom\RetailerApi\Model\Commission\QueryHandler\GetCommissionListHandlerInterface;

class GetCommissionListHandler implements GetCommissionListHandlerInterface
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
    public function __invoke(GetCommissionList $getCommissionList): CommissionList
    {
        $response = $this->client->post('commission', [
            'json' => $getCommissionList->payload(),
            'headers' => ['Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER]
        ]);

        return CommissionList::fromArray($response->getBody()->json());
    }
}
