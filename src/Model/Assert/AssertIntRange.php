<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Assert;

class AssertIntRange
{

    /**
     * @throws \Assert\AssertionFailedException
     */
    public static function assert(string $period): bool
    {
        \Assert\Assertion::contains('-', $period);
        [$from, $to] = explode('-', $period);
        \Assert\Assertion::min($to, $from);
        return true;
    }
}
