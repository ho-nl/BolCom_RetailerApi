<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Rma;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Rma\Query\GetReturn;
use BolCom\RetailerApi\Model\Rma\QueryHandler\GetReturnHandlerInterface;
use BolCom\RetailerApi\Model\Rma\ReturnItem;

class GetReturnHandler implements GetReturnHandlerInterface
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
    public function __invoke(GetReturn $getReturn): ReturnItem
    {
        $response = $this->client->get("returns/{$getReturn->rmaId()->toScalar()}", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        return ReturnItem::fromArray($response->getBody()->json());
    }
}
