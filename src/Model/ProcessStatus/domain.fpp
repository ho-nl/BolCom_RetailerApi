namespace BolCom\RetailerApi\Model\ProcessStatus {
    data Id = String deriving(FromString, ToString);
    data EntityId = String deriving (FromString, ToString);

    data EventType = ConfirmShipment | CancelOrder | ChangeTransport | HandleReturnItem | CreateInbound deriving(Enum) with (
        ConfirmShipment: "CONFIRM_SHIPMENT",
        CancelOrder: "CANCEL_ORDER",
        ChangeTransport: "CHANGE_TRANSPORT",
        HandleReturnItem: "HANDLE_RETURN_ITEM",
        CreateInbound: "CREATE_INBOUND"
    );

    data EventStatus = Pending | Success | Failure | Timeout deriving(Enum) with (
        Pending: "PENDING",
        Success: "SUCCESS",
        Failure: "FAILURE",
        Timeout: "TIMEOUT"
    );

    data ProcessStatus = ProcessStatus {
        Id $id,
        EntityId $entityId,
        string $description,
        EventStatus $status,
        string $errorMessage,
        \BolCom\RetailerApi\Model\DateTime $createTimestamp
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\ProcessStatus\Query {
    data GetStatusByEntity = GetStatusByEntity {
        \BolCom\RetailerApi\Model\ProcessStatus\EntityId $entityId,
        \BolCom\RetailerApi\Model\ProcessStatus\EventType $eventType,
        int $page
    };

    data GetStatusByProcessId = GetStatusByProcessId {
        \BolCom\RetailerApi\Model\ProcessStatus\Id $id
    }
}
