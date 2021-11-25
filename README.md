<div align="center">
    <a href="https://travis-ci.com/ho-nl/BolCom_RetailerApi">
        <img src="https://travis-ci.com/ho-nl/BolCom_RetailerApi.svg?branch=master">
    </a>
</div>

# BolCom_Api
Bol.com API documentation can be found [here](https://api.bol.com/retailer/public/redoc/v3).

## Features
- Uses bol.com API v4.
- Strict type checking.
- Support multiple bol.com accounts.

## Usage
### How to use the `ClientPool`
A client pool is used to support multiple bol.com accounts.
We can configure the pool with a default client if only one seller account will be active.

```PHP
<?php declare(strict_types=1);

$messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus(
    \BolCom\RetailerApi\Infrastructure\ClientPool::configure(
        new \BolCom\RetailerApi\Client\ClientConfig('clientId', 'clientSecret')
    )
);

/** @var \BolCom\RetailerApi\Model\Order\Order $order */
$order = $messageBus->dispatch(\BolCom\RetailerApi\Model\Order\Query\GetOrder::with(
    \BolCom\RetailerApi\Model\Order\OrderId::fromString('7616222250')
));
```

### Multiple account support
To support multiple accounts you can create your own `ClientPool` and add multiple clients to the pool.

```PHP
<?php declare(strict_types=1);

$clientPool = new \BolCom\RetailerApi\Infrastructure\ClientPool([
  'account1' => new \BolCom\RetailerApi\Client(new \BolCom\RetailerApi\Client\ClientConfig('clientId1', 'clientSecret1', false, '/tmp/bol_access_token_clientId1.json')),
  'account2' => new \BolCom\RetailerApi\Client(new \BolCom\RetailerApi\Client\ClientConfig('clientId2', 'clientSecret2', false, '/tmp/bol_access_token_clientId2.json')),
]);
$messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

//Request from a specific client
/** @var \BolCom\RetailerApi\Model\Order\Order $order */
$order = $messageBus->dispatch(\BolCom\RetailerApi\Model\Order\Query\GetOrder::with(
    \BolCom\RetailerApi\Model\Order\OrderId::fromString('7616222250')
), 'account2');

//Request from all clients
foreach ($clientPool->names() as $name) {
    /** @var \BolCom\RetailerApi\Model\Order\Order $order */
    $order = $messageBus->dispatch(\BolCom\RetailerApi\Model\Order\Query\GetOrder::with(
        \BolCom\RetailerApi\Model\Order\OrderId::fromString('7616222250')
    ), $name);
}
```

## Running integration tests
Place this code in your `phpunit.xml` and update the values with your own test credentials.

```XML
<php>
    <const name="BOL_CLIENT_ID" value="test_value"/>
    <const name="BOL_CLIENT_SECRET" value="test_value"/>
</php>
```

## Supported handlers
### Commission
#### GetCommissionHandler
```PHP
/** @var \BolCom\RetailerApi\Model\Commission\Commission $commission */
$commission = $messageBus->dispatch(\BolCom\RetailerApi\Model\Commission\Query\GetCommission::with(
    \BolCom\RetailerApi\Model\Offer\Ean::fromString('9781785882364'),
    \BolCom\RetailerApi\Model\Offer\Condition::IS_NEW(),
    \BolCom\RetailerApi\Model\CurrencyAmount::fromScalar(10.11)
));
```

#### GetCommissionListHandler
```PHP
/** @var \BolCom\RetailerApi\Model\Commission\Query\GetCommissionList $commissionList */
$commissionList = $messageBus->dispatch(\BolCom\RetailerApi\Model\Commission\Query\GetCommissionList::with(
    \BolCom\RetailerApi\Model\Commission\CommissionQuery::fromArray([
        'ean' => '9781785882364',
        'condition' => \BolCom\RetailerApi\Model\Offer\Condition::IS_NEW,
        'price' => 10.11
    ])
));
```

### Offer
#### CreateOfferHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Offer\Command\CreateOffer::with(
    \BolCom\RetailerApi\Model\Offer\RetailerOfferUpsert::fromArray([
        'ean' => '9781785882364',
        'condition' => [
            'name' => \BolCom\RetailerApi\Model\Offer\Condition::IS_NEW,
            'category' => \BolCom\RetailerApi\Model\Offer\ConditionCategory::IS_NEW
        ],
        'referenceCode' => 'SKU123',
        'onHoldByRetailer' => false,
        'unknownProductTitle' => 'My Title',
        'pricing' => [
            'bundlePrices' => [
                ['quantity' => 1, 'price' => 10],
                ['quantity' => 10, 'price' => 8]
            ]
        ],
        'stock' => [
            'amount' => 12,
            'managedByRetailer' => true
        ],
        'fulfilment' => [
            'type' => \BolCom\RetailerApi\Model\Offer\FulfilmentMethod::FBR,
            'deliveryCode' => \BolCom\RetailerApi\Model\Offer\DeliveryCode::DC12d
        ]
    ])
));
```

#### DeleteOfferHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Offer\Command\DeleteOffer::with(
    \BolCom\RetailerApi\Model\Offer\OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5')
));
```

