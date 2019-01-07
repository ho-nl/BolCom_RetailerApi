<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Infrastructure;

use BolCom\RetailerApi\Handler\Offer\CreateOrUpdateOfferHandler;
use BolCom\RetailerApi\Handler\Order\CancelOrderHandler;
use BolCom\RetailerApi\Handler\Order\GetOrderHandler;
use BolCom\RetailerApi\Handler\Order\ShipOrderItemHandler;
use BolCom\RetailerApi\Handler\Rma\GetAllReturnsHandler;
use BolCom\RetailerApi\Handler\Rma\HandleReturnHandler;
use BolCom\RetailerApi\Model\ClientPoolInterface;
use BolCom\RetailerApi\Handler\Order\GetAllOpenOrdersHandler;
use BolCom\RetailerApi\Model\MessageBusInterface;
use BolCom\RetailerApi\Model\Offer\Command\CreateOrUpdateOffer;
use BolCom\RetailerApi\Model\Order\Command\CancelOrder;
use BolCom\RetailerApi\Model\Order\Command\ShipOrderItem;
use BolCom\RetailerApi\Model\Order\Query\GetAllOpenOrders;
use BolCom\RetailerApi\Model\Order\Query\GetOrder;
use BolCom\RetailerApi\Model\Rma\Command\HandleReturn;
use BolCom\RetailerApi\Model\Rma\Query\GetAllReturns;

class MessageBus implements MessageBusInterface
{
    /** @var array $handlerMapping */
    private $handlerMapping;

    /** @var ClientPool $clientPool */
    private $clientPool;

    /**
     * @param ClientPoolInterface $clientPool
     */
    public function __construct(ClientPoolInterface $clientPool)
    {
        $this->handlerMapping = [
            GetAllOpenOrders::class => GetAllOpenOrdersHandler::class,
            GetOrder::class => GetOrderHandler::class,
            CancelOrder::class => CancelOrderHandler::class,
            ShipOrderItem::class => ShipOrderItemHandler::class,
            CreateOrUpdateOffer::class => CreateOrUpdateOfferHandler::class,
            GetAllReturns::class => GetAllReturnsHandler::class,
            HandleReturn::class => HandleReturnHandler::class
        ];

        $this->clientPool = $clientPool;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch($message, string $clientName = ClientPoolInterface::DEFAULT_CLIENT_NAME)
    {
        $commandClass = \get_class($message);
        if (! isset($this->handlerMapping[$commandClass])) {
            throw new \RuntimeException(sprintf('Handler not found for command "%s".', $commandClass));
        }

        $handlerClass = $this->handlerMapping[$commandClass];
        $handler = new $handlerClass($this->clientPool->get($clientName));

        return $handler($message);
    }
}
