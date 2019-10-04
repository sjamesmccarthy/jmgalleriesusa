<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   04-12-2017 7:34:05
 * @Email:  james@jmcjmgalleries.com
 * @Filename: ajax_email_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 05-22-2017 6:21:02
 * @Last modified time: 09-01-2019 08:07:45
 * @Copyright: 2017, 2019
 */

 /* CONSTANTS */
define('EMAIL_TO', 'james@jmgalleries.com');
define('TIMESTAMP', time());

if($_POST){

		// Build POST request:
		$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
		$recaptcha_secret = '6LetD7YUAAAAAK67D8shXLSdWE3pEAynrjd5FOlT';
		$recaptcha_response = $_POST['g-recaptcha-response'];
	
		// Make and decode POST request:
		$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
		$recaptcha = json_decode($recaptcha);

} 

/* Test reCaptcha if not robot score then create mail submissions */
if ($recaptcha->score >= 0.5) {

	/* Remove reCaptcha info from form POST results */
	unset($_POST['g-recaptcha-response']);
	
	/* Encode the Form POST into a JSON array */
	$message = json_encode($_POST);
	print_r($message);

	/* Switch based of what form is being used */
	switch($_POST['formType']) {
		
		case "AmazingOfferForm":
			$to = EMAIL_TO;
			$subject = 'AMAZING_ORDER: US-' . TIMESTAMP;
			$header_from = "FROM: " . $_POST['contactfirstname'] . " <'" . $_POST['contactemail'] . "'>";
			$reply_to = $_POST['contactemail'];
			$sendReply = '1';
			$send_reply_subject = "Your jM Galleies Order US-" . TIMESTAMP;
			$send_reply_message = 'Thank you for your Pre-Order Request #' . TIMESTAMP . '. An art consultant will be in contact with you at, ' . $_POST['contactemail'] . ' within 48 hours to setup payment and shipping of your new artwork, ' . $_POST['amazingOfferTitle'] . ' (1) 13x19, Limited-Edition, Fine-Art Print.' . "\r\n\r\n" . "Thank you for your support!\r\nJames, jmGalleries, https://jmgalleriesusa.com\r\n951-708-1831 PST";
			break;

		case "ContactForm":
			$to = EMAIL_TO;
			$subject = 'webform/jmG - ' . $_POST['contactsubject'];
			$header_from = "FROM: " . $_POST['contactname'] . " <'" . $_POST['contactemail'] . "'>";
			$reply_to = $_POST['contactemail'];
			$sendReply = '0';
			break;

		case "RequestQuoteForm":
			$to = EMAIL_TO;
			$subject = 'webform/' . $_POST['contactsubject'];
			$header_from = "FROM: " . $_POST['contactname'] . " <'" . $_POST['contactemail'] . "'>";
			$reply_to = $_POST['contactemail'];
			$sendReply = '1';
			$send_reply_subject = 'YOUR QUOTE REQUEST';
			$send_reply_message = 'Thank you for your quote request. An art consultant will be in contact with you at, ' . $_POST['contactemail'] . ' within 48 hours to answer any of your questions you have about our limited-edition, fine-art.' . "\r\n\r\n" . "Thank you for your support!\r\nJames, jmGalleries, https://jmgalleriesusa.com\r\n951-708-1831 PST";
			break;

		case "SubscribeForm":
			$to = EMAIL_TO;
			$subject = 'webform/SUBSCRIBE';
			$header_from = "FROM: " . $_POST['contactfirstname'] . " " . $_POST['contactlastname']. " <'" . $_POST['subcontactemail'] . "'>";
			$reply_to = $_POST['subcontactemail'];
			$sendReply = '0';
			$send_reply_subject = null;
			$send_reply_message = null;
			break;

		default:
			$to = EMAIL_TO;
			$subject = 'webform/jmG Default';
			$header_from = "FROM: " . $_POST['contactname'] . " <'" . $_POST['contactemail'] . "'>";
			$reply_to = $_POST['contactemail'];
			$sendReply = '0';
			break;
	}
	
	$message .= "\n\n" . 'REMOTE_AGENT: ' . $_SERVER['HTTP_USER_AGENT'];
	if(isSet($recaptcha)) {
		print_r($recaptcha);
		$message .= "\n\n" . "RECAPTCHA_RESPONSE: " . json_encode($recaptcha);
	}

	$headers =  $header_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n" . 'X-Mailer: PHP/' . phpversion() . '/jmGForm';
	
	print $message; 
	mail($to, $subject, $message, $headers);

	
	/* If SendReply is TRUE then send a reply to the requestor */
	if($sendReply == '1') {
		// Now Send Confirmation to Person Sending The Form
		$to = $_POST['contactemail'];
		$header_from = "FROM: jM Galleries <'" . EMAIL_TO . "'>";
		$reply_to = EMAIL_TO;
		$subject = $send_reply_subject;
		$message = $send_reply_message;

		$headers =  $header_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n" . 'X-Mailer: PHP/' . phpversion() . '/jmGForm';

		print "\nSendReply:" . $sendReply . "\n" . "to: " . $_POST['contactemail'] . "\n" . $message;
		mail($to, $subject, $message, $headers);
	}

	echo $_POST['formType'] . " Success";

} else {
	echo "reCaptcha Fail";
}

exit;

?>
