<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace BolCom\RetailerApi\Model\Inbound\Assert;

class AssertIntRange
{
    public static function execute($period): bool
    {
        \Assert\Assertion::contains('-', $period);
        [$from, $to] = explode('-', $period);
        \Assert\Assertion::min($to, $from);
    }
}
