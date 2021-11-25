<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Query\ExportFileRequest;
use BolCom\RetailerApi\Model\Offer\QueryHandler\ExportFileRequestHandlerInterface;
use BolCom\RetailerApi\Model\Offer\RetailerExportFileRequest;

class ExportFileRequestHandler implements ExportFileRequestHandlerInterface
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
    public function __invoke(ExportFileRequest $exportFile): RetailerExportFileRequest
    {
        $payload = $exportFile->payload();

        $response = $this->client->post("offers/export", [
            'json' => $payload,
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+json'
            ]
        ]);

        return RetailerExportFileRequest::fromArray($response->getBody()->json());
    }
}
