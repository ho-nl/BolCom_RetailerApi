<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer;

final class RetailerOffer
{
    private $offerId;
    private $ean;
    private $reference;
    private $onHoldByRetailer;
    private $unknownProductTitle;
    private $pricing;
    private $stock;
    private $fulfilment;
    private $store;
    private $condition;
    private $notPublishableReasons;

    /**
     * @param \BolCom\RetailerApi\Model\Offer\OfferId $offerId
     * @param \BolCom\RetailerApi\Model\Offer\Ean $ean
     * @param \BolCom\RetailerApi\Model\Offer\Reference $reference
     * @param bool $onHoldByRetailer
     * @param \BolCom\RetailerApi\Model\Offer\Title $unknownProductTitle
     * @param \BolCom\RetailerApi\Model\Offer\Pricing $pricing
     * @param \BolCom\RetailerApi\Model\Offer\OfferStock $stock
     * @param \BolCom\RetailerApi\Model\Offer\Fulfilment $fulfilment
     * @param \BolCom\RetailerApi\Model\Offer\Store $store
     * @param \BolCom\RetailerApi\Model\Offer\OfferCondition $condition
     * @param \BolCom\RetailerApi\Model\Offer\NotPublishableReasons[] $notPublishableReasons
     */
    public function __construct(OfferId $offerId, Ean $ean, Reference $reference, bool $onHoldByRetailer, Title $unknownProductTitle = null, Pricing $pricing, OfferStock $stock, Fulfilment $fulfilment, Store $store, OfferCondition $condition, array $notPublishableReasons = null)
    {
        $this->offerId = $offerId;
        $this->ean = $ean;
        $this->reference = $reference;
        $this->onHoldByRetailer = $onHoldByRetailer;
        $this->unknownProductTitle = $unknownProductTitle;
        $this->pricing = $pricing;
        $this->stock = $stock;
        $this->fulfilment = $fulfilment;
        $this->store = $store;
        $this->condition = $condition;
        if ($notPublishableReasons !== null) {
            $this->notPublishableReasons = [];
            foreach ($notPublishableReasons as $__value) {
                if (! $__value instanceof \BolCom\RetailerApi\Model\Offer\NotPublishableReasons) {
                    throw new \InvalidArgumentException('notPublishableReasons expected an array of BolCom\RetailerApi\Model\Offer\NotPublishableReasons');
                }
                $this->notPublishableReasons[] = $__value;
            }
        }
    }

    public function offerId(): OfferId
    {
        return $this->offerId;
    }

    public function ean(): Ean
    {
        return $this->ean;
    }

    public function reference(): Reference
    {
        return $this->reference;
    }

    public function onHoldByRetailer(): bool
    {
        return $this->onHoldByRetailer;
    }

    public function unknownProductTitle()
    {
        return $this->unknownProductTitle;
    }

    public function pricing(): Pricing
    {
        return $this->pricing;
    }

    public function stock(): OfferStock
    {
        return $this->stock;
    }

    public function fulfilment(): Fulfilment
    {
        return $this->fulfilment;
    }

    public function store(): Store
    {
        return $this->store;
    }

    public function condition(): OfferCondition
    {
        return $this->condition;
    }

    /**
     * @return \BolCom\RetailerApi\Model\Offer\NotPublishableReasons[]|null
     */
    public function notPublishableReasons()
    {
        return $this->notPublishableReasons;
    }

    public function withOfferId(OfferId $offerId): RetailerOffer
    {
        return new self($offerId, $this->ean, $this->reference, $this->onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $this->stock, $this->fulfilment, $this->store, $this->condition, $this->notPublishableReasons);
    }

    public function withEan(Ean $ean): RetailerOffer
    {
        return new self($this->offerId, $ean, $this->reference, $this->onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $this->stock, $this->fulfilment, $this->store, $this->condition, $this->notPublishableReasons);
    }

