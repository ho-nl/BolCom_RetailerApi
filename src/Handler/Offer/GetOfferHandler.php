<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Query\GetOffer;
use BolCom\RetailerApi\Model\Offer\QueryHandler\GetOfferHandlerInterface;
use BolCom\RetailerApi\Model\Offer\RetailerOffer;

class GetOfferHandler implements GetOfferHandlerInterface
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
    public function __invoke(GetOffer $getOffer): RetailerOffer
    {
        $response = $this->client->get("offers/{$getOffer->offerId()->toString()}", [
            'headers' => [
                'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER_V4
            ]
        ]);

        return RetailerOffer::fromArray($response->getBody()->json());
    }
}
