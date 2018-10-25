<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Handler\Commission;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Commission\Commission;
use BolCom\RetailerApi\Model\Commission\Query\GetCommission;
use BolCom\RetailerApi\Model\Commission\QueryHandler\GetCommissionHandlerInterface;

class GetCommissionHandler implements GetCommissionHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(GetCommission $getCommission): Commission
    {
        $response = $this->client->get("/retailer/commission/{$getCommission->ean()->value()}", [
            'query' => [
                'condition' => $getCommission->condition()->value(),
                'price' => $getCommission->price()->value()
            ],
            'headers' => ['Accept' => 'application/vnd.retailer.v3+json']
        ]);
        return Commission::fromArray($response->getBody()->json());
    }
}
