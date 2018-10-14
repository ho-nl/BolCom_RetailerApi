<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
namespace BolCom\RetailerApi\Model\Inbound\Assert;

class Range
{
    public static function execute($period): bool
    {
        \Assert\Assertion::contains('-', $period);
        [$from, $to] = explode('-', $period);
        \Assert\Assertion::min($to, $from);
    }
}
