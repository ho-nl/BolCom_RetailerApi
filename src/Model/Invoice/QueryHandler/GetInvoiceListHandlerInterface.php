<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Invoice\QueryHandler;

use BolCom\RetailerApi\Model\Invoice\InvoicePdf;
use BolCom\RetailerApi\Model\Invoice\InvoicePdfList;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoice;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoiceList;

interface GetInvoiceListHandlerInterface
{
    public function __invoke(GetInvoiceList $getInvoiceList) : InvoicePdfList;
}
