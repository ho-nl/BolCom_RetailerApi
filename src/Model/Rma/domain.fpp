//Note: actual entity name should be Return instead of Rma, but because Return is a protected keyword fpp chokes.
namespace BolCom\RetailerApi\Model\Rma {
    data RmaId = Int deriving(FromScalar, ToScalar);

    data ReducedReturnItem = ReducedReturnItem {
        RmaId $rmaId,
        \BolCom\RetailerApi\Model\Order\OrderId $orderId,
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        int $quantity,
        \BolCom\RetailerApi\Model\DateTime $registrationDateTime,
        string $returnReason,
        ?string $returnReasonComments,
        \BolCom\RetailerApi\Model\Offer\FulfilmentMethod $fulfilmentMethod,
        bool $handled,
        ?HandlingResult $handlingResult,
        ?ProcessingResult $processingResult,
        ?\BolCom\RetailerApi\Model\DateTime $processingDateTime
    } deriving (FromArray);

    data ReturnItem = ReturnItem {
        RmaId $rmaId,
        \BolCom\RetailerApi\Model\Order\OrderId $orderId,
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        string $title,
        int $quantity,
        \BolCom\RetailerApi\Model\DateTime $registrationDateTime,
        string $returnReason,
        ?string $returnReasonComments,
        ?\BolCom\RetailerApi\Model\Customer\CustomerDetails $customerDetails,
        \BolCom\RetailerApi\Model\Offer\FulfilmentMethod $fulfilmentMethod,
        bool $handled,
        ?\BolCom\RetailerApi\Model\Transport\TrackAndTrace $trackAndTrace,
        ?HandlingResult $handlingResult,
        ?ProcessingResult $processingResult,
        ?\BolCom\RetailerApi\Model\DateTime $processingDateTime
    } deriving (FromArray);

    data ReturnItemList = ReturnItemList {
        ReducedReturnItem[] $returns
    } deriving (FromArray);

    data HandlingResult = RETURN_RECEIVED | EXCHANGE_PRODUCT | RETURN_DOES_NOT_MEET_CONDITIONS | REPAIR_PRODUCT
        | CUSTOMER_KEEPS_PRODUCT_PAID | STILL_APPROVED | CUSTOMER_KEEPS_PRODUCT_FREE_OF_CHARGE | RETURN_ITEM_LOST
        | EXPIRED | EXCESSIVE_RETURN | STILL_RECEIVED | CANCELLED_BY_CUSTOMER
        | FAILED_TO_COLLECT_BY_TRANSPORTER deriving(Enum(useValue));

    data ProcessingResult = PENDING | ACCEPTED | REJECTED | CANCELLED deriving(Enum(useValue));

    data QuantityReturned = Int deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::between($value, 1, 9999) => '';
}

namespace BolCom\RetailerApi\Model\Rma\Query {
    data GetAllReturns = GetAllReturns {
        int $page,
        bool $handled,
        \BolCom\RetailerApi\Model\Offer\FulfilmentMethod $fulfilmentMethod
    } deriving (Query);

    data GetReturn = GetReturn {
        \BolCom\RetailerApi\Model\Rma\RmaId $rmaId
    } deriving (Query);
}

namespace BolCom\RetailerApi\Model\Rma\Command {
    data HandleReturn = HandleReturn {
        \BolCom\RetailerApi\Model\Rma\RmaId $rmaId,
        \BolCom\RetailerApi\Model\Rma\HandlingResult $handlingResult,
        \BolCom\RetailerApi\Model\Rma\QuantityReturned $quantityReturned
    } deriving(Command);
}
