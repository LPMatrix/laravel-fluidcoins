## Functionalities

### Create a new crypto deposit address
   * @param {Array} data data to send
   * @param {('BTC' | 'USDT' | 'USDC' | 'ETH' | 'MATIC' | 'LTC'|
   * 'DODGE' | 'XRP' | 'XLM' | 'TRON' | 'BUSD' | 'BCH' | 'BNB')} data.code Code for the coin you want to generate an address for. e.g (XLM, USDC)
   * @param {string} data.network erc20,trc20,bep20 and others
```php
FluidCoins::createNewAddress($data);
```

### Fetch addresses for a specific coin
   * @param {string} [coin_id] fetch addresses for a specific coin.
   * Must be a uuid and you can fetch the id of the coin by using the v1/currencies endpoint
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
```php
FluidCoins::getAddresses($coin_id, $page = 1, $per_page = 20);
```

### Fetch a List of all crypto deposits
   * @param {number} page page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
```php
FluidCoins::getCryptoDeposits($page = 1, $per_page = 20);
```

### Fetch a single transaction that occurred on a given address
   * @param {string} reference  address unique identifier. E.g TRANS_xy
```php
FluidCoins::getAddressSingleTransaction($reference);
```

### Fetch an address by its id
   * @param {string} reference address unique identifier. E.g ADDR_xy
```php
FluidCoins::getSingleAddress($reference);
```

### Fetch a list transactions for a given address
   * @param {string} reference address unique identifier. E.g ADDR_xy
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
```php
FluidCoins::getAddressTransactions($reference, $page = 1, $per_page = 20);
```

### Fetch all balances of a merchant
```php
FluidCoins::getBalances();
```

### Fetch a single balance
   * @param {string} code identifier of the balance ( e.g USDT, NGN)
```php
FluidCoins::getBalance($code);
```

### Fetch a List currencies
   * @param {boolean} [test_net_only] Retrieve only coins that have a test-net network (defaults to false)
```php
FluidCoins::getCurrencies($test_net_only = false);
```

### Get Fiat rate
   * Fetch a list of the current exchange rate of all supported
   * fiat currencies on Fluidcoins. If you provide both to and from query params,
   * we will return only that currency pair.
   * @param {string} [from] base currency to convert from
   * @param {string} [to ]base currency to convert to
```php
FluidCoins::getFiatRate($from, $to);
```

### Fetch a List customers of customers
   * @param {boolean} [blacklisted] Fetch only blacklisted customers
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 10 items
```php
FluidCoins::getCustomers($blacklisted, $page = 1, $per_page = 10)
```

### Create a new customer
   * @param {{ email: string, full_name: string, phone?: { code: string, phone: string }}} data The data of the customer
   * @property
   * @param {string} data.email The email of the customer
   * @param {string} data.full_name The full name of the customer
   * @param {object} data.phone The phone object
   * @property
   * @param {string} data.phone.code The country code of the customer eg NG
   * @param {string} data.phone.phone The phone number of the customer eg 09090909090
```php
FluidCoins::createNewCustomer($data)
```

### Fetch a customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
```php
FluidCoins::getCustomer($reference)
```

### Edit a customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
   * @param {{ email?: string, full_name?: string, phone?: { code: string, phone: string }}} data customer data
   * @property
   * @param {string} data.email The email of the customer
   * @param {string} data.full_name The full name of the customer
   * @param {object} data.phone The phone object
   * @property
   * @param {string} data.phone.code The phone code of the customer eg NG
   * @param {string} data.phone.number The phone number of the customer eg 09090909090
   * @returns {Promise<any | undefined>} The response
   */
```php
FluidCoins::editCustomer($reference, $data)
```

### Whitelists a customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
```php
FluidCoins::whiteListCustomer($reference)
```

### Blacklists a customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
```php
FluidCoins::blackListCustomer($reference)
```

### Fetch a List of transactions that belong to a specific customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
   * @param {'success' | 'failed' | 'pending'} [status]  The status of the transaction
```php
FluidCoins::getCustomerTransactions($reference, $status)
```

