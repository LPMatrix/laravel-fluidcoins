<?php

namespace LPMatrix\Fluidcoins;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class Fluidcoins
{
  protected $secretkey;
  protected $request;
  protected $response;
  protected $baseUrl = "https://api.fluidcoins.com";

  /**
   *This is a constructor for creating a Fluidcoins Instance
   * @param {string} secretkey - Fluidcoins secret key
   * @returns { FluidCoins } - An instance of FluidCoins
   */
  public function __construct() {
    
    $this->setKey();
    $this->setRequestOptions();
  }

  /**
   * Get secret key from Fluidcoins config file
   */
  public function setKey()
  {
      $this->secretKey = Config::get('fluidcoins.secretKey');
  }

  /**
   * Set options for making the Client request
   */
  private function setRequestOptions()
  {
    $authBearer = 'Bearer '. $this->secretKey;
    $this->request = new Client(
        [
            'base_uri' => $this->baseUrl,
            'verify' => false,
            'headers' => [
                'Authorization' => $authBearer,
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
            ]
        ]
    );
  }

  /**
   * Get the whole response from a get operation
   * @return array
   */
  private function getResponse()
  {
      return json_decode($this->response->getBody(), true);
  }

  /**
     * @param string $relativeUrl
     * @param string $method
     * @param array $body
     * @return Fluidcoins
     * @throws IsNullException
     */
    private function setHttpResponse($relativeUrl, $method, $body = [])
    {
        if (is_null($method)) {
            throw new IsNullException("Empty method not allowed");
        }
        $this->response = $this->request->{strtolower($method)}(
            $this->baseUrl . $relativeUrl,
            ["body" => json_encode($body)]
        );
        return $this;
    }

