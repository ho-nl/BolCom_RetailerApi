namespace BolCom\RetailerApi\Model\Transport {
    data TransportId = Int deriving(FromScalar, ToScalar);

    data TransporterName = String deriving(FromScalar, ToScalar);

    data TransporterCode = Briefpost | Ups | Tnt | TntExtra | TntBrief | TntExpress | Dyl | DpdNl | DpdBe | BPostBe |
          BpostBrief | Dhlforyou | Gls | FedexNl | FedexBe | Other | Dhl | DhlDe | DhlGlobalMail | Tsn | Fiege |
          Transmission | ParcelNl | Logoix | Packs | Courier | Rjp deriving(Enum) with (
            Briefpost: "BRIEFPOST",
            Ups: "UPS",
            Tnt: "TNT",
            TntExtra: "TNT-EXTRA",
            TntBrief: "TNT_BRIEF",
            TntExpress: "TNT-EXPRESS",
            Dyl: "DYL",
            DpdNl: "DPD-NL",
            DpdBe: "DPD-BE",
            BPostBe: "BPOST_BE",
            BpostBrief: "BPOST_BRIEF",
            Dhlforyou: "DHLFORYOU",
            Gls: "GLS",
            FedexNl: "FEDEX_NL",
            FedexBe: "FEDEX_BE",
            Other: "OTHER",
            Dhl: "DHL",
            DhlDe: "DHL_DE",
            DhlGlobalMail: "DHL-GLOBAL-MAIL",
            Tsn: "TSN",
            Fiege: "FIEGE",
            Transmission: "TRANSMISSION",
            ParcelNl: "PARCEL-NL",
            Logoix: "LOGOIX",
            Packs: "PACKS",
            Courier: "COURIER",
            Rjp: "RJP"
          );

    data TrackAndTrace = String deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::betweenLength($value, 4, 50) => '';

    data TransportInstruction = TransportInstruction {
        TransporterCode $transporterCode,
        TrackAndTrace $trackAndTrace
    };

    data Transport = Transport {
        TransportId $transportId,
        TransporterCode $transporterCode,
        TrackAndTrace $trackAndTrace
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\Transport\Command {
    data AddTransportInformation = AddTransportInformation {
        TransportId $transportId,
        TransporterCode $transporterCode,
        TrackAndTrace $trackAndTrace
    };

    data GetShippingLabel = GetShippingLabel {
        TransportId $transportId
    };
}
