namespace BolCom\RetailerApi\Model {
    data CurrencyAmount = Float deriving(FromScalar, ToScalar) where
        _: | \BolCom\RetailerApi\Model\Assert\AssertCurrency::date($value) => '';

    data PercentageAmount = Float deriving(FromScalar, ToScalar);

    data Date = String deriving(FromString, ToString) where
        _: | \Assert\Assertion::date($value, 'Y-m-d') => '';

    data DateTime = String deriving(FromString, ToString) where
        _: | \Assert\Assertion::date($value, 'c') => '';
}
