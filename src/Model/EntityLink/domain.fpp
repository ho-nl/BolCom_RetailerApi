namespace BolCom\RetailerApi\Model\EntityLink {
    data Type = CART | CART_ITEM | ORDER deriving(Enum(useValue)) with (
            CART: 'cart',
            CART_ITEM: 'cart_item',
            ORDER: 'order'
        );

    data InternalReference = Int deriving(FromScalar, ToScalar);

    data ExternalReference = String deriving(FromString, ToString);
}
