namespace BolCom\RetailerApi\Model\ShippingLabel {
    data ShippingLabelId = Int deriving(FromScalar, ToScalar);

    data ShippingLabel = ShippingLabel {
        \BolCom\RetailerApi\Model\Transport\TransporterCode $transporterCode,
        string $labelType,
        string $maxWeight,
        string $maxDimensions,
        float $retailerPrice,
        float $purchasePrice,
        float $discount,
        float $shippingLabelCode
    } deriving (FromArray);

    data ShippingLabelList = ShippingLabelList {
        ShippingLabel[] $purchasableShippingLabels
    } deriving (FromArray);

    data ShippingLabelPdf = String deriving (FromString, ToString);
    data ShippingLabelPdfList = ShippingLabelPdfList {
        ShippingLabelPdf[] $pdfs
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\ShippingLabel\Query {
    data GetShippingLabels = GetShippingLabels {
        \BolCom\RetailerApi\Model\Order\OrderItemId $orderItemId
    };
}
