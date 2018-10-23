<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Handler\Commission;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Invoice\InvoicePdf;
use BolCom\RetailerApi\Model\Invoice\InvoicePdfList;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoice;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoiceList;
use BolCom\RetailerApi\Model\Invoice\QueryHandler\GetInvoiceHandlerInterface;
use BolCom\RetailerApi\Model\Invoice\QueryHandler\GetInvoiceListHandlerInterface;

class GetInvoiceListHandler implements GetInvoiceListHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(GetInvoiceList $getInvoiceList) : InvoicePdfList
    {
        $response = $this->client->get('/retailer/invoices', [
            'query' => $getInvoiceList->payload()
        ]);
        return InvoicePdfList::fromArray($response->getBody()->json());
    }
}
