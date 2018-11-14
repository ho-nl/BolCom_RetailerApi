<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace BolCom\RetailerApi\Model\Assert;

use Assert\Assertion;

class AssertEan
{
    public static function assert(string $value): bool
    {
        Assertion::regex($value, '/^\d{13}$/');

        if (self::validateBarCode($value) === false) {
            throw new \InvalidArgumentException(__('EAN Code is invalid.'));
        }

        return true;
    }

    /**
     * Validate GTIN-13
     *
     * @param string $barcode
     *
     * @return bool
     */
    private static function validateBarCode(string $barcode): bool
    {
        $oddSum = 0;
        $evenSum = 0;

        for ($i = 0; $i < 12; $i++) {
            $i % 2 === 0
                ? $oddSum += $barcode[$i]
                : $evenSum += $barcode[$i];
        }

        $totalSum = $evenSum * 3 + $oddSum;
        $checkDigit = ceil($totalSum / 10) * 10 - $totalSum;

        /** @noinspection TypeUnsafeComparisonInspection */
        return $checkDigit == $barcode[12];
    }
}
