<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Infrastructure\Handler;

use BolCom\RetailerApi\Infrastructure\Guzzle\AuthenticatedClient;
use BolCom\RetailerApi\Model\Commission\Commission;
use BolCom\RetailerApi\Model\Commission\Query\GetCommission;
use BolCom\RetailerApi\Model\Commission\QueryHandler\GetCommissionHandlerInterface;

class GetCommissionHandler implements GetCommissionHandlerInterface
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

    public function __invoke(GetCommission $getCommission): Commission
    {
        $response = $this->client->client()->get("/retailer/commission/{$getCommission->ean()}", [
            'json' => $getCommission->payload(),
        ]);

        $this->client->validateResponse($response);

        $body = \GuzzleHttp\json_decode((string)$response->getBody());
        return Commission::fromArray($body);
    }
}
