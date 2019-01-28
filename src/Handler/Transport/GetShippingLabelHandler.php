<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Transport;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\ShippingLabel\ShippingLabelPdf;
use BolCom\RetailerApi\Model\Transport\Query\GetShippingLabel;
use BolCom\RetailerApi\Model\Transport\QueryHandler\GetShippingLabelHandlerInterface;

class GetShippingLabelHandler implements GetShippingLabelHandlerInterface
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
    public function __invoke(GetShippingLabel $shippingLabel): ShippingLabelPdf
    {
        $response = $this->client->get("transports/{$shippingLabel->transportId()->toScalar()}/shipping-label", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+pdf'
            ]
        ]);

        return ShippingLabelPdf::fromString((string) $response->getBody());
    }
}
