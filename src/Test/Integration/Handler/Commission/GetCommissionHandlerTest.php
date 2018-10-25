<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);
namespace BolCom\RetailerApi\Test\Integration\Commission\Handler;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Handler\Commission\GetCommissionHandler;
use BolCom\RetailerApi\Model\Commission\Query\GetCommission;
use BolCom\RetailerApi\Model\CurrencyAmount;
use BolCom\RetailerApi\Model\Offer\Condition;
use BolCom\RetailerApi\Model\Offer\Ean;
use PHPUnit\Framework\TestCase;

class GetCommissionHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function should_get_commission_back(): void
    {
        $handler = new GetCommissionHandler(new Client(null, __DIR__ . '/../token.json'));

        $commission = $handler(GetCommission::with(
            Ean::fromString('9781785882364'),
            Condition::IS_NEW(),
            CurrencyAmount::fromScalar(10.10)
        ));

        $commission->fixedAmount()->toScalar();
        $commission->percentage()->toScalar();
        $commission->totalCost()->toScalar();
        $commission->totalCostWithoutReduction();

        if ($commission->reduction()) {
            foreach ($commission->reduction() as $commissionReduction) {
                $commissionReduction->maximumPrice()->toScalar();
                $commissionReduction->costReduction()->toScalar();
                $commissionReduction->startDate()->toString();
                $commissionReduction->endDate()->toString();
            }
        }
    }
}
