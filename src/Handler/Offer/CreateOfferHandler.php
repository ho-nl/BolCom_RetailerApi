<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Command\CreateOffer;
use BolCom\RetailerApi\Model\Offer\CommandHandler\CreateOfferHandlerInterface;
use BolCom\RetailerApi\Model\Offer\Condition;
use BolCom\RetailerApi\Model\Offer\FulfilmentMethod;
use BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus;

class CreateOfferHandler implements CreateOfferHandlerInterface
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
    public function __invoke(CreateOffer $createOffer): ProcessStatus
    {
        if (
            $createOffer
                ->retailerOffer()
                ->condition()
                ->comment() !== null &&
            $createOffer
                ->retailerOffer()
                ->condition()
                ->comment()
                ->toString() !== null &&
            $createOffer
                ->retailerOffer()
                ->condition()
                ->name()
                ->equals(Condition::IS_NEW())
        ) {
            throw new \RuntimeException(
                'conditionComment is only allowed in combination with conditionName(s): AS_NEW, GOOD, REASONABLE, MODERATE.' // @codingStandardsIgnoreLine
            );
        }

        if (
            $createOffer
                ->retailerOffer()
                ->fulfilment()
                ->deliveryCode() !== null &&
            $createOffer
                ->retailerOffer()
                ->fulfilment()
                ->method()
                ->equals(FulfilmentMethod::FBB())
        ) {
            throw new \RuntimeException('DeliveryCode is not allowed for fulfilment type FBB.');
        }

        $response = $this->client->post('offers', [
            'json' => $createOffer->retailerOffer()->toArray(),
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
