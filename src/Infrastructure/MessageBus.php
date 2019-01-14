<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Infrastructure;

use BolCom\RetailerApi\Handler\Commission\GetCommissionHandler;
use BolCom\RetailerApi\Handler\Commission\GetCommissionListHandler;
use BolCom\RetailerApi\Handler\Offer\CreateOrUpdateOfferHandler;
use BolCom\RetailerApi\Handler\Offer\DeleteOffersInBulkHandler;
use BolCom\RetailerApi\Handler\Offer\GenerateOfferCsvHandler;
use BolCom\RetailerApi\Handler\Order\CancelOrderHandler;
use BolCom\RetailerApi\Handler\Order\GetOrderHandler;
use BolCom\RetailerApi\Handler\Order\ShipOrderItemHandler;
use BolCom\RetailerApi\Handler\ProcessStatus\GetStatusByEntityHandler;
use BolCom\RetailerApi\Handler\ProcessStatus\GetStatusByProcessIdHandler;
use BolCom\RetailerApi\Handler\Rma\GetAllReturnsHandler;
use BolCom\RetailerApi\Handler\Rma\HandleReturnHandler;
use BolCom\RetailerApi\Handler\Shipment\GetShipmentHandler;
use BolCom\RetailerApi\Handler\Shipment\GetShipmentListHandler;
use BolCom\RetailerApi\Handler\ShippingLabel\GetShippingLabelsHandler;
use BolCom\RetailerApi\Handler\Transport\GetShippingLabelHandler;
use BolCom\RetailerApi\Model\ClientPoolInterface;
use BolCom\RetailerApi\Handler\Order\GetAllOpenOrdersHandler;
use BolCom\RetailerApi\Model\Commission\Query\GetCommission;
use BolCom\RetailerApi\Model\Commission\Query\GetCommissionList;
use BolCom\RetailerApi\Model\MessageBusInterface;
use BolCom\RetailerApi\Model\Offer\Command\CreateOrUpdateOffer;
use BolCom\RetailerApi\Model\Offer\Command\DeleteOffersInBulk;
use BolCom\RetailerApi\Model\Offer\Command\GenerateOfferCvs;
use BolCom\RetailerApi\Model\Order\Command\CancelOrder;
use BolCom\RetailerApi\Model\Order\Command\ShipOrderItem;
use BolCom\RetailerApi\Model\Order\Query\GetAllOpenOrders;
use BolCom\RetailerApi\Model\Order\Query\GetOrder;
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByEntity;
use BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByProcessId;
use BolCom\RetailerApi\Model\Rma\Command\HandleReturn;
use BolCom\RetailerApi\Model\Rma\Query\GetAllReturns;
use BolCom\RetailerApi\Model\Shipment\Query\GetShipment;
use BolCom\RetailerApi\Model\Shipment\Query\GetShipmentList;
use BolCom\RetailerApi\Model\ShippingLabel\Query\GetShippingLabels;
use BolCom\RetailerApi\Model\Transport\Query\GetShippingLabel;

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
            GetCommission::class => GetCommissionHandler::class,
            GetCommissionList::class => GetCommissionListHandler::class,
            GetAllOpenOrders::class => GetAllOpenOrdersHandler::class,
            GetOrder::class => GetOrderHandler::class,
            CancelOrder::class => CancelOrderHandler::class,
            ShipOrderItem::class => ShipOrderItemHandler::class,
            CreateOrUpdateOffer::class => CreateOrUpdateOfferHandler::class,
            DeleteOffersInBulk::class => DeleteOffersInBulkHandler::class,
            GenerateOfferCvs::class=> GenerateOfferCsvHandler::class,
            GetAllReturns::class => GetAllReturnsHandler::class,
            HandleReturn::class => HandleReturnHandler::class,
            GetShippingLabels::class => GetShippingLabelsHandler::class,
            GetShippingLabel::class => GetShippingLabelHandler::class,
            GetStatusByEntity::class => GetStatusByEntityHandler::class,
            GetStatusByProcessId::class => GetStatusByProcessIdHandler::class,
            GetShipment::class => GetShipmentHandler::class,
            GetShipmentList::class => GetShipmentListHandler::class
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
