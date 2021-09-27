namespace BolCom\RetailerApi\Model\Offer {
    data Ean = String deriving(FromString, ToString) where
         _: | !\Assert\Assertion::maxLength($value, 13) => 'EAN Code should not be more than 13 characters.'
            | !\BolCom\RetailerApi\Model\Assert\AssertEan::assert($value) => 'EAN Code is invalid.';

    data QuantityInStock = Int deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::between($value, 0, 999) => 'Stock amount should be between 0 and 999.';

    data Reference = String deriving(FromString, ToString) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 20) => '';

    data Title = String deriving(FromString, ToString) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 500) => '';

    data PublishStatus = PUBLISHED | NOT_PUBLISHED deriving(Enum(useValue)) with (PUBLISHED:'published', NOT_PUBLISHED:'not-published');

    data RetailerOfferStatus = RetailerOfferStatus {
        bool $valid,
        string $errorCode,
        string $errorMessage
    } deriving (FromArray);

    data Price = Float deriving(FromScalar, ToScalar) where
        _: | !\BolCom\RetailerApi\Model\Assert\AssertCurrency::assert($value) => ''
           | !\Assert\Assertion::between($value, 1, 9999, 'Price must be between 1 and 9999.') => '';

    data BundlePrice = BundlePrice {
        int $quantity,
        Price $unitPrice
    } deriving (FromArray, ToArray);

    data Pricing = Pricing {
        BundlePrice[] $bundlePrices
    } deriving (FromArray, ToArray);

    data Stock = Stock {
        QuantityInStock $amount,
        bool $managedByRetailer
    } deriving (FromArray, ToArray);

    data FulfilmentMethod = FBR | FBB deriving(Enum(useValue));

    data Fulfilment = Fulfilment {
        FulfilmentMethod $method,
        ?DeliveryCode $deliveryCode
    } deriving (FromArray, ToArray);

    // We choose IsNew, because New is a protected key word
    data Condition = IS_NEW | AS_NEW | GOOD | REASONABLE | MODERATE | UNKNOWN deriving(Enum(useValue)) with (
        IS_NEW:'NEW',
        AS_NEW:'AS_NEW',
        GOOD:'GOOD',
        REASONABLE:'REASONABLE',
        MODERATE:'MODERATE',
        UNKNOWN:'UNKNOWN'
    );

    // We choose IsNew, because New is a protected key word
    data ConditionCategory = IS_NEW | SECONDHAND deriving(Enum(useValue)) with (
        IS_NEW:'NEW',
        SECONDHAND:'SECONDHAND'
    );

    data ConditionComment = String deriving(FromString, ToString) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 2000) => '';

    data OfferCondition = OfferCondition {
        Condition $name,
        ?ConditionCategory $category,
        ?ConditionComment $comment
    } deriving (FromArray, ToArray);

    data DeliveryCode = DC24uurs23 | DC24uurs22 | DC24uurs21 | DC24uurs20 | DC24uurs19 | DC24uurs18 | DC24uurs17 |
        DC24uurs16 | DC24uurs15 | DC24uurs14 | DC24uurs13 | DC24uurs12 | DC12d | DC23d | DC35d | DC48d | DC18d |
        DCMijnLeverbelofte deriving (Enum(useValue)) with(
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
            DC35d: "3-5d",
            DC48d: "4-8d",
            DC18d: "1-8d",
            DCMijnLeverbelofte: "MijnLeverbelofte"
        );

    data OfferId = OfferId deriving(Uuid);

    data OfferStock = OfferStock {
        QuantityInStock $amount,
        QuantityInStock $correctedStock,
        bool $managedByRetailer
    } deriving (FromArray, ToArray);

    data CountryCode = CountryCode {
        string $countryCode
    } deriving (FromArray, ToArray);

    data Store = Store {
        Title $productTitle,
        ?CountryCode[] $visible
    } deriving (FromArray, ToArray);

    data NotPublishableReasons = NotPublishableReasons {
        string $code,
        ?string $description
    } deriving (FromArray, ToArray);

    data RetailerOffer = RetailerOffer {
        OfferId $offerId,
        Ean $ean,
        Reference $reference,
        bool $onHoldByRetailer,
        ?Title $unknownProductTitle,
        Pricing $pricing,
        OfferStock $stock,
        Fulfilment $fulfilment,
        Store $store,
        OfferCondition $condition,
        ?NotPublishableReasons[] $notPublishableReasons
    } deriving (FromArray, ToArray);

    data RetailerOfferUpsert = RetailerOfferUpsert {
        Ean $ean,
        OfferCondition $condition,
        ?Reference $reference,
        bool $onHoldByRetailer,
        ?Title $unknownProductTitle,
        Pricing $pricing,
        Stock $stock,
        Fulfilment $fulfilment
    } deriving (FromArray, ToArray);

    data RetailerOfferUpdate = RetailerOfferUpdate {
        ?Reference $reference,
        bool $onHoldByRetailer,
        ?Title $unknownProductTitle,
        Fulfilment $fulfilment
    } deriving (FromArray, ToArray);
}

namespace BolCom\RetailerApi\Model\Offer\Query {
    data GetOffer = GetOffer {
        \BolCom\RetailerApi\Model\Offer\OfferId $offerId
    } deriving (Query);
}

namespace BolCom\RetailerApi\Model\Offer\Command {
    data CreateOffer = CreateOffer {
        \BolCom\RetailerApi\Model\Offer\RetailerOfferUpsert $retailerOffer
    } deriving (Command);

    data UpdateOffer = UpdateOffer {
        \BolCom\RetailerApi\Model\Offer\OfferId $offerId,
        \BolCom\RetailerApi\Model\Offer\RetailerOfferUpdate $retailerOffer
    } deriving (Command);

    data UpdateOfferPrice = UpdateOfferPrice {
        \BolCom\RetailerApi\Model\Offer\OfferId $offerId,
        \BolCom\RetailerApi\Model\Offer\Pricing $pricing
    } deriving (Command);

    data UpdateOfferStock = UpdateOfferStock {
        \BolCom\RetailerApi\Model\Offer\OfferId $offerId,
        \BolCom\RetailerApi\Model\Offer\Stock $stock
    } deriving (Command);

    data DeleteOffer = DeleteOffer {
        \BolCom\RetailerApi\Model\Offer\OfferId $offerId
    } deriving (Command);
}
