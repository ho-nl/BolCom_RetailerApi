<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Handler\Commission;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Model\Invoice\InvoicePdf;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoice;
use BolCom\RetailerApi\Model\Invoice\QueryHandler\GetInvoiceHandlerInterface;

class GetInvoiceHandler implements GetInvoiceHandlerInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function __invoke(GetInvoice $getInvoice) : InvoicePdf
    {
        $response = $this->client->get("/retailer/invoices/{$getInvoice->invoiceId()}");
        return InvoicePdf::fromString((string) $response->getBody());
    }
}
