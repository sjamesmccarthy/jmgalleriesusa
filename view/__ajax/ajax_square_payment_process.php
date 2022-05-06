<?php

/* include conf-env file */
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();
// $core->console($core->config_env->env[$core->env]['sq_application_id'],1);

/* First load Square Payments API */
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$ship_USPS = 0;
$ship_UPS = 0;
$ship_UPS_value = null;
$promo_amt = null;

extract($_POST, EXTR_PREFIX_SAME, "dup");

if(!isSet($deposit)) {
    $confirm_amount = ($price + $ship_USPS + $ship_UPS_value) - $promo_amt;
    $sq_amount = $amount_total;
} else {
    // echo "DEPOSIT ONLY TRANSACTION";
}

use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Exceptions\ApiException;
use Square\SquareClient;

// Pulled from the .env file and upper cased e.g. SANDBOX, PRODUCTION.
// $env = 'sandbox';
$env = $core->config_env->env[$core->env]['sq_env']; 

// The access token to use in all Connect API requests.
// Set your environment as *sandbox* if you're just testing things out.   
// $access_token =  'EAAAEK5b7Z0blLhzMRy9cVYYEa5hsXjIaaUhDxn4rt7Rz8X8Kg1LoByecB5aq34L';    
$access_token =  $core->config_env->env[$core->env]['sq_access_token'];    

// Initialize the Square client.
$client = new SquareClient([
  'accessToken' => $access_token,  
  'environment' => $env
]);

// Helps ensure this code has been reached via form submission
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  error_log('Received a non-POST request');
  echo 'Request not allowed';
  http_response_code(405);
  return;
}

// Fail if the card form didn't send a value for `nonce` to the server
$nonce = $_POST['nonce'];
if (is_null($nonce)) {
  echo 'Invalid card data';
  http_response_code(422);
  return;
}

/* Using the PaymentsApi, not the OrdersApi */
/* This will only create a "transaction" */
$payments_api = $client->getPaymentsApi();

// To learn more about splitting payments with additional recipients,
// see the Payments API documentation on our [developer site]
// (https://developer.squareup.com/docs/payments-api/overview).

$money = new Money();
// Monetary amounts are specified in the smallest unit of the applicable currency.
// This amount is in cents for USD
$money->setAmount($amount_total);
$money->setCurrency('USD');

// Every payment you process with the SDK must have a unique idempotency key.
// If you're unsure whether a particular payment succeeded, you can reattempt
// it with the same idempotency key without worrying about double charging
// the buyer.
$create_payment_request = new CreatePaymentRequest($nonce, uniqid(), $money);


// The SDK throws an exception if a Connect endpoint responds with anything besides
// a 200-level HTTP code. This block catches any exceptions that occur from the request.
try {
    
    $response = $payments_api->createPayment($create_payment_request);
    
    // If there was an error with the request we will print them to the browser screen here
    if ($response->isError()) {
        echo 'Api response has Errors';
        $errors = $response->getErrors();
        echo '<ul>';
            foreach ($errors as $error) {
                echo '<li> ' . $error->getDetail() . '</li>';
            }
        echo '</ul>';
        // exit();
    }

    // Get the results of the transaction and print to screen (comment out from production)
    $result = $response->getResult();
    // echo json_encode($result);

    /* process locally */
    /* require a page extension: ajax_sqaure_payment_local.php */
    require_once($_SERVER['DOCUMENT_ROOT'] . '/view/__ajax/ajax_square_payment_local.php');

} catch (ApiException $e) {
    echo 'Caught exception!<br/>';
    echo('<strong>Response body:</strong><br/>');
    echo '<pre>'; var_dump($e->getResponseBody()); echo '</pre>';
    echo '<br/><strong>Context:</strong><br/>';
    echo '<pre>'; var_dump($e->getContext()); echo '</pre>';
    // exit();
}