### Fetch a List payment of links
   * @param {('disabled' | 'enabled')} [status] filter results by the status of the links Can either be disabled or enabled
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number of results per page. Defaults to 10
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
   * @param {string} reference Link unique identifier eg LINK_rkK
```php
FluidCoins::getSinglePaymentLink($reference)
```

### Edit a payment link
   * @param {string} reference Link unique identifier E.g LINK_xj
   * @param {{ amount: number, description: string, title: string, collect_phone_number?: boolean, disable_after_payment? boolean }} data The data Object
   * @property
   * @param {number} data.amount Amount in kobo/cents
   * @param {string} data.description The description of the payment link
   * @param {string} data.title The title of the payment link
   * @param {boolean} data.collect_phone_number CollectPhoneNumber set to true will request
   * for the phone number of the customer (defaults to false)
   * @param {boolean} data.disable_after_payment DisableAfterPayment set to true will disable
   * this payment link after the first successful payment (defaults to false)
```php
FluidCoins::editPaymentLink($reference, $data)
```

### Disable a payment link for collection
   * @param {string} reference payment link unique identifier E.g LINK_xj
```php
FluidCoins::disablePaymentLink($reference)
```

### Enables a payment link for collection
   * @param {string} reference payment link unique identifier E.g LINK_xj
   * @returns {Promise<any | undefined>} The response
   */
```php
FluidCoins::enablePaymentLink($reference)
```

### Fetch a List of transactions that belong to a payment link E.g LINK_xj
   * @param {string} reference Link unique identifier
```php
FluidCoins::getPaymentLinkTransactions($reference)
```

### Fetch the current merchant
```php
FluidCoins::getCurrentMerchant()
```

### Fetch a List of payouts
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
```php
FluidCoins::getPayouts($page = 1, $per_page = 20)
```

### Request for a payout
   * @param {number} amount Amount to be sent to the recipient.
   * Please note that this is shouldvbe in the currency's lowest denomination.
   * 1,000 Naira would be 100000 while 1 BTC would be 100 million satoshis
   * The currency is automatically retrieved from the payout account
   * @param {string} recipient The reference of the payout account, PAY_ACCT_XYZ
```php
FluidCoins::requestNewPayout($amount, $recipient)
```

### Fetch a List of payouts accounts
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
   * @returns {Promise<any | undefined>} The response
   */
```php
FluidCoins::getPayoutAccounts($page = 1, $per_page = 20)
```

### Create a new payout account with either bank or crypto
   * @param {object} data The data to be sent
   * @param {Object} data.bank - The bank object
   * @param {string} data.bank.account_number - The account number
   * @param {string} data.bank.bank_code - The bank code
   * @param {Object} data.crypto - The crypto object
   * @param {string} data.crypto.address - The crypto address
   * @param {string} data.crypto.label - The identifier eg. recipient name
   * @param {string} data.crypto.network - erc20,trc20,bep20 and others
   * @param {string} data.currency - The currency type only
```php
FluidCoins::createNewPayoutAccount($data)
```

### Fetch a List of banks
   * @param {string} [country=NG] - The country code
```php
FluidCoins::getBanks($country = "NG")
```

### Resolve bank accounts
   * @param {string} bank_code Sort code of the bank
   * @param {string} account Bank account number
```php
FluidCoins::resolveBankAccount($bank_code, $account)
```

### Cancels a payout
   * @param {string} reference payout unique identifier. E.g Payout_xx
```php
FluidCoins::cancelPayout($reference)
```

### Fetch the details of a payout
   * @param {string} reference payout unique identifier. E.g Payout_xx
```php
FluidCoins::getPayoutDetails($reference)
```

### Fetch swap history
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 10 items
```php
FluidCoins::getSwapHistory($page = 1, $per_page = 10)
```

### Fetch a List of transactions
   * @param {'success' | 'failed' | 'pending'} status filter results by the status of the links
   * Can either be success, failed or pending
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number of results per page. Defaults to 10
```php
FluidCoins::getAllTransactions($status, $page = 1, $per_page = 10)
```

### Fetch a single transaction
   * @param {number} reference Unique ID for the transaction eg (TRANS_qgc)
```php
FluidCoins::getSingleTransaction($reference)
```