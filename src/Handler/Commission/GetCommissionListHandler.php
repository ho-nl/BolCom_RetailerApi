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
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(GetCommissionList $getCommissionList): CommissionList
    {
        $response = $this->client->post('/retailer/commission', [
            'json' => $getCommissionList->payload(),
            'headers' => ['Accept' => 'application/vnd.retailer.v3+json']
        ]);
        return CommissionList::fromArray($response->getBody()->json());
    }
}
