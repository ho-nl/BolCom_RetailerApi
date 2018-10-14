<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Invoice\QueryHandler;

use BolCom\RetailerApi\Model\Invoice\InvoicePdf;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoice;

interface GetInvoiceHandlerInterface
{
    public function __invoke(GetInvoice $getInvoice) : InvoicePdf;
}
