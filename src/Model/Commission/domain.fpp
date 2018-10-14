namespace BolCom\RetailerApi\Model\Commission {
    data CommissionList = CommissionList {
        Commission[] $commissions
    };

    data Commission = Commission {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        \BolCom\RetailerApi\Model\Offer\Condition $condition,
        \BolCom\RetailerApi\Model\CurrencyAmount $price,
        \BolCom\RetailerApi\Model\CurrencyAmount $fixedAmound,
        float $percentage,
        \BolCom\RetailerApi\Model\CurrencyAmount $totalCost,
        \BolCom\RetailerApi\Model\CurrencyAmount $totalCostWithoutReduction,
        CommissionResultReduction[] $reduction
    };

    data CommissionReduction = CommissionReduction {
        \BolCom\RetailerApi\Model\CurrencyAmount $maximumPrice,
        \BolCom\RetailerApi\Model\CurrencyAmount $costReduction,
        \BolCom\RetailerApi\Model\Date $startDate,
        \BolCom\RetailerApi\Model\Date $endDate
    };
}

namespace BolCom\RetailerApi\Model\Commission\Query {
    data GetCommission = GetCommission {
        \BolCom\RetailerApi\Model\Offer\Ean $ean,
        \BolCom\RetailerApi\Model\Offer\Condition $condition,
        \BolCom\RetailerApi\Model\CurrencyAmount $price
    };

    data GetCommissionList = GetCommissionList {
        GetCommission[] $commissionQueries
    };
}
