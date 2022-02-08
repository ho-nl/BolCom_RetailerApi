<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Rma;

final class ReturnReason
{
    private $mainReason;
    private $detailedReason;
    private $customerComments;

    public function __construct(string $mainReason = null, string $detailedReason = null, string $customerComments = null)
    {
        $this->mainReason = $mainReason;
        $this->detailedReason = $detailedReason;
        $this->customerComments = $customerComments;
    }

    public function mainReason()
    {
        return $this->mainReason;
    }

    public function detailedReason()
    {
        return $this->detailedReason;
    }

    public function customerComments()
    {
        return $this->customerComments;
    }

    public function withMainReason(string $mainReason = null): ReturnReason
    {
        return new self($mainReason, $this->detailedReason, $this->customerComments);
    }

    public function withDetailedReason(string $detailedReason = null): ReturnReason
    {
        return new self($this->mainReason, $detailedReason, $this->customerComments);
    }

    public function withCustomerComments(string $customerComments = null): ReturnReason
    {
        return new self($this->mainReason, $this->detailedReason, $customerComments);
    }

    public static function fromArray(array $data): ReturnReason
    {
        if (isset($data['mainReason'])) {
            if (! \is_string($data['mainReason'])) {
                throw new \InvalidArgumentException("Value for 'mainReason' is not a string in data array");
            }

            $mainReason = $data['mainReason'];
        } else {
            $mainReason = null;
        }

        if (isset($data['detailedReason'])) {
            if (! \is_string($data['detailedReason'])) {
                throw new \InvalidArgumentException("Value for 'detailedReason' is not a string in data array");
            }

            $detailedReason = $data['detailedReason'];
        } else {
            $detailedReason = null;
        }

        if (isset($data['customerComments'])) {
            if (! \is_string($data['customerComments'])) {
                throw new \InvalidArgumentException("Value for 'customerComments' is not a string in data array");
            }

            $customerComments = $data['customerComments'];
        } else {
            $customerComments = null;
        }

        return new self(
            $mainReason,
            $detailedReason,
            $customerComments
        );
    }
}
