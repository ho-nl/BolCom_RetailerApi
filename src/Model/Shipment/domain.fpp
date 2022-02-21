namespace BolCom\RetailerApi\Model\Shipment {
    data ShipmentId = String deriving(FromScalar, ToScalar);

    data Shipment = Shipment {
        ShipmentId $shipmentId,
        \BolCom\RetailerApi\Model\DateTime $shipmentDateTime,
        ?string $shipmentReference,
        ShipmentOrder $order,
        ShipmentItem[] $shipmentItems,
        ?\BolCom\RetailerApi\Model\Transport\Transport $transport,
        ?AddressDetails $shipmentDetails,
        ?AddressDetails $billingDetails
    } deriving (FromArray);

    data AddressDetails = AddressDetails {
        ?string $salutation,
        ?string $firstName,
        ?string $surname,
        ?string $streetName,
        ?string $houseNumber,
        ?string $houseNumberExtension,
        ?string $extraAddressInformation,
        string $zipCode,
        ?string $city,
        string $countryCode,
        ?string $email,
        ?string $company,
        ?string $kvkNumber,
        ?string $pickUpPointName
    } deriving (FromArray);

    data ShipmentOrder = ShipmentOrder {
        ?\BolCom\RetailerApi\Model\Order\OrderId $orderId,
        ?\BolCom\RetailerApi\Model\DateTime $orderPlacedDateTime,
    } deriving (FromArray);

    data ShipmentListItem = ShipmentListItem {
        \BolCom\RetailerApi\Model\Shipment\ShipmentId $shipmentId,
        \BolCom\RetailerApi\Model\DateTime $shipmentDateTime,
        ?string $shipmentReference,
        ShipmentOrder $order,
        ShipmentItemListItem[] $shipmentItems,
        \BolCom\RetailerApi\Model\Transport\ReducedTransport $transport
    } deriving (FromArray);

    data ShipmentList = ShipmentList {
        ShipmentListItem[] $shipments
    } deriving (FromArray);

    data ShipmentItemListItem = ShipmentItemListItem {
        \BolCom\RetailerApi\Model\Order\OrderItemId $orderItemId,
        ?\BolCom\RetailerApi\Model\Offer\Ean $ean
    } deriving (FromArray);

    data Offer = Offer {
        \BolCom\RetailerApi\Model\Offer\OfferId $offerId,
        \BolCom\RetailerApi\Model\Offer\Reference $reference,

    } deriving (FromArray);

    data ShipmentItem = ShipmentItem {
        \BolCom\RetailerApi\Model\Order\OrderItemId $orderItemId,
        ?ShipmentOrder $order,
        Offer $offer,
        Product $product,
        \BolCom\RetailerApi\Model\Order\Quantity $quantity,
        \BolCom\RetailerApi\Model\CurrencyAmount $unitPrice,
        ?\BolCom\RetailerApi\Model\CurrencyAmount $commission,
        ShipmentFulfilmemt $fulfilment,
        ?\BolCom\RetailerApi\Model\Order\SelectedDeliveryWindow $selectedDeliveryWindow
    } deriving (FromArray);

    data Product = Product {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        \BolCom\RetailerApi\Model\Offer\Title $title
    } deriving (FromArray);

    data DistributionParty = RETAILER | BOL deriving(Enum(useValue));

    data ShipmentFulfilmemt = ShipmentFulfilmemt {
        ?\BolCom\RetailerApi\Model\Offer\FulfilmentMethod $method,
        ?DistributionParty $distributionParty,
        ?\BolCom\RetailerApi\Model\Date $latestDeliveryDate
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\Shipment\Query {
    data GetShipment = GetShipment {
        \BolCom\RetailerApi\Model\Shipment\ShipmentId $shipmentId
    } deriving (Query);

    data GetShipmentList = GetShipmentList {
        int $page,
        ?\BolCom\RetailerApi\Model\Offer\FulfilmentMethod $fulfilmentMethod,
        ?\BolCom\RetailerApi\Model\Order\OrderId $orderId
    } deriving (Query);
}
