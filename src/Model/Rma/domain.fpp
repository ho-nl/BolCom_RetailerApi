//Note: actual entity name should be Return instead of Rma, but because Return is a protected keyword fpp chokes.
namespace BolCom\RetailerApi\Model\Rma {
    data ReturnId = String deriving(FromScalar, ToScalar);
    data RmaId = String deriving(FromScalar, ToScalar);

    data ReducedReturnItem = ReducedReturnItem {
        ?ReturnId $returnId,
        ?\BolCom\RetailerApi\Model\DateTime $registrationDateTime,
        ?\BolCom\RetailerApi\Model\Offer\FulfilmentMethod $fulfilmentMethod,
        ReturnItem[] $returnItems,
    } deriving (FromArray);

    data ReturnReason = ReturnReason {
        ?string $mainReason,
        ?string $detailedReason,
        ?string $customerComments
    } deriving (FromArray);

    data ReturnItem = ReturnItem {
        RmaId $rmaId,
        \BolCom\RetailerApi\Model\Order\OrderId $orderId,
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        ?string $title,
        ?int $expectedQuantity,
        ?ReturnReason $returnReason,
        ?\BolCom\RetailerApi\Model\Customer\CustomerDetails $customerDetails,
        bool $handled,
        ?\BolCom\RetailerApi\Model\Transport\TrackAndTrace $trackAndTrace,
        ?string $transporterName,
        ?ReturnProcessingResult[] $processingResults
    } deriving (FromArray);

    data ReturnProcessingResult = ReturnProcessingResult {
        ?int $quantity,
        ?ProcessingResult $processingResults,
        ?HandlingResult $handlingResult,
        ?\BolCom\RetailerApi\Model\DateTime $processingDateTime,
    } deriving (FromArray);

    data ReturnResult = ReturnResult {
        ReturnId $returnId,
        ?\BolCom\RetailerApi\Model\DateTime $registrationDateTime,
        ?\BolCom\RetailerApi\Model\Offer\FulfilmentMethod $fulfilmentMethod,
        ReturnItem[] $returnItems
    } deriving (FromArray);

    data ReturnItemList = ReturnItemList {
        ReducedReturnItem[] $returns
    } deriving (FromArray);

    data HandlingResult = RETURN_RECEIVED | EXCHANGE_PRODUCT | RETURN_DOES_NOT_MEET_CONDITIONS | REPAIR_PRODUCT
        | CUSTOMER_KEEPS_PRODUCT_PAID | STILL_APPROVED | CUSTOMER_KEEPS_PRODUCT_FREE_OF_CHARGE | RETURN_ITEM_LOST
        | EXPIRED | EXCESSIVE_RETURN | STILL_RECEIVED | CANCELLED_BY_CUSTOMER
        | FAILED_TO_CREATE_SHIPPING_LABEL deriving(Enum(useValue));

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
        \BolCom\RetailerApi\Model\Rma\ReturnId $returnId
    } deriving (Query);
}

namespace BolCom\RetailerApi\Model\Rma\Command {
    data HandleReturn = HandleReturn {
        \BolCom\RetailerApi\Model\Rma\RmaId $rmaId,
        \BolCom\RetailerApi\Model\Rma\HandlingResult $handlingResult,
        \BolCom\RetailerApi\Model\Rma\QuantityReturned $quantityReturned
    } deriving(Command);
}
