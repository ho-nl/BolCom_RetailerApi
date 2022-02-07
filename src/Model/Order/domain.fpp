namespace BolCom\RetailerApi\Model\Order {
    data OrderId = String deriving(FromString, ToString);

    data Order = Order {
        OrderId $orderId,
        \BolCom\RetailerApi\Model\DateTime $orderPlacedDateTime,
        AddressDetails $shipmentDetails,
        AddressDetails $billingDetails,
        OrderItem[] $orderItems,
    } deriving (FromArray);

    data OrderListItem = OrderListItem {
        OrderId $orderId,
        \BolCom\RetailerApi\Model\DateTime $orderPlacedDateTime
    } deriving (FromArray);

    data OrderList = OrderList {
        OrderListItem[] $orders
    } deriving (FromArray);

    data Salutation = MALE | FEMALE | UNKNOWN deriving(Enum(useValue)) with (MALE:'MALE', FEMALE:'FEMALE', UNKNOWN:'UNKNOWN');

    data AddressDetails = AddressDetails {
        Salutation $salutation,
        ?string $firstName,
        ?string $surname,
        string $streetName,
        string $houseNumber,
        ?string $houseNumberExtension,
        ?string $extraAddressInformation,
        string $zipCode,
        string $city,
        string $countryCode,
        ?string $email,
        ?string $company,
        ?string $kvkNumber,
        ?string $deliveryPhoneNumber
    } deriving (FromArray);

    data OrderItemId = String deriving(FromString, ToString);

    data Quantity = Int deriving(FromScalar, ToScalar);

    data DistributionParty = RETAILER | BOL deriving(Enum(useValue));

    data OrderFulfilmemt = OrderFulfilmemt {
        ?\BolCom\RetailerApi\Model\Offer\FulfilmentMethod $method,
        ?DistributionParty $distributionParty,
        ?\BolCom\RetailerApi\Model\Date $latestDeliveryDate,
        ?\BolCom\RetailerApi\Model\Date $exactDeliveryDate,
        ?\BolCom\RetailerApi\Model\Date $expiryDate

    } deriving (FromArray);

    data OrderOffer = OrderOffer {
        \BolCom\RetailerApi\Model\Offer\OfferId $offerId,
        ?\BolCom\RetailerApi\Model\Offer\Reference $reference

    } deriving (FromArray);

    data OrderProduct = OrderProduct {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        string $title,

    } deriving (FromArray);

    data Price = Float deriving(FromScalar, ToScalar) where
        _: | !\BolCom\RetailerApi\Model\Assert\AssertCurrency::assert($value) => ''
           | !\Assert\Assertion::between($value, 1, 9999, 'Price must be between 1 and 9999.') => '';

    data OrderItem = OrderItem {
        OrderItemId $orderItemId,
        OrderFulfilmemt $fulfilment,
        OrderOffer $offer,
        OrderProduct $product,
        Quantity $quantity,
        ?Quantity $quantityShipped,
        ?Quantity $quantityCancelled,
        Price $unitPrice,
        \BolCom\RetailerApi\Model\CurrencyAmount $commission,
        ?bool $cancellationRequest,
        ?SelectedDeliveryWindow $selectedDeliveryWindow
    } deriving (FromArray);

    data SelectedDeliveryWindow = SelectedDeliveryWindow {
        \BolCom\RetailerApi\Model\Date $date,
        \BolCom\RetailerApi\Model\DateTime $start,
        \BolCom\RetailerApi\Model\DateTime $end
    } deriving (FromArray);

    data CancellationReason = OUT_OF_STOCK | REQUESTED_BY_CUSTOMER | BAD_CONDITION | HIGHER_SHIPCOST | INCORRECT_PRICE | NOT_AVAIL_IN_TIME | NO_BOL_GUARANTEE | ORDERED_TWICE | RETAIN_ITEM | TECH_ISSUE | UNFINDABLE_ITEM | OTHER deriving(Enum(useValue));
}

namespace BolCom\RetailerApi\Model\Order\Query {
    data GetOrder = GetOrder {
        \BolCom\RetailerApi\Model\Order\OrderId $orderId
    } deriving (Query);

    data GetAllOpenOrders = GetAllOpenOrders {
        int $page,
        \BolCom\RetailerApi\Model\Offer\FulfilmentMethod $fulfilmentMethod
    } deriving (Query);
}

namespace BolCom\RetailerApi\Model\Order\Command {
    data CancelOrder = CancelOrder {
        CancelOrderItem[] $orderItems
    } deriving (Query);

    data CancelOrderItem = CancelOrderItem {
        \BolCom\RetailerApi\Model\Order\OrderItemId $orderItemId,
        \BolCom\RetailerApi\Model\Order\CancellationReason $reasonCode
    } deriving (FromArray, ToArray);

    data ShipOrderItems = ShipOrderItems {
        ShipOrderItem[] $orderItems,
        ?string $shipmentReference,
        ?string $shippingLabelId,
        ?\BolCom\RetailerApi\Model\Transport\TransportInstruction $transport
    } deriving (Query);

    data ShipOrderItem = ShipOrderItem {
        \BolCom\RetailerApi\Model\Order\OrderItemId $orderItemId,
    } deriving (FromArray, ToArray);
}
