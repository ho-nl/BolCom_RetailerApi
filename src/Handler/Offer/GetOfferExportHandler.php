<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Handler\Offer;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Offer\Query\GetOfferExport;
use BolCom\RetailerApi\Model\Offer\QueryHandler\GetOfferExportHandlerInterface;
use BolCom\RetailerApi\Model\Offer\RetailerOfferExportList;

class GetOfferExportHandler implements GetOfferExportHandlerInterface
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
    public function __invoke(GetOfferExport $offerExport): RetailerOfferExportList
    {
        $response = $this->client->get("offers/export/{$offerExport->offerExportId()->toString()}", [
            'headers' => [
                'Accept' => 'application/vnd.retailer.v3+csv'
            ]
        ]);
        $data = $this->addCsvHeaderAsKey($response->getBody()->csv());
        return RetailerOfferExportList::fromArray($data);
    }

    private function addCsvHeaderAsKey(array $data): array
	{
		$header = array_shift($data);
		$mapFunc = function (array $line) use ($header) {
			return array_combine($header, $line);
		};
		return array_map($mapFunc, $data);
	}
}
