namespace BolCom\RetailerApi\Model\Reduction {
    data Reduction = Reduction {
        \BolCom\RetailerApi\Model\Offer\Ean $ean
    } deriving (FromArray);

    data ReductionList = ReductionList {
        Reduction[] $reductions
    } deriving (FromArray);
}

namespace BolCom\RetailerApi\Model\Reduction\Query {
    data GetReductionList = GetReductionList {} deriving (Query);
    data GetLatestReductionsFilename = GetLatestReductionsFilename{} deriving (Query);
}
