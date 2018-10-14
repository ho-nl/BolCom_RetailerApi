<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
namespace BolCom\RetailerApi\Model\Invoice\Assert;

class AssertPeriod
{
    public static function execute($period): bool
    {
        \Assert\Assertion::contains('/', $period);
        [$from, $to] = explode('/', $period);
        \Assert\Assertion::date($from, 'Y-m-d');
        \Assert\Assertion::date($to, 'Y-m-d');
        return true;
    }
}
