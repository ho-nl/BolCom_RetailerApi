// @TODO Domain is very incomplete

namespace BolCom\RetailerApi\Model\Inbound {
    data Reference = String deriving(FromString, ToString);
    data State = Draft | PreAnnounced | ArrivedAtWH | Cancelled deriving(Enum);
    data BSku = String deriving(FromString, ToString);
}

namespace BolCom\RetailerApi\Model\Inbound\Query {
    data GetShipmentList = GetShipmentList {
        \BolCom\RetailerApi\Model\Inbound\Reference $reference,
        \BolCom\RetailerApi\Model\Inbound\BSku $bsku,
        \BolCom\RetailerApi\Model\Date $creationStart,
        \BolCom\RetailerApi\Model\Date $creationEnd,
        \BolCom\RetailerApi\Model\Inbound\State $state,
        int $page
    };

    data GetShipmentListResponse = GetShipmentListResponse {
        int $totalCount,
        int $totalPageCount
    };
}

namespace BolCom\RetailerApi\Model\Inbound\Command {
    data CreateShipment = CreateShipment {
        \BolCom\RetailerApi\Model\Inbound\Reference $reference
    };
}
