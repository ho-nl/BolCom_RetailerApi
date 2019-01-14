<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Commission;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Commission\CommissionQuery;
use BolCom\RetailerApi\Model\Commission\Query\GetCommissionList;
use BolCom\RetailerApi\Model\Offer\Condition;

class GetCommissionListHandlerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function should_get_commission_list_back()
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $commissions = $messageBus->dispatch(GetCommissionList::with(
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
