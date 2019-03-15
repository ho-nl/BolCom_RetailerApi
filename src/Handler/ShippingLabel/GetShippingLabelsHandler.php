<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\ShippingLabel;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\ShippingLabel\Query\GetShippingLabels;
use BolCom\RetailerApi\Model\ShippingLabel\QueryHandler\GetShippingLabelsHandlerInterface;
use BolCom\RetailerApi\Model\ShippingLabel\ShippingLabelList;

class GetShippingLabelsHandler implements GetShippingLabelsHandlerInterface
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
    public function __invoke(GetShippingLabels $getShippingLabels)
    {
        $response = $this->client->get("purchasable-shippinglabels/{$getShippingLabels->orderItemId()->toString()}", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        $response = $response->getBody()->json();

        return ! empty($response) ? ShippingLabelList::fromArray($response) : null;
    }
}
