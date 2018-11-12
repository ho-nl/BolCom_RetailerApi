<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Commission\Handler;

use BolCom\RetailerApi\Client;
use BolCom\RetailerApi\Handler\Commission\GetCommissionListHandler;
use BolCom\RetailerApi\Model\Commission\CommissionQuery;
use BolCom\RetailerApi\Model\Commission\Query\GetCommissionList;
use BolCom\RetailerApi\Model\Offer\Condition;
use PHPUnit\Framework\TestCase;

class GetCommissionListHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function should_get_commission_list_back()
    {
        $handler = new GetCommissionListHandler(
            new Client(BOL_CLIENT_ID, BOL_CLIENT_SECRET, null, __DIR__ . '/../token.json')
        );

        $commissions = $handler(GetCommissionList::with(
            CommissionQuery::fromArray([
                'ean' => '9781785882364',
                'condition' => Condition::IS_NEW,
                'price' => 10.11
            ])
        ));

        self::assertNotEmpty($commissions);

        foreach ($commissions->commissions() as $commission) {
            $commission->fixedAmount()->toScalar();
            $commission->percentage()->toScalar();
            $commission->totalCost()->toScalar();
//            $commission->totalCostWithoutReduction()->toScalar();

//            self::assertNotEmpty($commission->reduction());

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
}
