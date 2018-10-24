namespace BolCom\RetailerApi\Model\Commission {
    data CommissionList = CommissionList {
        Commission[] $commissions
    } deriving (FromArray);

    data Commission = Commission {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        \BolCom\RetailerApi\Model\Offer\Condition $condition,
        \BolCom\RetailerApi\Model\CurrencyAmount $price,
        \BolCom\RetailerApi\Model\CurrencyAmount $fixedAmount,
        \BolCom\RetailerApi\Model\PercentageAmount $percentage,
        \BolCom\RetailerApi\Model\CurrencyAmount $totalCost,
        ?\BolCom\RetailerApi\Model\CurrencyAmount $totalCostWithoutReduction,
        ?CommissionReduction[] $reduction
    } deriving (FromArray);

    data CommissionReduction = CommissionReduction {
        \BolCom\RetailerApi\Model\CurrencyAmount $maximumPrice,
        \BolCom\RetailerApi\Model\CurrencyAmount $costReduction,
        \BolCom\RetailerApi\Model\Date $startDate,
        \BolCom\RetailerApi\Model\Date $endDate
    } deriving (FromArray);

    data CommissionQuery = CommissionQuery {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        \BolCom\RetailerApi\Model\Offer\Condition $condition,
        \BolCom\RetailerApi\Model\CurrencyAmount $price
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\Commission\Query {
    data GetCommission = GetCommission {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        \BolCom\RetailerApi\Model\Offer\Condition $condition,
        \BolCom\RetailerApi\Model\CurrencyAmount $price
    } deriving (Query);

    data GetCommissionList = GetCommissionList {
        \BolCom\RetailerApi\Model\Commission\CommissionQuery[] $commissionQueries
    } deriving (Query)
}
