namespace BolCom\RetailerApi\Model\ProcessStatus {
    data EntityId = String deriving (FromString, ToString);

    data EventType = CREATE_OFFER
        | CONFIRM_SHIPMENT
        | CANCEL_ORDER
        | CHANGE_TRANSPORT
        | HANDLE_RETURN_ITEM
        | CREATE_INBOUND
    deriving(Enum(useValue));

    data EventStatus = PENDING | SUCCESS | FAILURE | TIMEOUT deriving(Enum(useValue));

    data ProcessStatus = ProcessStatus {
        int $id,
        ?EntityId $entityId,
        EventType $eventType,
        string $description,
        EventStatus $status,
        ?string $errorMessage,
        \BolCom\RetailerApi\Model\DateTime $createTimestamp
    } deriving (FromArray);

    data ProcessStatuses = ProcessStatuses {
        ProcessStatus[] $processStatuses
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\ProcessStatus\Query {
    data GetStatusByEntity = GetStatusByEntity {
        \BolCom\RetailerApi\Model\ProcessStatus\EntityId $entityId,
        \BolCom\RetailerApi\Model\ProcessStatus\EventType $eventType,
        int $page
    } deriving (Query);

    data GetStatusByProcessIds = GetStatusByProcessIds {
        int[] $ids
    } deriving (Query);
}
