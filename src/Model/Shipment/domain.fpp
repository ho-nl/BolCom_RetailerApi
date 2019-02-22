namespace BolCom\RetailerApi\Model\Shipment {
    data ShipmentId = Int deriving(FromScalar, ToScalar);

    // @todo: Moved to \BolCom\RetailerApi\Model\Offer\FulfilmentMethod
    data FulfilmentMethod = FBR | FBB deriving(Enum(useValue));

    data Shipment = Shipment {
        ShipmentId $shipmentId,
        \BolCom\RetailerApi\Model\DateTime $shipmentDate,
        string $shipmentReference,
        ShipmentItem[] $shipmentItems,
        \BolCom\RetailerApi\Model\Transport\Transport $transport,
        \BolCom\RetailerApi\Model\Customer\CustomerDetails $customerDetails
    } deriving (FromArray);

    data ShipmentListItem = ShipmentListItem {
        \BolCom\RetailerApi\Model\Shipment\ShipmentId $shipmentId,
        \BolCom\RetailerApi\Model\DateTime $shipmentDate,
        ?string $shipmentReference,
        ShipmentItemListItem[] $shipmentItems,
    } deriving (FromArray);

    data ShipmentList = ShipmentList {
        ShipmentListItem[] $shipments
    } deriving (FromArray);

    data ShipmentItemListItem = ShipmentItemListItem {
        \BolCom\RetailerApi\Model\Order\OrderItemId $orderItemId,
        \BolCom\RetailerApi\Model\Order\OrderId $orderId
    } deriving (FromArray);

    data ShipmentItem = ShipmentItem {
        \BolCom\RetailerApi\Model\Order\OrderItemId $orderItemId,
        \BolCom\RetailerApi\Model\Order\OrderId $orderId,
        \BolCom\RetailerApi\Model\DateTime $orderDate,
        \BolCom\RetailerApi\Model\Date $latestDeliveryDate,
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        \BolCom\RetailerApi\Model\Offer\Title $title,
        \BolCom\RetailerApi\Model\Order\Quantity $quantity,
        \BolCom\RetailerApi\Model\CurrencyAmount $offerPrice,
        \BolCom\RetailerApi\Model\Offer\Condition $offerCondition,
        \BolCom\RetailerApi\Model\Offer\ReferenceCode $offerReference,
        FulfilmentMethod $fulfilmentMethod,
        ?\BolCom\RetailerApi\Model\Order\SelectedDeliveryWindow $selectedDeliveryWindow
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\Shipment\Query {
    data GetShipment = GetShipment {
        \BolCom\RetailerApi\Model\Shipment\ShipmentId $shipmentId
    } deriving (Query);

    data GetShipmentList = GetShipmentList {
        int $page,
        \BolCom\RetailerApi\Model\Shipment\FulfilmentMethod $fulfilmentMethod
    } deriving (Query);
}
