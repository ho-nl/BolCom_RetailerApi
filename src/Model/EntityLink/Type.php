<?php

// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\EntityLink;

final class Type
{
    public const OPTIONS = [
        'CART' => 'cart',
        'ORDER' => 'order',
        'ORDER_ITEM' => 'order_item',
        'RETURN_ITEM' => 'return_item',
        'PROCESS_STATUS_CONFIRM_SHIPMENT' => 'process_status_confirm_shipment',
    ];

    public const CART = 'cart';
    public const ORDER = 'order';
    public const ORDER_ITEM = 'order_item';
    public const RETURN_ITEM = 'return_item';
    public const PROCESS_STATUS_CONFIRM_SHIPMENT = 'process_status_confirm_shipment';

    private $name;
    private $value;

    private function __construct(string $name)
    {
        $this->name = $name;
        $this->value = self::OPTIONS[$name];
    }

    public static function CART(): self
    {
        return new self('CART');
    }

    public static function ORDER(): self
    {
        return new self('ORDER');
    }

    public static function ORDER_ITEM(): self
    {
        return new self('ORDER_ITEM');
    }

    public static function RETURN_ITEM(): self
    {
        return new self('RETURN_ITEM');
    }

    public static function PROCESS_STATUS_CONFIRM_SHIPMENT(): self
    {
        return new self('PROCESS_STATUS_CONFIRM_SHIPMENT');
    }

    public static function fromName(string $value): self
    {
        if (! isset(self::OPTIONS[$value])) {
            throw new \InvalidArgumentException('Unknown enum name given');
        }

        return self::{$value}();
    }

    public static function fromValue($value): self
    {
        foreach (self::OPTIONS as $name => $v) {
            if ($v === $value) {
                return self::{$name}();
            }
        }

        throw new \InvalidArgumentException('Unknown enum value given');
    }

    public function equals(Type $other): bool
    {
        return \get_class($this) === \get_class($other) && $this->name === $other->name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function toString(): string
    {
        return $this->name;
    }
}
