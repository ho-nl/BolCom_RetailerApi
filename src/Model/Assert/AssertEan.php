<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

namespace BolCom\RetailerApi\Model\Assert;

class AssertEan
{
    public static function assert(string $value): bool
    {
        return self::validateBarCode($value);
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
        if ($barcode === '0000000000000') {
            return false;
        }

        $barcode = self::appendZeroesToEan($barcode);

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

    /**
     * @param string $ean
     * @return string
     */
    public static function appendZeroesToEan(string $ean) {
        return str_pad($ean, 13, "0", STR_PAD_LEFT);
    }
}
