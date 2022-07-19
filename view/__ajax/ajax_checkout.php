<?php
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

$core->console($_POST);

/* ********* */
/* Now lets save some data to the local database for our internal use
4111 1111 1111 1111
*/

	switch($_POST['formType']) {

		case "SquarePaymentForm_productOrder":
			$to = null;
			$from = null;
			$reply_to = null;
			$subject = null;
			$_POST['order_no'] = time() . 'P' . $_POST['product_id'];
			$layout = 'email_order_PO.php';
		break;

		case "SquarePaymentForm_fineArt":
			$to = null;
			$from = null;
			$reply_to = null;
			$subject = null;
			$_POST['order_no'] = time() . 'FA' . $_POST['catalog_id'];
			$layout = 'email_order_FA.php';
		break;

		default:
			$_SESSION['order_data'] = $_POST;
			$_SESSION['layout'] = $layout;
			header('location:/order-problem');
		break;

	}

$sq_result_json = json_encode($result);
$sq_result_api = json_decode($sq_result_json);

// $core->console($sq_result_api);

$result = $core->api_Insert_Order($sq_result_api);

// $_POST['last_4'] = $sq_result_api->payment->card_details->card->last_4;
$_POST['last_4'] = '0000';
$result['result'] = '200';

if($result['result'] == "200") {

	/* MESSAGE TO CUSTOMER */
		$name = explode(" ", $_POST['contactname']);

		/* Send confirmation email to customer */
		$to  = $_POST['contactname'] . '<' . $_POST['contactemail'] . '>';
		$subject = "Hello, we're processing your order " . $_POST['order_no'];

		// message
		// echo $_SERVER["DOCUMENT_ROOT"] . '/view/' . $layout . '<br />';
		require_once($_SERVER["DOCUMENT_ROOT"] . '/view/checkout/' . $layout);
		$message = $tmpl;

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		// Additional headers
		$headers .= 'FROM: jM Galleries Store <james@jmgalleries.com>' . "\r\n";
		$headers .= 'Reply-To: jmG Galleries <james@jmgalleries.com>' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

		mail($to, $subject, $message, $headers);

	/* MESSAGE TO JM-GALLERIES */
		$to  = 'jMcCarthy Fine Art <collectart@jmgalleries.com>';
		$subject = "online order " . $_POST['order_no'] . ' for ' . $_POST['title'];

		// message
		$message = $tmpl_jmg;

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		// Additional headers
		$headers .= 'FROM: jM Galleries Order Bot <james@jmgalleries.com>' . "\r\n";
		// $headers .= 'Reply-To: jmG Galleries <james@jmgalleries.com>' . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

		mail($to, $subject, $message, $headers);
        // echo "MESSAGE-SENT:<hr>" . $to . "<br />" . $subject . "<br />" . $message . "<br />" . $headers;

	// redirect to success page
	$_SESSION['order_data'] = $_POST;
	$_SESSION['layout'] = $layout;
	header('location:/checkout-thankyou');

} else {

	// redirect to problem found page
	$_SESSION['order_data'] = $_POST;
	$_SESSION['layout'] = $layout;
	header('location:/checkout-problem');

}
