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
    /** @var \BolCom\RetailerApi\Infrastructure\MessageBus $messageBus */
    private $messageBus;

    protected function setUp()
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, true));
        $this->messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);
    }

    /**
     * @test
     */
    public function should_get_commission_list_back()
    {
        /** @var \BolCom\RetailerApi\Model\Commission\CommissionList $commissions */
        $commissions = $this->messageBus->dispatch(GetCommissionList::with(...[
            CommissionQuery::fromArray([
                'ean' => '8712626055150',
                'condition' => Condition::IS_NEW,
                'price' => 34.99
            ]),
            CommissionQuery::fromArray([
                'ean' => '8804269223123',
                'condition' => Condition::IS_NEW,
                'price' => 699.95
            ]),
            CommissionQuery::fromArray([
                'ean' => '8712626055143',
                'condition' => Condition::GOOD,
                'price' => 24.50
            ]),
            CommissionQuery::fromArray([
                'ean' => '0604020064587',
                'condition' => Condition::IS_NEW,
                'price' => 24.95
            ]),
            CommissionQuery::fromArray([
                'ean' => '8718526069334',
                'condition' => Condition::IS_NEW,
                'price' => 25.00
            ])
        ]));

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
