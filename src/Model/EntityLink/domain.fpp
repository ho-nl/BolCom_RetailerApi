namespace BolCom\RetailerApi\Model\EntityLink {
    data Type = CART | ORDER | ORDER_ITEM | SHIPMENT | RETURN_ITEM | PROCESS_STATUS_CONFIRM_SHIPMENT deriving(Enum(useValue)) with (
            CART: 'cart',
            ORDER: 'order',
            ORDER_ITEM: 'order_item',
            SHIPMENT: 'shipment',
            RETURN_ITEM: 'return_item',
            PROCESS_STATUS_CONFIRM_SHIPMENT: 'process_status_confirm_shipment'
        );

    data InternalReference = Int deriving(FromScalar, ToScalar);

    data ExternalReference = String deriving(FromString, ToString);
}