    public function withReference(Reference $reference): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $reference, $this->onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $this->stock, $this->fulfilment, $this->store, $this->condition, $this->notPublishableReasons);
    }

    public function withOnHoldByRetailer(bool $onHoldByRetailer): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $this->reference, $onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $this->stock, $this->fulfilment, $this->store, $this->condition, $this->notPublishableReasons);
    }

    public function withUnknownProductTitle(Title $unknownProductTitle = null): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $this->reference, $this->onHoldByRetailer, $unknownProductTitle, $this->pricing, $this->stock, $this->fulfilment, $this->store, $this->condition, $this->notPublishableReasons);
    }

    public function withPricing(Pricing $pricing): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $this->reference, $this->onHoldByRetailer, $this->unknownProductTitle, $pricing, $this->stock, $this->fulfilment, $this->store, $this->condition, $this->notPublishableReasons);
    }

    public function withStock(OfferStock $stock): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $this->reference, $this->onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $stock, $this->fulfilment, $this->store, $this->condition, $this->notPublishableReasons);
    }

    public function withFulfilment(Fulfilment $fulfilment): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $this->reference, $this->onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $this->stock, $fulfilment, $this->store, $this->condition, $this->notPublishableReasons);
    }

    public function withStore(Store $store): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $this->reference, $this->onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $this->stock, $this->fulfilment, $store, $this->condition, $this->notPublishableReasons);
    }

    public function withCondition(OfferCondition $condition): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $this->reference, $this->onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $this->stock, $this->fulfilment, $this->store, $condition, $this->notPublishableReasons);
    }

    /**
     * @param \BolCom\RetailerApi\Model\Offer\NotPublishableReasons[] $notPublishableReasons
     * @return \BolCom\RetailerApi\Model\Offer\RetailerOffer
     */
    public function withNotPublishableReasons(array $notPublishableReasons = null): RetailerOffer
    {
        return new self($this->offerId, $this->ean, $this->reference, $this->onHoldByRetailer, $this->unknownProductTitle, $this->pricing, $this->stock, $this->fulfilment, $this->store, $this->condition, $notPublishableReasons);
    }

    public static function fromArray(array $data): RetailerOffer
    {
        if (! isset($data['offerId']) || ! \is_string($data['offerId'])) {
            throw new \InvalidArgumentException("Key 'offerId' is missing in data array or is not a string");
        }

        $offerId = OfferId::fromString($data['offerId']);

        if (! isset($data['ean']) || ! \is_string($data['ean'])) {
            throw new \InvalidArgumentException("Key 'ean' is missing in data array or is not a string");
        }

        $ean = Ean::fromString($data['ean']);

        if (! isset($data['reference']) || ! \is_string($data['reference'])) {
            throw new \InvalidArgumentException("Key 'reference' is missing in data array or is not a string");
        }

        $reference = Reference::fromString($data['reference']);

        if (! isset($data['onHoldByRetailer']) || ! \is_bool($data['onHoldByRetailer'])) {
            throw new \InvalidArgumentException("Key 'onHoldByRetailer' is missing in data array or is not a bool");
        }

        $onHoldByRetailer = $data['onHoldByRetailer'];

        if (isset($data['unknownProductTitle'])) {
            if (! \is_string($data['unknownProductTitle'])) {
                throw new \InvalidArgumentException("Value for 'unknownProductTitle' is not a string in data array");
            }

            $unknownProductTitle = Title::fromString($data['unknownProductTitle']);
        } else {
            $unknownProductTitle = null;
        }

        if (! isset($data['pricing']) || ! \is_array($data['pricing'])) {
            throw new \InvalidArgumentException("Key 'pricing' is missing in data array or is not an array");
        }

        $pricing = Pricing::fromArray($data['pricing']);

        if (! isset($data['stock']) || ! \is_array($data['stock'])) {
            throw new \InvalidArgumentException("Key 'stock' is missing in data array or is not an array");
        }

        $stock = OfferStock::fromArray($data['stock']);

        if (! isset($data['fulfilment']) || ! \is_array($data['fulfilment'])) {
            throw new \InvalidArgumentException("Key 'fulfilment' is missing in data array or is not an array");
        }

        $fulfilment = Fulfilment::fromArray($data['fulfilment']);

        if (! isset($data['store']) || ! \is_array($data['store'])) {
            throw new \InvalidArgumentException("Key 'store' is missing in data array or is not an array");
        }

        $store = Store::fromArray($data['store']);

        if (! isset($data['condition']) || ! \is_array($data['condition'])) {
            throw new \InvalidArgumentException("Key 'condition' is missing in data array or is not an array");
        }

        $condition = OfferCondition::fromArray($data['condition']);

        if (isset($data['notPublishableReasons'])) {
            if (! \is_array($data['notPublishableReasons'])) {
                throw new \InvalidArgumentException("Value for 'notPublishableReasons' is not an array in data array");
            }

            $notPublishableReasons = [];

            foreach ($data['notPublishableReasons'] as $__value) {
                if (! \is_array($data['notPublishableReasons'])) {
                    throw new \InvalidArgumentException("Key 'notPublishableReasons' in data array or is not an array of arrays");
                }

                $notPublishableReasons[] = NotPublishableReasons::fromArray($__value);
            }
        } else {
            $notPublishableReasons = null;
        }

        return new self(
            $offerId,
            $ean,
            $reference,
            $onHoldByRetailer,
            $unknownProductTitle,
            $pricing,
            $stock,
            $fulfilment,
            $store,
            $condition,
            $notPublishableReasons
        );
    }

    public function toArray(): array
    {
         $notPublishableReasons = null;

        if (null !== $this->notPublishableReasons) {
            foreach ($this->notPublishableReasons as $__value) {
                $notPublishableReasons[] = $__value->toArray();
            }
        }

        return [
            'offerId' => $this->offerId->toString(),
            'ean' => $this->ean->toString(),
            'reference' => $this->reference->toString(),
            'onHoldByRetailer' => $this->onHoldByRetailer,
            'unknownProductTitle' => null === $this->unknownProductTitle ? null : $this->unknownProductTitle->toString(),
            'pricing' => $this->pricing->toArray(),
            'stock' => $this->stock->toArray(),
            'fulfilment' => $this->fulfilment->toArray(),
            'store' => $this->store->toArray(),
            'condition' => $this->condition->toArray(),
            'notPublishableReasons' => $notPublishableReasons,
        ];
    }
}
