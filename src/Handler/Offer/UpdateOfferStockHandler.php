<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Command\UpdateOfferStock;
use BolCom\RetailerApi\Model\Offer\CommandHandler\UpdateOfferStockHandlerInterface;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;

class UpdateOfferStockHandler implements UpdateOfferStockHandlerInterface
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
    public function __invoke(UpdateOfferStock $updateOfferStock): ProcessStatus
    {
        $response = $this->client->put("offers/{$updateOfferStock->offerId()->toString()}/stock", [
            'json' => $updateOfferStock->stock()->toArray(),
            'headers' => [
                'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER
            ]
        ]);

        // Current return includes milliseconds: 2018-12-20T11:34:50.237+01:00
        // Convert this timestamp into ISO 8601 format.
        $response = $response->getBody()->json();
        $response['createTimestamp'] = (new \DateTime($response['createTimestamp']))->format(\DateTime::ATOM);

        return ProcessStatus::fromArray($response);
    }
}
