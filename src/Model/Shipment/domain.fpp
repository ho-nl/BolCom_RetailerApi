namespace BolCom\RetailerApi\Model\Shipment {
    data ShipmentId = Int deriving(FromScalar, ToScalar);

    data Shipment = Shipment {
        ShipmentId $shipmentId,
        \BolCom\RetailerApi\Model\DateTime $shipmentDate,
        string $shipmentReference,
        ShipmentItem[] $shipmentItems,
        \BolCom\RetailerApi\Model\Transport\Transport $transport,
        \BolCom\RetailerApi\Model\Customer\CustomerDetails $customerDetails
    };

    data ShipmentItem = ShipmentItem {
        ShipmentOrderItem $shipmentOrderItem
    };

    data ShipmentOrderItem = ShipmentOrderItem {
        \BolCom\RetailerApi\Model\Order\OrderItemId $orderItemId,
        \BolCom\RetailerApi\Model\Order\OrderId $orderId,
        \BolCom\RetailerApi\Model\DateTime $orderDate,
        \BolCom\RetailerApi\Model\Date $latestDeliveryDate,
        \BolCom\RetailerApi\Model\Ean $ean,
        \BolCom\RetailerApi\Model\Offer\Title $title,
        \BolCom\RetailerApi\Model\Order\Quantity $quantity,
        \BolCom\RetailerApi\Model\Offer\Price $offerPrice,
        \BolCom\RetailerApi\Model\Offer\Condition $offerCondition,
        \BolCom\RetailerApi\Model\Offer\ReferenceCode $offerReference,
        \BolCom\RetailerApi\Model\FulfilmentMethod $fulfilmentMethod,
        \BolCom\RetailerApi\Model\Order\SelectedDeliveryWindow $selectedDeliveryWindow
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\Shipment\Query {
    data GetShipment = GetShipment {
        \BolCom\RetailerApi\Model\Shipment\ShipmentId $shipmentId
    };

    data GetShipmentList = GetShipmentList {
        int $page,
        \BolCom\RetailerApi\Model\FulfilmentMethod $fulfilmentMethod,
        \BolCom\RetailerApi\Model\Order\OrderId $orderid
    };
}

namespace BolCom\RetailerApi\Model\Shipment\Command {

}
