<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Infrastructure\Handler;

use BolCom\RetailerApi\Infrastructure\Guzzle\AuthenticatedClient;
use BolCom\RetailerApi\Model\Commission\CommissionList;
use BolCom\RetailerApi\Model\Commission\Query\GetCommissionList;
use BolCom\RetailerApi\Model\Commission\QueryHandler\GetCommissionListHandlerInterface;

class GetCommissionListHandler implements GetCommissionListHandlerInterface
{
    /**
     * @var AuthenticatedClient
     */
    private $client;

    public function __construct(
        AuthenticatedClient $client
    ) {
        $this->client = $client;
    }

    public function __invoke(GetCommissionList $getCommissionList): CommissionList
    {
        $response = $this->client->client()->post('/retailer/commission', [
            'json' => $getCommissionList->payload(),
        ]);
        $body = \GuzzleHttp\json_decode((string) $response->getBody());
        return CommissionList::fromArray($body);
    }
}
