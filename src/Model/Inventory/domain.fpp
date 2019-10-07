namespace BolCom\RetailerApi\Model\Inventory {
    data Stock = SUFFICIENT | INSUFFICIENT deriving(Enum(useValue)) with (SUFFICIENT:'sufficient', INSUFFICIENT:'insufficient');
    data State = SALEABLE | UNSALEABLE deriving(Enum(useValue)) with (SALEABLE:'saleable', UNSALEABLE:'unsaleable');

    data InventoryOffer = InventoryOffer {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        string $bsku,
        int $nckStock,
        int $stock,
        \BolCom\RetailerApi\Model\Offer\Title $title
    } deriving (ToArray, FromArray);

    data InventoryOfferList = InventoryOfferList {
        InventoryOffer[] $offers
    } deriving (ToArray, FromArray);
}

namespace BolCom\RetailerApi\Model\Inventory\Query {
    data GetInventory = GetInventory {
        ?int $page,
        ?string $query,
        ?\BolCom\RetailerApi\Model\Inventory\Stock $stock,
        ?\BolCom\RetailerApi\Model\Inventory\State $state,
        ?string[] $quantity
    } deriving (Query);
}