#### GetOfferHandler
```PHP
/** @var \BolCom\RetailerApi\Model\Offer\RetailerOffer $offer */
$offer = $messageBus->dispatch(\BolCom\RetailerApi\Model\Offer\Query\GetOffer::with(
    \BolCom\RetailerApi\Model\Offer\OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5')
));
```

#### UpdateOfferHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Offer\Command\UpdateOffer::with(
    \BolCom\RetailerApi\Model\Offer\OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5'),
    \BolCom\RetailerApi\Model\Offer\RetailerOfferUpdate::fromArray([
        'referenceCode' => 'SKU123',
        'onHoldByRetailer' => false,
        'unknownProductTitle' => 'My Title',
        'fulfilment' => [
            'type' => \BolCom\RetailerApi\Model\Offer\FulfilmentMethod::FBR,
            'deliveryCode' => \BolCom\RetailerApi\Model\Offer\DeliveryCode::DC12d
        ]
    ])
));
```

#### UpdateOfferPriceHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Offer\Command\UpdateOfferPrice::with(
    \BolCom\RetailerApi\Model\Offer\OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5'),
    \BolCom\RetailerApi\Model\Offer\Pricing::fromArray([
        'bundlePrices' => [
            ['quantity' => 1, 'price' => 12]
            ['quantity' => 10, 'price' => 10]
        ]
    ])
));
```

#### UpdateOfferStockHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Offer\Command\UpdateOfferStock::with(
    \BolCom\RetailerApi\Model\Offer\OfferId::fromString('6ff736b5-cdd0-4150-8c67-78269ee986f5'),
    \BolCom\RetailerApi\Model\Offer\Stock::fromArray([
        'amount' => 97,
        'managedByRetailer' => false
    ])
));
```

#### ExportFileRequestHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Offer\Query\ExportFileRequest::with('CSV'));
```

#### GetExportFileHandler (use after GetStatusByProcessIds for entityId value)
```PHP
/** @var \Psr\Http\Message\StreamInterface $stream */
$stream = $messageBus->dispatch(\BolCom\RetailerApi\Model\Offer\Query\ExportFile::with(
    '1353a98b-be21-413b-bf13-4aa0927026c6'
));
```

### Inventory
#### GetInventoryHandler
```PHP
/** @var \BolCom\RetailerApi\Model\Inventory\InventoryOfferList $inventoryOfferList */
$inventoryOfferList = $messageBus->dispatch(\BolCom\RetailerApi\Model\Inventory\Query\GetInventory::with(
    1,
    '8718526069334'
    \BolCom\RetailerApi\Model\Inventory\Stock::fromValue('SUFFICIENT')
    \BolCom\RetailerApi\Model\Inventory\State::fromValue('SALEABLE')
    ['0-10', '20-30']
));
```