  /**
   * Fetchs addresses for a specific coin
   * @param {string} [coin_id] fetch addresses for a specific coin.
   * Must be a uuid and you can fetch the id of the coin by using the v1/currencies endpoint
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
   * @returns {Promise<any | undefined>} The response
   */
  public static function getAddresses($coin_id, $page = 1, $per_page = 20) {
    try {
      return (new self)->setHttpResponse(
        `/v1/address?page={$page}&per_page=${per_page}&coin_id={$coin_id}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Create a new address
   * @param {Object} data data to send
   * @param {('BTC' | 'USDT' | 'USDC' | 'ETH' | 'MATIC' | 'LTC'|
   * 'DODGE' | 'XRP' | 'XLM' | 'TRON' | 'BUSD' | 'BCH' | 'BNB')} data.code Code for the coin you want to generate an address for. e.g (XLM, USDC)
   * @param {string} data.network erc20,trc20,bep20 and others
   * @returns {Promise<any | undefined>} The address created or Exception $eor
   */
  public static function createNewAddress($data) {
    try {
      return (new self)->setHttpResponse("/v1/address", 'POST', $data)->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List of all crypto deposits
   * @param {number} page page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
   * @returns {Promise<any | undefined>} The response
   */
  public static function getCryptoDeposits($page = 1, $per_page = 20) {
    try {
       return (new self)->setHttpResponse(
        `/v1/address/transactions?page={$page}&per_page={$per_page}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetch a single transaction that occurred on a given address
   * @param {string} reference  address unique identifier. E.g TRANS_xy
   * @returns {Promise<any | undefined>} The response
   */
  public static function getAddressSingleTransaction($reference) {
    try {
       return (new self)->setHttpResponse(
        `/v1/address/transactions/{$reference}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches an address by its id
   * @param {string} reference address unique identifier. E.g ADDR_xy
   * @returns {Promise<any | undefined>} The address or Exception $eor
   */
  public static function getSingleAddress($reference) {
    try {
      return (new self)->setHttpResponse(`/v1/address/{$reference}`, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a list transactions for a given address
   * @param {string} reference address unique identifier. E.g ADDR_xy
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
   * @returns {Promise<any | undefined>} The response
   */
  public static function getAddressTransactions($reference, $page = 1, $per_page = 20) {
    try {
      return (new self)->setHttpResponse(
        `/v1/address/${reference}/transactions?page={$page}&per_page={$per_page}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches all balances of a merchant
   * @returns {Promise<any | undefined>} The response
   */
  public static function getBalances() {
    try {
      return (new self)->setHttpResponse("/v1/balances", 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetch a single balance
   * @param {string} code identifier of the balance ( e.g USDT, NGN)
   * @returns {Promise<any | undefined>} The response
   */
  public static function getBalance($code) {
    try {
      return (new self)->setHttpResponse(`/v1/balances/{$code}`, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List currencies
   * @param {boolean} [test_net_only] Retrieve only coins that have a test-net network (defaults to false)
   * @returns {Promise<any | undefined>} The response
   */
  public static function getCurrencies($test_net_only = false) {
    try {
      return (new self)->setHttpResponse(
        `/v1/currencies?test_net_only={$test_net_only}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetch a list of the current exchange rate of all supported
   * fiat currencies on Fluidcoins. If you provide both to and from query params,
   * we will return only that currency pair.
   * @param {string} [from] base currency to convert from
   * @param {string} [to ]base currency to convert to
   * @returns {Promise<any | undefined>} The response
   */
  public static function getFiatRate($from, $to) {
    $url = "/v1/rates";
    if ($from && $to) {
      $url = `/v1/rates?from={$from}&to={$to}`;
    }
    try {
      return (new self)->setHttpResponse($url, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List customers of customers
   * @param {boolean} [blacklisted] Fetch only blacklisted customers
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 10 items
   * @returns {Promise<any | undefined>} The response
   */
  public static function getCustomers($blacklisted, $page = 1, $per_page = 10) {
    try {
      $url = `/v1/customers?page={$page}&per_page={$per_page}`;
      if ($blacklisted) {
        $url = `/v1/customers?page={$page}&per_page={$per_page}&blacklisted={$blacklisted}`;
      }
      return (new self)->setHttpResponse($url, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Create a new customer
   * @param {{ email: string, full_name: string, phone?: { code: string, phone: string }}} data The data of the customer
   * @property
   * @param {string} data.email The email of the customer
   * @param {string} data.full_name The full name of the customer
   * @param {object} data.phone The phone object
   * @property
   * @param {string} data.phone.code The country code of the customer eg NG
   * @param {string} data.phone.phone The phone number of the customer eg 09090909090
   * @returns {Promise<any | undefined>} The response
   */
  public static function createNewCustomer($data) {
    try {
      return (new self)->setHttpResponse("/v1/customers", 'POST', $data)->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetch a customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
   * @returns {Promise<any | undefined>} The response
   */
  public static function getCustomer($reference) {
    try {
      return (new self)->setHttpResponse(`/v1/customers/{$reference}`, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Edit a customer
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
  public static function editCustomer($reference, $data) {
    try {
      return (new self)->setHttpResponse(
        `/v1/customers/{$reference}`, 'PATCH',
        $data
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Whitelists a customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
   * @returns {Promise<any | undefined>} The response
   */
  public static function whiteListCustomer($reference) {
    try {
      return (new self)->setHttpResponse(
        `/v1/customers/{$reference}/blacklist`, 'DELETE'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Blacklists a customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
   * @returns {Promise<any | undefined>} The response
   */
  public static function blackListCustomer($reference) {
    try {
      return (new self)->setHttpResponse(
        `/v1/customers/{$reference}/blacklist`, 'POST'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List of transactions that belong to a specific customer
   * @param {string} reference Customer unique identifier. E.g CUS_xyz
   * @param {'success' | 'failed' | 'pending'} [status]  The status of the transaction
   * @returns {Promise<any | undefined>} The response
   */
  public static function getCustomerTransactions($reference, $status) {
    $url = `/v1/customers/{$reference}/transactions`;
    if ($status) {
      $url = `/v1/customers/{$reference}/transactions?status={$status}`;
    }
    try {
      return (new self)->setHttpResponse($url, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List payment of links
   * @param {('disabled' | 'enabled')} [status] filter results by the status of the links Can either be disabled or enabled
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number of results per page. Defaults to 10
   * @returns {Promise<any | undefined>} The response
   */
  public static function getPaymentLinks($status, $page = 1, $per_page = 20) {
    $url = `/v1/links?page={$page}&per_page={$per_page}`;
    if (status) {
      $url = `/v1/links?page={$page}&per_page={$per_page}&status{$status}`;
    }
    try {
      return (new self)->setHttpResponse($url, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  // eslint-disable-next-line valid-jsdoc
  /**
   * Create a new payment link
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
   * @returns {Promise<any | undefined>} The response
   */
  public static function createNewPaymentLink($data) {
    try {
      return (new self)->setHttpResponse("/v1/links", 'POST', $data)->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetchs a payment link
   * @param {string} reference Link unique identifier eg LINK_rkK
   * @returns {Promise<any | undefined>} The response
   */
  public static function getSinglePaymentLink($reference) {
    try {
      return (new self)->setHttpResponse(`/v1/links/{$reference}`, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  // eslint-disable-next-line valid-jsdoc
  /**
   * Edits a payment link
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
   * @returns {Promise<any | undefined>} The response
   */
  public static function editPaymentLink($reference, $data) {
    try {
      return (new self)->setHttpResponse(`/v1/links/{$reference}`, 'PATCH', $data)->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Disables a payment link for collection
   * @param {string} reference payment link unique identifier E.g LINK_xj
   * @returns {Promise<any | undefined>} The response
   */
  public static function disablePaymentLink($reference) {
    try {
      return (new self)->setHttpResponse(
        `/v1/links/{$reference}/enable`, 'DELETE'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Enables a payment link for collection
   * @param {string} reference payment link unique identifier E.g LINK_xj
   * @returns {Promise<any | undefined>} The response
   */
  public static function enablePaymentLink($reference) {
    try {
      return (new self)->setHttpResponse(`/v1/links/{$reference}/enable`, 'POST')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List of transactions that belong to a payment link E.g LINK_xj
   * @param {string} reference Link unique identifier
   * @returns {Promise<any | undefined>} The response
   */
  public static function getPaymentLinkTransactions($reference) {
    try {
      return (new self)->setHttpResponse(
        `/v1/links/{$reference}/transactions`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches the current merchant
   * @returns {Promise<any | undefined>} The response
   */
  public static function getCurrentMerchant() {
    try {
      return (new self)->setHttpResponse("/v1/merchant", 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List of payouts
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
   * @returns {Promise<any | undefined>} The response
   */
  public static function getPayouts($page = 1, $per_page = 20) {
    try {
      return (new self)->setHttpResponse(
        `/v1/payouts?page={$page}&per_page={$per_page}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Request for a payout
   * @param {number} amount Amount to be sent to the recipient.
   * Please note that this is shouldvbe in the currency's lowest denomination.
   * 1,000 Naira would be 100000 while 1 BTC would be 100 million satoshis
   * The currency is automatically retrieved from the payout account
   * @param {string} recipient The reference of the payout account, PAY_ACCT_XYZ
   * @returns {Promise<any | undefined>} The response
   */
  public static function requestNewPayout($amount, $recipient) {
    try {
      return (new self)->setHttpResponse("/v1/payouts", 'POST', [
        'amount'=> $amount,
        'recipient'=> $recipient,
      ])->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List of payouts accounts
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 20 items
   * @returns {Promise<any | undefined>} The response
   */
  public static function getPayoutAccounts($page = 1, $per_page = 20) {
    try {
      return (new self)->setHttpResponse(
        `/v1/payouts/accounts?page={$page}&per_page={$per_page}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Creates a new payout account with either bank or crypto
   * @param {object} data The data to be sent
   * @param {Object} data.bank - The bank object
   * @param {string} data.bank.account_number - The account number
   * @param {string} data.bank.bank_code - The bank code
   * @param {Object} data.crypto - The crypto object
   * @param {string} data.crypto.address - The crypto address
   * @param {string} data.crypto.label - The identifier eg. recipient name
   * @param {string} data.crypto.network - erc20,trc20,bep20 and others
   * @param {string} data.currency - The currency type only
   * @returns {Promise<any | undefined>} The response
   */
  public static function createNewPayoutAccount($data) {
    try {
      return (new self)->setHttpResponse("/v1/payouts/accounts", 'POST', $data)->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a List of banks
   * @param {string} [country=NG] - The country code
   * @returns {Promise<any | undefined>} The response
   */
  public static function getBanks($country = "NG") {
    try {
      return (new self)->setHttpResponse(
        `/v1/payouts/accounts/banks?country={$country}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Resolves bank accounts
   * @param {string} bank_code Sort code of the bank
   * @param {string} account Bank account number
   * @returns {Promise<any | undefined>} The response
   */
  public static function resolveBankAccount($bank_code, $account) {
    try {
      return (new self)->setHttpResponse(
        `/v1/payouts/accounts/banks/resolve?bank_code={$bank_code}&account={$account}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Cancels a payout
   * @param {string} reference payout unique identifier. E.g Payout_xx
   * @returns {Promise<any | undefined>} The response
   */
  public static function cancelPayout($reference) {
    try {
      return (new self)->setHttpResponse(`/v1/payouts/{$reference}`, 'DELETE')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches the details of a payout
   * @param {string} reference payout unique identifier. E.g Payout_xx
   * @returns {Promise<any | undefined>} The response
   */
  public static function getPayoutDetails($reference) {
    try {
      return (new self)->setHttpResponse(`/v1/payouts/{$reference}`, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches swap history
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number to items to return. Defaults to 10 items
   * @returns {Promise<any | undefined>} The response
   */
  public static function getSwapHistory($page = 1, $per_page = 10) {
    try {
      return (new self)->setHttpResponse(`/v1/swaps?page={$page}&per_page={$per_page}`, 'GET'
      )->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  // /**
  //  * Swap currencies
  //  * @param {number} amount Non zero amount and must be in the smallest unit of the From currency
  //  * @param {string} from from currency
  //  * @param {string} to to currency
  //  * @returns {Promise<any | undefined>} The response
  //  */
  // public static function swapCurrencies (amount, from, to) {
  //   try {
  //     const response = $this->request->post('/v1/swaps', {
  //       amount: amount,
  //       from: from,
  //       to: to
  //     })
  //     return response.data
  //   } catch (Exception $e) {
  //     return $e
  //   }
  // }

  /**
   * Fetches a List of transactions
   * @param {'success' | 'failed' | 'pending'} status filter results by the status of the links
   * Can either be success, failed or pending
   * @param {number} page Page to query data from. Defaults to 1
   * @param {number} per_page Number of results per page. Defaults to 10
   * @returns {Promise<any | undefined>} The response
   */
  public static function getAllTransactions($status, $page = 1, $per_page = 10) {
    try {
      $url = `/v1/transactions?page={$page}&per_page={$per_page}`;
      if (status) {
        $url = `/v1/transactions?page={$status}&per_page={$per_page}&status{$status}`;
      }
      return (new self)->setHttpResponse($url, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }

  /**
   * Fetches a single transaction
   * @param {number} reference Unique ID for the transaction eg (TRANS_qgc)
   * @returns {Promise<any | undefined>} The response
   */
  public static function getSingleTransaction($reference) {
    try {
      return (new self)->setHttpResponse(`/v1/transactions/{$reference}`, 'GET')->getResponse();
      
    } catch (Exception $e) {
      return $e;
    }
  }
}