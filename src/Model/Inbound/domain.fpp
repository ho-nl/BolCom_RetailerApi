namespace BolCom\RetailerApi\Model\Inbound {
    data Reference = String deriving(FromString, ToString);
    data State = Draft | PreAnnounced | ArrivedAtWH | Cancelled deriving(Enum);
    data BSku = String deriving(FromString, ToString);

    data ShipmentList = GetShipmentListResponse {
        int $totalCount,
        int $totalPageCount
    };

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
    };

    data Product = Product {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        BSku $bsku,
        int $announcedQuantity,
        int $receivedQuantity,
        State $state
    };

    data Timeslot = Timeslot {
        \BolCom\RetailerApi\Model\DateTime $start,
        \BolCom\RetailerApi\Model\DateTime $end
    };

    data StateTransition = StateTransition {
        State $state,
        \BolCom\RetailerApi\Model\DateTime $stateDate
    };

    data Transporter = Transporter {
        \BolCom\RetailerApi\Model\Transport\TransporterName $name,
        \BolCom\RetailerApi\Model\Transport\TransporterCode $code
    };

    data ItemsToSend = Int deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::min($value, 1) => '';

    data FbbTransporters = FbbTransporters {
        Transporter[] $fbbTransporters
    };

    data ProductLabelFormat = AveryJ8159 | AveryJ8160 | Avery3474 | Dymo99012 | BrotherDK11208D | ZebraZPerform1000T deriving(Enum) with(
        AveryJ8159: "AVERY_J8159",
        AveryJ8160: "AVERY_J8160",
        Avery3474: "AVERY_3474",
        Dymo99012: "DYMO_99012",
        BrotherDK11208D: "BROTHER_DK11208D",
        ZebraZPerform1000T: "ZEBRA_Z_PERFORM_1000T"
    );
    data ProductLabel = ProductLabel {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        int $quantity
    };

    data InventoryQuantityInput = String deriving(FromString, ToString) where
        _: | !\BolCom\RetailerApi\Model\Assert\AssertIntRange::execute($value) => '';

    data InventoryStock = sufficient | insufficient deriving(Enum);
    data InventoryState = salable | unsalable deriving(Enum);
}

namespace BolCom\RetailerApi\Model\Inbound\Query {
    data GetInbound = GetInbound {
        \BolCom\RetailerApi\Model\Inbound\InboundId $inboundId
    };

    data GetInboundList = GetInboundList {
        ?\BolCom\RetailerApi\Model\Inbound\Reference $reference,
        ?\BolCom\RetailerApi\Model\Inbound\BSku $bsku,
        ?\BolCom\RetailerApi\Model\Date $creationStart,
        ?\BolCom\RetailerApi\Model\Date $creationEnd,
        ?\BolCom\RetailerApi\Model\Inbound\State $state,
        ?int $page
    };

    data GetDeliveryWindows = GetDeliveryWindow {
        ?\BolCom\RetailerApi\Model\DateTime $deliveryDate,
        ?ItemsToSend $itemsToSend,
    };

    data GetFbbTransporterList = GetFbbTransporterList {
    };

    data GetProductLabelsByEan = GetProductLabelsByEan {
        ProductLabelFormat $format,
        ProductLabel[] $productLabels
    };

    data GetPackingList = GetPackingList {
        \BolCom\RetailerApi\Model\Inbound\InboundId $inboundId
    };

    data GetFbbShippingLabel = GetFppShippingLabel {
        \BolCom\RetailerApi\Model\Inbound\InboundId $inboundId
    };

    data GetInventory = GetInventory {
        int $page,
        \BolCom\RetailerApi\Model\Inbound\InventoryQuantityInput $quantity,
        \BolCom\RetailerApi\Model\Inbound\InventoryStock $stock,
        \BolCom\RetailerApi\Model\Inbound\InventoryState $state,
        string $query
    };
}

namespace BolCom\RetailerApi\Model\Inbound\Command {
    data CreateShipment = CreateShipment {
        ?\BolCom\RetailerApi\Model\Inbound\Reference $reference,
        Timeslot $timeslot,
        Transporter $fbbTransporter,
        bool $labellingService,
        Product[] $products
    };
}
