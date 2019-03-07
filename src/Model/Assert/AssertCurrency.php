<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Assert;

use Assert\Assertion;

class AssertCurrency
{
    /**
     * @throws \Assert\AssertionFailedException
     */
    public static function assert(float $value): bool
    {
        return Assertion::lessThan(abs($value - $value), 0.00001);
    }
}
