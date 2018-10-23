<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Test\Integration\Infrastructure\Handler;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Handler\Commission\GetCommissionListHandler;
use BolCom\RetailerApi\Model\Commission\Query\GetCommissionList;
use BolCom\RetailerApi\Model\CurrencyAmount;
use BolCom\RetailerApi\Model\Offer\Condition;
use BolCom\RetailerApi\Model\Offer\Ean;
use PHPUnit\Framework\TestCase;

class GetCommissionListHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function should_get_commission_list_back()
    {
        $handler = new GetCommissionListHandler(new Client(null, 'username', 'password'));

        $commissions = $handler(GetCommissionList::with([
            Ean::fromString('1234455432'),
            Condition::isNew(),
            CurrencyAmount::fromScalar(10.10)
        ]));

        self::assertNotEmpty($commissions);

        foreach ($commissions->commissions() as $commission) {
            $commission->fixedAmound()->toScalar();
            $commission->percentage()->toScalar();
            $commission->totalCost()->toScalar();
            $commission->totalCostWithoutReduction()->toScalar();

            self::assertNotEmpty($commission->reduction());

            foreach ($commission->reduction() as $commissionReduction) {
                $commissionReduction->maximumPrice()->toScalar();
                $commissionReduction->costReduction()->toScalar();
                $commissionReduction->startDate()->toString();
                $commissionReduction->endDate()->toString();
            }
        }
    }
}
