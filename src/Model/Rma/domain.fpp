//Note: actual entity name should be Return instead of Rma, but because Return is a protected keyword fpp chokes.
namespace BolCom\RetailerApi\Model\Rma {
    data ReturnNumber = Int deriving(FromScalar, ToScalar);

    data ReturnItem = ReturnItem {
        ReturnNumber $returnNumber,
        \BolCom\RetailerApi\Model\Order\OrderId $orderId,
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        string $title,
        \BolCom\RetailerApi\Model\DateTime $registrationDateTime,
        string $returnReason, //Enum?
        string $returnReasonComments,
        \BolCom\RetailerApi\Model\Customer\CustomerDetails $customerDetails,
        \BolCom\RetailerApi\Model\Shipment\FulfilmentMethod $fulfilmentMethod,
        bool $handled,
        \BolCom\RetailerApi\Model\Transport\TrackAndTrace $trackAndTrace,
        HandlingResult $handlingResult,
        ProcessingResult $processingResult,
        \BolCom\RetailerApi\Model\DateTime $processingDateTime
    } deriving (FromArray);

    data ReturnItemList = ReturnItemList {
        ReturnItem[] $returns
    } deriving (FromArray);

    data HandlingResult = ReturnReceived | ExchangeProduct | ProductDoesNotMeetConditions | RepairProduct | CustomerKeepsProductPaid | StillApproved deriving(Enum) with (
        ReturnReceived: "RETURN_RECEIVED",
        ExchangeProduct: "EXCHANGE_PRODUCT",
        ProductDoesNotMeetConditions: "RETURN_DOES_NOT_MEET_CONDITIONS",
        RepairProduct: "REPAIR_PRODUCT",
        CustomerKeepsProductPaid: "CUSTOMER_KEEPS_PRODUCT_PAID",
        StillApproved: "STILL_APPROVED"
    );

    data ProcessingResult = Pending | Accepted | Rejected deriving(Enum) with (
        Pending: "PENDING",
        Accepted: "ACCEPTED",
        Rejected: "REJECTED"
    );

    data QuantityReturned = Int deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 9999) => '';
}

namespace BolCom\RetailerApi\Model\Rma\Query {
    data GetAllReturns = GetAllReturns {
        int $page,
        bool $handled,
        \BolCom\RetailerApi\Model\Shipment\FulfilmentMethod $shipmentsMethod
    };
}

namespace BolCom\RetailerApi\Model\Rma\Command {
    data HandleReturn = HandleReturn {
        BolCom\RetailerApi\Model\Rma\ReturnNumber $returnNumber,
        BolCom\RetailerApi\Model\Rma\HandlingResult $handlingResult,
        QuantityReturned $quantityReturned
    }
}
