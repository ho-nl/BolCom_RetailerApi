<?php

// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Reduction;

final class ReductionList
{
    private $reductions;

    /**
     * @param \BolCom\RetailerApi\Model\Reduction\Reduction[]|null $reductions
     */
    public function __construct(Reduction ...$reductions)
    {
        $this->reductions = $reductions;
    }

    /**
     * @return \BolCom\RetailerApi\Model\Reduction\Reduction[]
     */
    public function reductions(): array
    {
        return $this->reductions;
    }

    /**
     * @param \BolCom\RetailerApi\Model\Reduction\Reduction[]|null $reductions
     * @return \BolCom\RetailerApi\Model\Reduction\ReductionList
     */
    public function withReductions(array $reductions): ReductionList
    {
        return new self(...$reductions);
    }

    public static function fromArray(array $data): ReductionList
    {
        if (! isset($data['reductions']) || ! \is_array($data['reductions'])) {
            throw new \InvalidArgumentException("Key 'reductions' is missing in data array or is not an array");
        }

        $reductions = [];

        foreach ($data['reductions'] as $__value) {
            if (! \is_array($data['reductions'])) {
                throw new \InvalidArgumentException("Key 'reductions' in data array or is not an array of arrays");
            }

            $reductions[] = Reduction::fromArray($__value);
        }

        return new self(...$reductions);
    }
}
