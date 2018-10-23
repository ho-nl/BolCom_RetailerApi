<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

use BolCom\RetailerApi\Factory\GuzzleClientFactory;
use BolCom\RetailerApi\Infrastructure\Handler;

$handler = new Handler\GetCommissionListHandler(
    GuzzleClientFactory::create('api', 'secret')
);

$commissions = $handler(\BolCom\RetailerApi\Model\Commission\Query\GetCommissionList::with([
    \BolCom\RetailerApi\Model\Offer\Ean::fromString('1234455432'),
    \BolCom\RetailerApi\Model\Offer\Condition::isNew(),
    \BolCom\RetailerApi\Model\CurrencyAmount::fromScalar(10.10)
]));

foreach ($commissions->commissions() as $commission) {
    $commission->fixedAmound()->toScalar();
    $commission->percentage()->toScalar();
    $commission->totalCost()->toScalar();
    $commission->totalCostWithoutReduction()->toScalar();

    foreach ($commission->reduction() as $commissionReduction) {
        $commissionReduction->maximumPrice()->toScalar();
        $commissionReduction->costReduction()->toScalar();
        $commissionReduction->startDate()->toString();
        $commissionReduction->endDate()->toString();
    }
}
