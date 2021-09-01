<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Offer;

final class BundlePrice
{
    private $quantity;
    private $unitPrice;

    public function __construct(int $quantity, Price $unitPrice)
    {
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function unitPrice(): Price
    {
        return $this->unitPrice;
    }

    public function withQuantity(int $quantity): BundlePrice
    {
        return new self($quantity, $this->unitPrice);
    }

    public function withUnitPrice(Price $unitPrice): BundlePrice
    {
        return new self($this->quantity, $unitPrice);
    }

    public static function fromArray(array $data): BundlePrice
    {
        if (! isset($data['quantity']) || ! \is_int($data['quantity'])) {
            throw new \InvalidArgumentException("Key 'quantity' is missing in data array or is not a int");
        }

        $quantity = $data['quantity'];

        if (! isset($data['unitPrice']) || (! \is_float($data['unitPrice']) && ! \is_int($data['unitPrice']))) {
            throw new \InvalidArgumentException("Key 'unitPrice' is missing in data array or is not a float");
        }

        $unitPrice = Price::fromScalar($data['unitPrice']);

        return new self($quantity, $unitPrice);
    }

    public function toArray(): array
    {
        return [
            'quantity' => $this->quantity,
            'unitPrice' => $this->unitPrice->toScalar(),
        ];
    }
}
