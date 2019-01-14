<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Commission;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Commission\Query\GetCommission;
use BolCom\RetailerApi\Model\CurrencyAmount;
use BolCom\RetailerApi\Model\Offer\Condition;
use BolCom\RetailerApi\Model\Offer\Ean;

class GetCommissionHandlerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function should_get_commission_back(): void
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $commission = $messageBus->dispatch(
            GetCommission::with(
                Ean::fromString('9781785882364'),
                Condition::IS_NEW(),
                CurrencyAmount::fromScalar(10.11)
            )
        );

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
