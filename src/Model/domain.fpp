namespace BolCom\RetailerApi\Model {
    data Ean = String deriving(FromString, ToString);

    //We choose IsNew, because New is a protected key word
    data Condition = IsNew | AsNew | Good | Reasonable | Moderate deriving(Enum) with (IsNew:'NEW', AsNew:'AS_NEW', Good:'GOOD', Reasonable:'REASONABLE', Moderate:'MODERATE');

    data CurrencyAmount = Float deriving(FromScalar, ToScalar);
    data Date = String deriving(FromString, ToString) where
        _: | \Assert\Assertion::date($value, 'Y-m-d') => '';

    data DateTime = String deriving(FromString, ToString) where
        _: | \Assert\Assertion::date($value, 'c') => '';

    data FulfilmentMethod = ByRetailer | ByBolCom deriving(Enum) with (
        ByRetailer: "FBR",
        ByBolCom: "FFB"
    );

    data DeliveryCode = DC24uurs23 | DC24uurs22 | DC24uurs21 | DC24uurs20 | DC24uurs19 | DC24uurs18 | DC24uurs17 | DC24uurs16 | DC24uurs15 | DC24uurs14 | DC24uurs13 | DC24uurs12 | DC12d | DC23d | DC34d | DC35d | DC48d | DC18d | DCMijnLeverbelofte deriving (Enum) with(
        DC24uurs23: "24uurs-23",
        DC24uurs22: "24uurs-22",
        DC24uurs21: "24uurs-21",
        DC24uurs20: "24uurs-20",
        DC24uurs19: "24uurs-19",
        DC24uurs18: "24uurs-18",
        DC24uurs17: "24uurs-17",
        DC24uurs16: "24uurs-16",
        DC24uurs15: "24uurs-15",
        DC24uurs14: "24uurs-14",
        DC24uurs13: "24uurs-13",
        DC24uurs12: "24uurs-12",
        DC12d: "1-2d",
        DC23d: "2-3d",
        DC34d: "3-4d",
        DC35d: "3-5d",
        DC48d: "4-8d",
        DC18d: "1-8d",
        DCMijnLeverbelofte: "MijnLeverbelofte"
    )
}


