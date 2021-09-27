<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Order;

final class OrderOffer
{
    private $offerId;
    private $reference;

    public function __construct(\BolCom\RetailerApi\Model\Offer\OfferId $offerId, \BolCom\RetailerApi\Model\Offer\Reference $reference = null)
    {
        $this->offerId = $offerId;
        $this->reference = $reference;
    }

    public function offerId(): \BolCom\RetailerApi\Model\Offer\OfferId
    {
        return $this->offerId;
    }

    public function reference()
    {
        return $this->reference;
    }

    public function withOfferId(\BolCom\RetailerApi\Model\Offer\OfferId $offerId): OrderOffer
    {
        return new self($offerId, $this->reference);
    }

    public function withReference(\BolCom\RetailerApi\Model\Offer\Reference $reference = null): OrderOffer
    {
        return new self($this->offerId, $reference);
    }

    public static function fromArray(array $data): OrderOffer
    {
        if (! isset($data['offerId']) || ! \is_string($data['offerId'])) {
            throw new \InvalidArgumentException("Key 'offerId' is missing in data array or is not a string");
        }

        $offerId = \BolCom\RetailerApi\Model\Offer\OfferId::fromString($data['offerId']);

        if (isset($data['reference'])) {
            if (! \is_string($data['reference'])) {
                throw new \InvalidArgumentException("Value for 'reference' is not a string in data array");
            }

            $reference = \BolCom\RetailerApi\Model\Offer\Reference::fromString($data['reference']);
        } else {
            $reference = null;
        }

        return new self($offerId, $reference);
    }
}