### Order
#### CancelOrderHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Order\Command\CancelOrder::with(
    \BolCom\RetailerApi\Model\Order\OrderItemId::fromString('6107434013'),
    \BolCom\RetailerApi\Model\DateTime::fromString((new \DateTime())->format(\DateTime::ATOM)),
    \BolCom\RetailerApi\Model\Order\CancellationReason::REQUESTED_BY_CUSTOMER()
));
```

#### GetAllOpenOrdersHandler
```PHP
/** @var null|\BolCom\RetailerApi\Model\Order\OrderList $orderList */
$orderList = $messageBus->dispatch(\BolCom\RetailerApi\Model\Order\Query\GetAllOpenOrders::with(
    1,
    \BolCom\RetailerApi\Model\Offer\FulfilmentMethod::FBR()
));
```

#### GetOrderHandler
```PHP
/** @var \BolCom\RetailerApi\Model\Order\Order $order */
$order = $messageBus->dispatch(\BolCom\RetailerApi\Model\Order\Query\GetOrder::with(
    \BolCom\RetailerApi\Model\Order\OrderId::fromString('7616222250')
));
```

#### ShipOrderItemHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Order\Command\ShipOrderItem::with(
    \BolCom\RetailerApi\Model\Order\OrderItemId::fromString('6107434013'),
    'Shipment Reference',
    \BolCom\RetailerApi\Model\Transport\TransportInstruction::fromArray([
        'transporterCode' => 'TNT',
        'trackAndTrace' => '123456789'
    ])
));
```

### ProcessStatus
#### GetStatusByEntityHandler
```PHP
/** @var null|\BolCom\RetailerApi\Model\ProcessStatus\ProcessStatuses $processStatuses */
$processStatuses = $messageBus->dispatch(\BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByEntity::with(
    \BolCom\RetailerApi\Model\ProcessStatus\EntityId::fromString('6107432387'),
    \BolCom\RetailerApi\Model\ProcessStatus\EventType::fromValue('CANCEL_ORDER'),
    1
));
```

#### GetStatusByProcessIdsHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatuses $processStatuses */
$processStatuses = $messageBus->dispatch(\BolCom\RetailerApi\Model\ProcessStatus\Query\GetStatusByProcessIds::with(
    ...[6107432387]
));
```

### Rma
#### GetAllReturnsHandler
```PHP
/** @var null|\BolCom\RetailerApi\Model\Rma\ReturnItemList $returnItemList */
$returnItemList = $messageBus->dispatch(\BolCom\RetailerApi\Model\Rma\Query\GetAllReturns::with(
    1,
    false,
    \BolCom\RetailerApi\Model\Offer\FulfilmentMethod::FBR()
));
```

#### GetReturnHandler
```PHP
/** @var \BolCom\RetailerApi\Model\Rma\ReturnItem $returnItem */
$returnItem = $messageBus->dispatch(\BolCom\RetailerApi\Model\Rma\Query\GetReturn::with(
    \BolCom\RetailerApi\Model\Rma\RmaId::fromScalar(86127199)
));
```

#### HandleReturnHandler
```PHP
/** @var \BolCom\RetailerApi\Model\ProcessStatus\ProcessStatus $processStatus */
$processStatus = $messageBus->dispatch(\BolCom\RetailerApi\Model\Rma\Command\HandleReturn::with(
    \BolCom\RetailerApi\Model\Rma\RmaId::fromScalar(31234567),
    \BolCom\RetailerApi\Model\Rma\HandlingResult::RETURN_RECEIVED(),
    \BolCom\RetailerApi\Model\Rma\QuantityReturned::fromScalar(1)
));
```

### Shipment
#### GetShipmentHandler
```PHP
/** @var \BolCom\RetailerApi\Model\Shipment\Shipment $shipment */
$shipment = $messageBus->dispatch(\BolCom\RetailerApi\Model\Shipment\Query\GetShipment::with(
    \BolCom\RetailerApi\Model\Shipment\ShipmentId::fromScalar(541757635)
));
```

#### GetShipmentListHandler
```PHP
/** @var null|\BolCom\RetailerApi\Model\Shipment\ShipmentList $shipmentList */
$shipmentList = $messageBus->dispatch(\BolCom\RetailerApi\Model\Shipment\Query\GetShipmentList::with(
    1,
    \BolCom\RetailerApi\Model\Offer\FulfilmentMethod::FBR(),
    \BolCom\RetailerApi\Model\Order\OrderId::fromString('7616222250')
));
```
