<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Invoice\QueryHandler;

use BolCom\RetailerApi\Model\Invoice\InvoiceSpecificationPdfList;
use BolCom\RetailerApi\Model\Invoice\Query\GetInvoiceSpecification;

interface GetInvoiceSpecificationHandlerInterface
{
    public function __invoke(GetInvoiceSpecification $getInvoiceSpecification) : InvoiceSpecificationPdfList;
}
