## Functionalities

### Create a new crypto deposit address
   * `data` (Array): data to send
   * `data.code` (String): Code for the coin you want to generate an address for. e.g. `XLM`, `USDC`
   * `data.network` (String): erc20, trc20, bep20 and others
```php
FluidCoins::createNewAddress($data);
```

### Fetch addresses for a specific coin
   * `coin_id` (string): fetch addresses for a specific coin. Must be a uuid and you can fetch the id of the coin by using the v1/currencies endpoint
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 20 items
```php
FluidCoins::getAddresses($coin_id, $page = 1, $per_page = 20);
```

### Fetch a List of all crypto deposits
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 20 items
```php
FluidCoins::getCryptoDeposits($page = 1, $per_page = 20);
```

### Fetch a single transaction that occurred on a given address
   * `reference` (string):  address unique identifier. E.g TRANS_xy
```php
FluidCoins::getAddressSingleTransaction($reference);
```

### Fetch an address by its id
   * `reference` (string):  address unique identifier. E.g ADDR_xy
```php
FluidCoins::getSingleAddress($reference);
```

### Fetch a list transactions for a given address
   * `reference` (string):  address unique identifier. E.g ADDR_xy
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 20 items
```php
FluidCoins::getAddressTransactions($reference, $page = 1, $per_page = 20);
```

### Fetch all balances of a merchant
```php
FluidCoins::getBalances();
```

### Fetch a single balance
   * `code` {string}  identifier of the balance ( e.g `USDT`, `NGN`)
```php
FluidCoins::getBalance($code);
```

### Fetch a List currencies
   * `test_net_only` (boolean): Retrieve only coins that have a test-net network (defaults to false)
```php
FluidCoins::getCurrencies($test_net_only = false);
```

### Get Fiat rate
   * Fetch a list of the current exchange rate of all supported
   * fiat currencies on Fluidcoins. If you provide both to and from query params, we will return only that currency pair.
   * `from` (string): base currency to convert from
   * `to` (string): base currency to convert to
```php
FluidCoins::getFiatRate($from, $to);
```

### Fetch a List customers of customers
   * `blacklisted` (boolean): Fetch only blacklisted customers
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 20 items
```php
FluidCoins::getCustomers($blacklisted, $page = 1, $per_page = 10)
```

