<?php

// Note this line needs to change if you don't use Composer:
// require('square-php-sdk/autoload.php');
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

echo "<pre>"; print_r($_POST); echo "</pre>";

// use Dotenv\Dotenv;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;
use Square\Exceptions\ApiException;
use Square\SquareClient;

// dotenv is used to read from the '.env' file created for credentials
// $dotenv = Dotenv::create(__DIR__);
// $dotenv->load();

// Pulled from the .env file and upper cased e.g. SANDBOX, PRODUCTION.
// $upper_case_environment = strtoupper(getenv('ENVIRONMENT'));
$env = 'sandbox';

// The access token to use in all Connect API requests.
// Set your environment as *sandbox* if you're just testing things out.
// $access_token =  getenv($upper_case_environment.'_ACCESS_TOKEN');    
$access_token =  'EAAAEK5b7Z0blLhzMRy9cVYYEa5hsXjIaaUhDxn4rt7Rz8X8Kg1LoByecB5aq34L';    
$location_id = 'L8NHKFJA0P2JE';

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

// $payments_api = $client->getPaymentsApi();

// To learn more about splitting payments with additional recipients,
// see the Payments API documentation on our [developer site]
// (https://developer.squareup.com/docs/payments-api/overview).

$money = new \Square\Models\Money();
// Monetary amounts are specified in the smallest unit of the applicable currency.
// This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
$money->setAmount(100);
$money->setCurrency('USD');

$order_line_item = new \Square\Models\OrderLineItem('1');
$order_line_item->setName('Small Coffee');
$order_line_item->setBasePriceMoney($money);

$line_items = [$order_line_item];
$order = new \Square\Models\Order($location_id);
// $order->setCustomerId('1');
$order->setLineItems($line_items);

// Every payment you process with the SDK must have a unique idempotency key.
// If you're unsure whether a particular payment succeeded, you can reattempt
// it with the same idempotency key without worrying about double charging
// the buyer.
// $create_payment_request = new CreatePaymentRequest($nonce, uniqid(), $money);

$body = new \Square\Models\CreateOrderRequest();
$body->setOrder($order);
$body->setLocationId('L8NHKFJA0P2JE');

// The SDK throws an exception if a Connect endpoint responds with anything besides
// a 200-level HTTP code. This block catches any exceptions that occur from the request.
try {
    
    // $response = $payments_api->createPayment($create_payment_request);

    $api_response = $client->getOrdersApi()->createOrder($body);

    if ($api_response->isSuccess()) {
        $result = $api_response->getResult();
    } else {
        $errors = $api_response->getErrors();
    }

    // $result = $api_response->getResult();
    echo "<pre>"; echo json_encode($result); echo "</pre>";

} catch (ApiException $e) {
    echo 'Caught exception!<br/>';
    echo('<strong>Response body:</strong><br/>');
    echo '<pre>'; var_dump($e->getResponseBody()); echo '</pre>';
    echo '<br/><strong>Context:</strong><br/>';
    echo '<pre>'; var_dump($e->getContext()); echo '</pre>';
    exit();
}