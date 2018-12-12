<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Command\GenerateOfferCvs;
use BolCom\RetailerApi\Model\Offer\CommandHandler\GenerateOfferCsvHandlerInterface;
use BolCom\RetailerApi\Model\Offer\OfferCsv;

/**
 * @deprecated Please use the v4 version of the offer api
 */
class GenerateOfferCsvHandler implements GenerateOfferCsvHandlerInterface
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
    public function __invoke(GenerateOfferCvs $generateOfferCvs): OfferCsv
    {
        $response = $this->client->get('offers/export', [
            'json' => $generateOfferCvs->payload(),
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        return OfferCsv::fromArray($response->getBody()->json());
    }
}
