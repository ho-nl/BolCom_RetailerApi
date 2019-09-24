<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Shipment;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Offer\FulfilmentMethod;
use BolCom\RetailerApi\Model\Shipment\Query\GetShipmentList;

class GetShipmentListHandlerTest extends \PHPUnit\Framework\TestCase
{
    /** @var \BolCom\RetailerApi\Infrastructure\MessageBus $messageBus */
    private $messageBus;

    protected function setUp()
    {
        $clientPool = ClientPool::configure(new ClientConfig(
            BOL_CLIENT_ID,
            BOL_CLIENT_SECRET,
            'https://api.bol.com/retailer-demo/'
        ));
        $this->messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);
    }

    public function test__invoke()
    {
        $this->messageBus->dispatch(GetShipmentList::with(1, FulfilmentMethod::FBR()));
        $this->messageBus->dispatch(GetShipmentList::with(1, FulfilmentMethod::FBB()));
    }
}
