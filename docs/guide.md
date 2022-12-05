## Functionalities

### Create a new crypto deposit address
?> `data['code']`:  Code for the coin you want to generate an address for. e.g (XLM, USDC)
  `data['network']`  erc20,trc20,bep20 and others
```php
FluidCoins::createNewAddress($data);
```

### Fetch addresses for a specific coin
?> `coin_id` Must be a uuid and you can fetch the id of the coin by using the v1/currencies endpoint
   `page` Page to query data from. Defaults to 1
   `per_page` Number of items to return. Defaults to 20 items
```php
FluidCoins::getAddresses($coin_id, $page = 1, $per_page = 20);
```

### Fetch a List of all crypto deposits
?> `page` Page to query data from. Defaults to 1
   `per_page` Number of items to return. Defaults to 20 items
```php
FluidCoins::getCryptoDeposits($page = 1, $per_page = 20);
```

### Fetch a single transaction that occurred on a given address
?> `reference`  address unique identifier.
```php
FluidCoins::getAddressSingleTransaction($reference);
```

### Fetch an address by its id
?> `reference`  address unique identifier.
```php
FluidCoins::getSingleAddress($reference);
```

### Fetch a list transactions for a given address
?> `reference`  address unique identifier. 
   `page` Page to query data from. Defaults to 1
   `per_page` Number of items to return. Defaults to 20 items
```php
FluidCoins::getAddressTransactions($reference, $page = 1, $per_page = 20);
```

### Fetch all balances of a merchant
```php
FluidCoins::getBalances();
```

### Fetch a single balance
?> `code` identifier of the balance ( e.g USDT, NGN)
```php
FluidCoins::getBalance($code);
```

### Fetch a List currencies
?> `test_net_only` Retrieve only coins that have a test-net network (defaults to false)
```php
FluidCoins::getCurrencies($test_net_only = false);
```

### Get Fiat rate
?> Fetch a list of the current exchange rate of all supported fiat currencies on Fluidcoins. If you provide both to and from query params, we will return only that currency pair.
   `from` base currency to convert from
   `to` base currency to convert to
```php
FluidCoins::getFiatRate($from, $to);
```