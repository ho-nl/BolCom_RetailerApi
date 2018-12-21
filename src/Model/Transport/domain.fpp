namespace BolCom\RetailerApi\Model\Transport {
    data TransportId = Int deriving(FromScalar, ToScalar);

    data TransporterName = String deriving(FromScalar, ToScalar);

    data TransporterCode = BRIEFPOST | UPS | TNT | TNT_EXTRA | TNT_BRIEF | TNT_EXPRESS | DYL | DPD_NL | DPD_BE | BPOST_BE |
          BPOST_BRIEF | DHLFORYOU | GLS | FEDEX_NL | FEDEX_BE | OTHER | DHL | DHL_DE | DHL_GLOBAL_MAIL | TSN | FIEGE |
          TRANSMISSION | PARCEL_NL | LOGOIX | PACKS | COURIER | RJP deriving(Enum(useValue)) with (
            BRIEFPOST: "BRIEFPOST",
            UPS: "UPS",
            TNT: "TNT",
            TNT_EXTRA: "TNT-EXTRA",
            TNT_BRIEF: "TNT_BRIEF",
            TNT_EXPRESS: "TNT-EXPRESS",
            DYL: "DYL",
            DPD_NL: "DPD-NL",
            DPD_BE: "DPD-BE",
            BPOST_BE: "BPOST_BE",
            BPOST_BRIEF: "BPOST_BRIEF",
            DHLFORYOU: "DHLFORYOU",
            GLS: "GLS",
            FEDEX_NL: "FEDEX_NL",
            FEDEX_BE: "FEDEX_BE",
            OTHER: "OTHER",
            DHL: "DHL",
            DHL_DE: "DHL_DE",
            DHL_GLOBAL_MAIL: "DHL-GLOBAL-MAIL",
            TSN: "TSN",
            FIEGE: "FIEGE",
            TRANSMISSION: "TRANSMISSION",
            PARCEL_NL: "PARCEL-NL",
            LOGOIX: "LOGOIX",
            PACKS: "PACKS",
            COURIER: "COURIER",
            RJP: "RJP"
          );

    data TrackAndTrace = String deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::betweenLength($value, 4, 50) => '';

    data TransportInstruction = TransportInstruction {
        TransporterCode $transporterCode,
        ?TrackAndTrace $trackAndTrace
    } deriving (FromArray, ToArray) where
        _: | $trackAndTrace === null && !\Assert\Assertion::choice($transporterCode->toString(), [TransporterCode::BRIEFPOST, TransporterCode::OTHER], 'Track & Trace cannot be left empty for this Transporter Code.') => '';

    data Transport = Transport {
        TransportId $transportId,
        TransporterCode $transporterCode,
        ?TrackAndTrace $trackAndTrace
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\Transport\Command {
    data AddTransportInformation = AddTransportInformation {
        TransportId $transportId,
        TransporterCode $transporterCode,
        ?TrackAndTrace $trackAndTrace
    };
}

namespace BolCom\RetailerApi\Model\Transport\Query {
    data GetShippingLabel = GetShippingLabel {
        \BolCom\RetailerApi\Model\Transport\TransportId $transportId
    } deriving (Query);
}
