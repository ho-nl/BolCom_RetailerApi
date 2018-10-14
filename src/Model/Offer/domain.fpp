namespace BolCom\RetailerApi\Model\Offer {
    data QuantityInStock = Int deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 999) => '';

    data UnreservedStock = Int deriving(FromScalar, ToScalar) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 999) => '';

    data ReferenceCode = String deriving(FromString, ToString) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 20) => '';

    data Description = String deriving(FromString, ToString) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 2000) => '';

    data Title = String deriving(FromString, ToString) where
        _: | !\Assert\Assertion::betweenLength($value, 0, 500) => '';

    data PublishStatus = Published | NotPublished deriving(Enum) with (Published:'published', NotPublished:'not-published');

    data OfferCsv = OfferCsv {
        string $url
    } deriving (FromArray);

    data RetailerOfferStatus = RetailerOfferStatus {
        bool $valid,
        string $errorCode,
        string $errorMessage
    } deriving (FromArray);

    data Price = Float deriving(FromScalar, ToScalar);

    //We choose IsNew, because New is a protected key word
    data Condition = IsNew | AsNew | Good | Reasonable | Moderate deriving(Enum) with (IsNew:'NEW', AsNew:'AS_NEW', Good:'GOOD', Reasonable:'REASONABLE', Moderate:'MODERATE');

    data RetailerOfferIdentifier = RetailerOfferIdentifier {
        \BolCom\RetailerApi\Model\Ean $ean,
        Condition $condition,
    } deriving (ToArray);

    data RetailerOffer = RetailerOffer {
        \BolCom\RetailerApi\Model\Ean $ean,
        Condition $condition,
        Price $price,
        \BolCom\RetailerApi\Model\DeliveryCode $deliveryCode,
        QuantityInStock $quantityInStock,
        UnreservedStock $unreservedStock,
        bool $publish,
        ReferenceCode $referenceCode,
        Description $description,
        Title $title,
        \BolCom\RetailerApi\Model\FulfilmentMethod $fulfilmentMethod,
        RetailerOfferStatus $status
    } deriving (FromArray);

    data RetailerOfferUpsert = RetailerOfferUpsert {
        \BolCom\RetailerApi\Model\Ean $ean,
        Condition $condition,
        \BolCom\RetailerApi\Model\CurrencyAmount $price,
        \BolCom\RetailerApi\Model\DeliveryCode $deliveryCode,
        QuantityInStock $quantityInStock,
        bool $publish,
        ReferenceCode $referenceCode,
        Description $description,
        Title $title,
        \BolCom\RetailerApi\Model\FulfilmentMethod $fulfilmentMethod
    } deriving (ToArray);
}

namespace BolCom\RetailerApi\Model\Offer\Query {
    data GetOfferCsv = GetOfferCsv {
        string $filename
    };

    data GetOffer = GetOffer {
        \BolCom\RetailerApi\Model\OfferRetailerOfferIdentifier $retailerOfferIdentifier
    };
}

namespace BolCom\RetailerApi\Model\Offer\Command {
    data CreateOrUpdateOffer = CreateOrUpdateOffer {
        \BolCom\RetailerApi\Model\Offer\RetailerOfferUpsert $retailOffer
    };

    data DeleteOffersInBulk = DeleteOffersInBulk {
        \BolCom\RetailerApi\Model\OfferRetailerOfferIdentifier[] $retailerOfferIdentifier
    };

    data GenerateOfferCvs = GenerateOfferCvs {
        ?\BolCom\RetailerApi\Model\Offer\PublishStatus $filter
    };
}
