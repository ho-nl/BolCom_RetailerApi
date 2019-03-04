namespace BolCom\RetailerApi\Model\EntityLink {
    data Type = CART | ORDER | ORDER_ITEM | SHIPMENT | RETURN_ITEM | OFFER | PROCESS_STATUS_CONFIRM_SHIPMENT | PROCESS_STATUS_OFFER deriving(Enum(useValue)) with (
            CART: 'cart',
            ORDER: 'order',
            ORDER_ITEM: 'order_item',
            SHIPMENT: 'shipment',
            RETURN_ITEM: 'return_item',
            OFFER: 'offer',
            PROCESS_STATUS_CONFIRM_SHIPMENT: 'process_status_confirm_shipment',
            PROCESS_STATUS_OFFER: 'process_status_offer'
        );

    data InternalReference = Int deriving(FromScalar, ToScalar);

    data ExternalReference = String deriving(FromString, ToString);
}
