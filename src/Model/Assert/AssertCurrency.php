<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Inbound\Assert;

use Assert\Assertion;

class AssertCurrency
{
    /**
     * @param float $value
     * @throws \Assert\AssertionFailedException
     */
    public function execute(float $value): void
    {
        Assertion::eq(round($value, 2), $value);
    }
}
