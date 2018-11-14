namespace BolCom\RetailerApi\Model\Inbound {
    data Reference = String deriving(FromString, ToString);
    data State = Draft | PreAnnounced | ArrivedAtWH | Cancelled deriving(Enum(useValue));
    data BSku = String deriving(FromString, ToString);

    data InboundList = InboundList {
        int $totalCount,
        int $totalPageCount,
        Inbound[] $inbounds
    } deriving(FromArray);

    data InboundId = Int deriving(FromScalar, ToScalar);
    data Inbound = Inbound {
        InboundId $id,
        Reference $reference,
        ?\BolCom\RetailerApi\Model\DateTime $creationDate,
        State $state,
        bool $labellingService,
        int $announcedBSKUs,
        int $announcedQuantity,
        int $receivedBSKUs,
        int $receivedQuantity,
        Timeslot $timeslot,
        Product[] $products,
        StateTransition[] $stateTransitions,
        Transporter $fbbTransporter
    } deriving(FromArray);

    data Product = Product {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        BSku $bsku,
        int $announcedQuantity,
        int $receivedQuantity,
        State $state
    } deriving (FromArray);

    data Timeslot = Timeslot {
        \BolCom\RetailerApi\Model\DateTime $start,
        \BolCom\RetailerApi\Model\DateTime $end
    } deriving (FromArray);

    data TimeslotList = TimeslotList {
        Timeslot[] $timeslot
    } deriving (FromArray);

    data StateTransition = StateTransition {
        State $state,
        \BolCom\RetailerApi\Model\DateTime $stateDate
    } deriving (FromArray);

    data Transporter = Transporter {
        \BolCom\RetailerApi\Model\Transport\TransporterName $name,
        \BolCom\RetailerApi\Model\Transport\TransporterCode $code
    } deriving (FromArray);

    data ItemsToSend = Int deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::min($value, 1) => '';

    data FbbTransporters = FbbTransporters {
        Transporter[] $fbbTransporters
    };

    data ProductLabelFormat = AVERY_J8159 | AVERY_J8160 | AVERY_3474 | DYMO_99012 | BROTHER_DK11208D | ZEBRA_Z_PERFORM_1000T deriving(Enum(useValue));

    data ProductLabel = ProductLabel {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        int $quantity
    } deriving (FromArray);

    data InventoryQuantityInput = String deriving(FromString, ToString) where
        _: | !\BolCom\RetailerApi\Model\Assert\AssertIntRange::assert($value) => '';

    data InventoryStock = sufficient | insufficient deriving(Enum(useValue));
    data InventoryState = salable | unsalable deriving(Enum(useValue));

    data InventoryList = InventoryList {
        int $totalCount,
        int $totalPageCount,
        InventoryOffer[] $offers
    } deriving (FromArray);

    data InventoryOffer = InventoryOffer {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        BSku $bsku,
        int $nckStock,
        int $stock,
        string $title
    } deriving (FromArray);

    data PackingList = PackingList {
        array $packingList
    } deriving (FromArray);

    data FbbShippingLabelList = FbbShippingLabelList {
        array $labels
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\Inbound\Query {
    data GetInbound = GetInbound {
        \BolCom\RetailerApi\Model\Inbound\InboundId $inboundId
    } deriving (Query);

    data GetInboundList = GetInboundList {
        ?\BolCom\RetailerApi\Model\Inbound\Reference $reference,
        ?\BolCom\RetailerApi\Model\Inbound\BSku $bsku,
        ?\BolCom\RetailerApi\Model\Date $creationStart,
        ?\BolCom\RetailerApi\Model\Date $creationEnd,
        ?\BolCom\RetailerApi\Model\Inbound\State $state,
        ?int $page
    } deriving (Query);

    data GetDeliveryWindows = GetDeliveryWindow {
        ?\BolCom\RetailerApi\Model\DateTime $deliveryDate,
        ?\BolCom\RetailerApi\Model\Inbound\ItemsToSend $itemsToSend,
    } deriving (Query);

    data GetFbbTransporterList = GetFbbTransporterList {
    } deriving (Query);

    data GetProductLabelsByEan = GetProductLabelsByEan {
        \BolCom\RetailerApi\Model\Inbound\ProductLabelFormat $format,
        \BolCom\RetailerApi\Model\Inbound\ProductLabel[] $productLabels
    } deriving (Query);

    data GetPackingList = GetPackingList {
        \BolCom\RetailerApi\Model\Inbound\InboundId $inboundId
    } deriving (Query);

    data GetFbbShippingLabel = GetFbbShippingLabel {
        \BolCom\RetailerApi\Model\Inbound\InboundId $inboundId
    } deriving (Query);

    data GetInventoryList = GetInventoryList {
        int $page,
        \BolCom\RetailerApi\Model\Inbound\InventoryQuantityInput $quantity,
        \BolCom\RetailerApi\Model\Inbound\InventoryStock $stock,
        \BolCom\RetailerApi\Model\Inbound\InventoryState $state,
        string $query
    } deriving (Query);
}

namespace BolCom\RetailerApi\Model\Inbound\Command {
    data CreateInbound = CreateInbound {
        ?\BolCom\RetailerApi\Model\Inbound\Reference $reference,
        \BolCom\RetailerApi\Model\Inbound\Timeslot $timeslot,
        \BolCom\RetailerApi\Model\Inbound\Transporter $fbbTransporter,
        bool $labellingService,
        \BolCom\RetailerApi\Model\Inbound\Product[] $products
    } deriving (Command);
}
