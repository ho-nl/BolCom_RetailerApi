# BolCom_Api
Bol.com API documentation can be found [here](https://api.bol.com/retailer/public/redoc/v3).

## Features
- Uses bol.com API v3.
- Strict type checking.
- Support multiple bol.com accounts.

## Code Samples
### How to use the `ClientPool`
A client pool is used to support multiple bol.com accounts.
We can configure the pool with a default client if only one seller account will be active.

```PHP
$clientPool = \BolCom\RetailerApi\Infrastructure\ClientPool::configure(
    new \BolCom\RetailerApi\Client\ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET)
);
$messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);
$messageBus->dispatch($command);
```

To support multiple accounts you can rewrite the `ClientPool` and add the clients to the pool.
```PHP
<?php
declare(strict_types=1);

namespace Vendor\Module\Model\Client;

class ClientPool extends \BolCom\RetailerApi\Infrastructure\ClientPool
{
    public function __construct()
    {
        $clients = [];

        foreach (['store1', 'store2'] as $store) {
            /** @var \BolCom\RetailerApi\Client\ClientConfigInterface $config */
            $config = new \Vendor\Module\Client\ClientConfig();

            if ($config->enabled()) {
                $clients[$store] = new \BolCom\RetailerApi\Client($config);
            }
        }

        parent::__construct($clients);
    }
}
```

### How to use the `MessageBus`
A message bus is used to fetch data from the API.

```PHP
$commission = $messageBus->dispatch(
    \BolCom\RetailerApi\Model\Commission\Query\GetCommission::with(
        \BolCom\RetailerApi\Model\Offer\Ean::fromString('9781785882364'),
        \BolCom\RetailerApi\Model\Offer\Condition::IS_NEW(),
        \BolCom\RetailerApi\Model\CurrencyAmount::fromScalar(10.11)
    )
);
```

## Running Integration Tests
Place this code in your `phpunit.xml` and update the values with your own test credentials.

```XML
<php>
    <const name="BOL_CLIENT_ID" value="test_value"/>
    <const name="BOL_CLIENT_SECRET" value="test_value"/>
</php>
```
