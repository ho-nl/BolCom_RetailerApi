<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Query\ExportFile;
use BolCom\RetailerApi\Model\Offer\QueryHandler\GetExportFileHandlerInterface;
use BolCom\RetailerApi\Model\Offer\RetailerExportFileRequest;

class GetExportFileHandler implements GetExportFileHandlerInterface
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
    public function __invoke(ExportFile $export): ExportFile
    {
        $response = $this->client->get("offers/export/{$export->exportId()}", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+csv'
            ]
        ]);

        return $response->getBody();
    }
}
