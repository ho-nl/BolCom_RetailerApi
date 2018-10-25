<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Command\CreateOrUpdateOffer;
use BolCom\RetailerApi\Model\Offer\CommandHandler\CreateOrUpdateOfferHandlerInterface;

class CreateOrUpdateOfferHandler implements CreateOrUpdateOfferHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(CreateOrUpdateOffer $createOrUpdateOffer): void
    {
        $this->client->put('/retailer/offers', [
            'json' => $createOrUpdateOffer->payload(),
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);
    }
}
