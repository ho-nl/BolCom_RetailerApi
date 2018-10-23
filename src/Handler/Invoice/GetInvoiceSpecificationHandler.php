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
use BolCom\RetailerApi\Model\Invoice\InvoiceSpecificationPdfList;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoice;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoiceList;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoiceSpecification;
use BolCom\RetailerApi\Model\Invoice\QueryHandler\GetInvoiceHandlerInterface;
use BolCom\RetailerApi\Model\Invoice\QueryHandler\GetInvoiceListHandlerInterface;
use BolCom\RetailerApi\Model\Invoice\QueryHandler\GetInvoiceSpecificationHandlerInterface;

class GetInvoiceSpecificationHandler implements GetInvoiceSpecificationHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(GetInvoiceSpecification $getInvoiceSpecification) : InvoiceSpecificationPdfList
    {
        $response = $this->client->get("retailer/invoices/{$getInvoiceSpecification->invoiceId()}/specification", [
            'query' => $getInvoiceSpecification->page()
        ]);
        return InvoiceSpecificationPdfList::fromArray($response->getBody()->json());
    }
}
