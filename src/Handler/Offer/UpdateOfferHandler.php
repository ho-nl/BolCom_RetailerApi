<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Command\CreateOffer;
use BolCom\RetailerApi\Model\Offer\Command\UpdateOffer;
use BolCom\RetailerApi\Model\Offer\CommandHandler\CreateOfferHandlerInterface;
use BolCom\RetailerApi\Model\Offer\CommandHandler\UpdateOfferHandlerInterface;
use BolCom\RetailerApi\Model\Offer\Condition;
use BolCom\RetailerApi\Model\Offer\FulfilmentMethod;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;

class UpdateOfferHandler implements UpdateOfferHandlerInterface
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
    public function __invoke(UpdateOffer $updateOffer): ProcessStatus
    {
        if (
            $updateOffer
                ->retailerOffer()
                ->fulfilment()
                ->deliveryCode() !== null &&
            $updateOffer
                ->retailerOffer()
                ->fulfilment()
                ->method()
                ->equals(FulfilmentMethod::FBB())
        ) {
            throw new \RuntimeException('DeliveryCode is not allowed for fulfilment type FBB.');
        }

        $response = $this->client->put("offers/{$updateOffer->offerId()->toString()}", [
            'json' => $updateOffer->retailerOffer()->toArray(),
            'headers' => [
                'Accept' => \BolCom\RetailerApi\Client\ClientConfig::ACCEPT_HEADER,
            ],
        ]);

        // Current return includes milliseconds: 2018-12-20T11:34:50.237+01:00
        // Convert this timestamp into ISO 8601 format.
        $response = $response->getBody()->json();
        $response['createTimestamp'] = (new \DateTime($response['createTimestamp']))->format(\DateTime::ATOM);

        return ProcessStatus::fromArray($response);
    }
}
