<?php

// phpcs:ignoreFile
// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Rma;

final class RmaId
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function fromScalar(string $rmaId): RmaId
    {
        return new self($rmaId);
    }

    public function toScalar(): string
    {
        return $this->value;
    }
}