### Create a new customer
   * `data` {{ email: string, full_name: string, phone?: { code: string, phone: string }}}: The data of the customer
   * data.email` (string): The email of the customer
   * `data.full_name` (string): The full name of the customer
   * `data.phone` (object): The phone object
   * `data.phone.code` (string): The country code of the customer eg NG
   * `data.phone.number` (string): The phone number of the customer eg 09090909090
```php
FluidCoins::createNewCustomer($data)
```

### Fetch a customer
   * `reference` (string):  customer unique identifier. E.g CUS_xyz
```php
FluidCoins::getCustomer($reference)
```

### Edit a customer
   * `reference` (string): Customer unique identifier. E.g CUS_xyz
   * `data` {{ email?: string, full_name?: string, phone?: { code: string, phone: string }}}: customer data
   * `data.email` (string): The email of the customer
   * `data.full_name` (string): The full name of the customer
   * `data.phone` (object): The phone object
   * `data.phone.code` (string): The phone code of the customer eg NG
   * `data.phone.number` (string): The phone number of the customer eg 09090909090
```php
FluidCoins::editCustomer($reference, $data)
```

### Whitelists a customer
   * `reference` (string):  customer unique identifier. E.g CUS_xyz
```php
FluidCoins::whiteListCustomer($reference)
```

### Blacklists a customer
   * `reference` (string):  customer unique identifier. E.g CUS_xyz
```php
FluidCoins::blackListCustomer($reference)
```

### Fetch a List of transactions that belong to a specific customer
   * `reference` (string):  customer unique identifier. E.g CUS_xyz E.g CUS_xyz
   * `status` ('success' | 'failed' | 'pending'):  The status of the transaction
```php
FluidCoins::getCustomerTransactions($reference, $status)
```

### Fetch a List payment of links
   * `status` ('disabled' | 'enabled'): filter results by the status of the links Can either be disabled or enabled
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 20 items
```php
FluidCoins::getPaymentLinks($status, $page = 1, $per_page = 20)
```

### Create a new payment link
   * @param {{ amount: number, description: string, title: string, collect_phone_number?: boolean, currency?: 'USD' | 'NGN', disable_after_payment? boolean }} data The data Object
   * @property
   * @param {number} data.amount Amount in kobo/cents
   * @param {string} data.description The description of the payment link
   * @param {string} data.title The title of the payment link
   * @param {boolean} [data.collect_phone_number] CollectPhoneNumber set to true will request
   * for the phone number of the customer (defaults to false)
   * @param {'USD' | 'NGN'} [data.currency] Currency denotes the currency this payment link
   * should be denoted in supported: USD, NGN. Will default to NGN
   * @param {boolean} [data.disable_after_payment] DisableAfterPayment set to true will disable
   * this payment link after the first successful payment (defaults to false)
```php
FluidCoins::createNewPaymentLink($data)
```

### Fetch a payment link
   * `reference` (string):  link unique identifier. E.g CUS_xyz eg LINK_rkK
```php
FluidCoins::getSinglePaymentLink($reference)
```

### Edit a payment link
   * `reference` (string):  link unique identifier. E.g CUS_xyz E.g LINK_xj
   * `data` { amount: number, description: string, title: string, collect_phone_number?: boolean, disable_after_payment? boolean }: The data Object
   * `data.amount` (number): Amount in kobo/cents
   * `data.description` {string): The description of the payment link
   * `data.title` (string): The title of the payment link
   * `data.collect_phone_number` (boolean): CollectPhoneNumber set to true will request for the phone number of the customer (defaults to false)
   * `data.disable_after_payment` (boolean): DisableAfterPayment set to true will disable this payment link after the first successful payment (defaults to false)
```php
FluidCoins::editPaymentLink($reference, $data)
```

### Disable a payment link for collection
   * `reference` (string):  payment link unique identifier. E.g LINK_xj
```php
FluidCoins::disablePaymentLink($reference)
```

### Enables a payment link for collection
   * `reference` (string):  payment link unique identifier. E.g LINK_xj
   * @returns {Promise<any | undefined>} The response
   */
```php
FluidCoins::enablePaymentLink($reference)
```

### Fetch a List of transactions that belong to a payment link E.g LINK_xj
   * `reference` (string):  link unique identifier. E.g LINK_xyz
```php
FluidCoins::getPaymentLinkTransactions($reference)
```

### Fetch the current merchant
```php
FluidCoins::getCurrentMerchant()
```

### Fetch a List of payouts
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 20 items
```php
FluidCoins::getPayouts($page = 1, $per_page = 20)
```

### Request for a payout
   * `amount` (number): Amount to be sent to the recipient.
   * Please note that this is shouldvbe in the currency's lowest denomination.
   * 1,000 Naira would be 100000 while 1 BTC would be 100 million satoshis
   * The currency is automatically retrieved from the payout account
   * `recipient` (string): The reference of the payout account, PAY_ACCT_XYZ
```php
FluidCoins::requestNewPayout($amount, $recipient)
```

### Fetch a List of payouts accounts
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 20 items
```php
FluidCoins::getPayoutAccounts($page = 1, $per_page = 20)
```

### Create a new payout account with either bank or crypto
   * `data` (object):  The data to be sent
   * `data.bank` (Object): The bank object
   * `data.bank.account_number` (string): The account number
   * `data.bank.bank_code` (string): The bank code
   * `data.crypto` (Object): The crypto object
   * `data.crypto.address` (string): The crypto address
   * `data.crypto.label` (string): The identifier eg. recipient name
   * `data.crypto.network` (string):  erc20,trc20,bep20 and others
   * `data.currency` (string): The currency type only
```php
FluidCoins::createNewPayoutAccount($data)
```

### Fetch a List of banks
   * `country=NG` (string): - The country code
```php
FluidCoins::getBanks($country = "NG")
```

### Resolve bank accounts
   * `bank_code` (string):  Sort code of the bank
   * `account` (string):  Bank account number
```php
FluidCoins::resolveBankAccount($bank_code, $account)
```

### Cancels a payout
   * `reference` (string):  payout unique identifier. E.g Payout_xx
```php
FluidCoins::cancelPayout($reference)
```

### Fetch the details of a payout
   * `reference` (string):  payout unique identifier. E.g Payout_xx
```php
FluidCoins::getPayoutDetails($reference)
```

### Fetch swap history
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 10 items
```php
FluidCoins::getSwapHistory($page = 1, $per_page = 10)
```

### Fetch a List of transactions
   * `status` ('success' | 'failed' | 'pending'):  filter results by the status of the links. Can either be success, failed or pending
   * `page` (number):  Page to query data from. Defaults to 1
   * `per_page` (number):  Number to items to return. Defaults to 10 items
```php
FluidCoins::getAllTransactions($status, $page = 1, $per_page = 10)
```

### Fetch a single transaction
   * `reference` (number): Unique ID for the transaction eg (TRANS_qgc)
```php
FluidCoins::getSingleTransaction($reference)
```