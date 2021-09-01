namespace BolCom\RetailerApi\Model\Inventory {
    data Stock = SUFFICIENT | INSUFFICIENT deriving(Enum(useValue));
    data State = REGULAR | GRADED deriving(Enum(useValue));

    data InventoryOffer = InventoryOffer {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        string $bsku,
        int $gradedStock,
        int $regularStock,
        \BolCom\RetailerApi\Model\Offer\Title $title
    } deriving (ToArray, FromArray);

    data InventoryOfferList = InventoryOfferList {
        InventoryOffer[] $inventory
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
