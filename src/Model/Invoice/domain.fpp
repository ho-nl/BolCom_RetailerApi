namespace BolCom\RetailerApi\Model\Invoice {
    data Period = String deriving(FromString, ToString) where
        _: | !\BolCom\RetailerApi\Model\Assert\AssertDateRange::execute($value) => 'Could not create period';

    data InvoiceId = Int deriving(FromScalar, ToScalar);

    data InvoicePdf = String deriving(FromString, ToString);
    data InvoicePdfList = InvoicePdfList {
        InvoicePdf[] $pdfs
    } deriving(FromArray);

    data InvoiceSpecificationPdf = String deriving(FromString, ToString);
    data InvoiceSpecificationPdfList = InvoiceSpecificationPdfList {
        InvoiceSpecificationPdf[] $pdfs
    } deriving(FromArray);
}

namespace BolCom\RetailerApi\Model\Invoice\Query {
    data GetInvoice = GetInvoice {
        \BolCom\RetailerApi\Model\Invoice\InvoiceId $invoiceId
    } deriving (Query);

    data GetInvoiceList = GetInvoiceList {
        ?\BolCom\RetailerApi\Model\Invoice\Period $period
    } deriving (Query);

    data GetInvoiceSpecification = GetInvoiceSpecification {
        \BolCom\RetailerApi\Model\Invoice\InvoiceId $invoiceId,
        ?int $page
    } deriving (Query);
}
