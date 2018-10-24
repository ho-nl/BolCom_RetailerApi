<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Assert;

class AssertDateRange
{

    /**
     * @throws \Assert\AssertionFailedException
     */
    public static function assert(string $period): bool
    {
        \Assert\Assertion::contains('/', $period);
        [$from, $to] = explode('/', $period);
        \Assert\Assertion::date($from, 'Y-m-d');
        \Assert\Assertion::date($to, 'Y-m-d');
        return true;
    }
}
