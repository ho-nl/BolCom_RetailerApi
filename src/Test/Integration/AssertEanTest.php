<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Commission;

class AssertEanTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function pad_ean_to_thirteen_characters()
    {
        foreach (['190199221246', '17817655002'] as $value) {
            \BolCom\RetailerApi\Model\Offer\Ean::fromString($value);
        }
    }

    /**
     * @test
     */
    public function ean_greater_than_thirteen()
    {
        $this->expectException(\InvalidArgumentException::class);
        \BolCom\RetailerApi\Model\Offer\Ean::fromString('19019922124612');
    }

    /**
     * @test
     */
    public function ean_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        \BolCom\RetailerApi\Model\Offer\Ean::fromString('1901992212461');
    }
}
