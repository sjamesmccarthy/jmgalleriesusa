<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   04-12-2017 7:34:05
 * @Email:  james@jmcjmgalleries.com
 * @Filename: ajax_email_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 05-22-2017 6:21:02
 * @Last modified time: 2023-03-15 07:54:43
 * @Copyright: 2017, 2019
 */

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

echo "ajax_email_process(start--" . $core->env . ")" . __LINE__ . "\n";

 /* CONSTANTS */
define('EMAIL_TO_NAME', 'James McC');
define('EMAIL_TO_ADDRESS', '<james@jmgalleries.com>');
define('TIMESTAMP', time());

if($_POST){

	// Build POST request:
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_secret = '6LetD7YUAAAAAK67D8shXLSdWE3pEAynrjd5FOlT';
	$recaptcha_response = $_POST['g-recaptcha-response'];

	// Make and decode POST request:
	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
	$recaptcha = json_decode($recaptcha);

    echo "ajax_email_process(build-post-request)" . __LINE__ . "\n";
} else {
    echo "ajax_email_process(fail-recaptcha--build-post-request)" . __LINE__ . "\n";
}

/* Test reCaptcha if not robot score then create mail submissions */
if ($recaptcha->score >= 0.5 || $core->env == "local") {

    echo "ajax_email_process(recaptcha-pass)" . __LINE__ . "\n";

    $mg_meta .= "\n\n" . 'REMOTE_AGENT: ' . $_SERVER['HTTP_USER_AGENT'];

	/* Remove reCaptcha info from form POST results */
	unset($_POST['g-recaptcha-response']);

	/* Switch based of what form is being used */
	switch($_POST['formType']) {

		case "AmazingOfferForm":
            /* deprecated */
			// $to = EMAIL_TO;
			// $subject = 'AMAZING_ORDER: US-' . TIMESTAMP;
			// $header_from = "FROM: " . $_POST['contactfirstname'] . " <'" . $_POST['contactemail'] . "'>";
			// $reply_to = $_POST['contactemail'];
			// $sendReply = '1';
			// $send_reply_subject = "Your jM Galleies Order US-" . TIMESTAMP;
			// $send_reply_message = 'Thank you for your Pre-Order Request #' . TIMESTAMP . '. An art consultant will be in contact with you at, ' . $_POST['contactemail'] . ' within 48 hours to setup payment and shipping of your new artwork, ' . $_POST['amazingOfferTitle'] . ' (1) 13x19, Limited-Edition, Fine-Art Print.' . "\r\n\r\n" . "Thank you for your support!\r\nJames, jmGalleries, https://jmgalleriesusa.com\r\n951-708-1831 PST";
			break;

		case "ContactForm":

            $to = EMAIL_TO_NAME . EMAIL_TO_ADDRESS;
            echo "ajax_email_build(to: " . $to . ")" . __LINE__ . "\n";

            if(!$_POST['contactsubject']) {
                $subject = 'webform[jmGalleries] - no subject provided';
            } else {
                $subject = $_POST['contactsubject'];
            }

            $message = json_encode($_POST);
            $headers = array(
                'From' => $_POST['contactname'] . '<' . $_POST['contactemail'] . '>',
                'Reply-To' => $_POST['contactemail'],
                'X-Mailer' => 'PHP/' . phpversion()
            );

            echo "ajax_email_build(from: " . $headers['From'] . ")" . __LINE__ . "\n";
            echo "ajax_email_build(replyTo: " . $headers['Reply-To'] . ")" . __LINE__ . "\n";

			$sendReply = '0';

            echo "ajax_email_build(ContactForm).complete" . __LINE__ . "\n";
			break;

		case "RequestQuoteForm":
            /* No longer Used at This time Wed, 15 March 2023 */
            // echo "ajax_email_process(RequestQuoteForm)" . __LINE__ . "\n";
			// $to = EMAIL_TO;
			// $subject = 'webform/' . $_POST['contactsubject'];
			// $header_from = "FROM: " . $_POST['contactname'] . " <'" . $_POST['contactemail'] . "'>";
			// $reply_to = $_POST['contactemail'];
			// $sendReply = '1';
			// $send_reply_subject = 'YOUR ORDER CONFIRMATION NUMBER: ' . $_POST['invoice_no'];
			// $send_reply_message = 'Thank you for your order. An art consultant will be in contact with you at, ' . $_POST['contactemail'] . ' within 48 hours to complete your order. This will include providing you with a final invoice through our payment center, Square.' . "\r\n\r\n" . "Thank you for your support!\r\nJames, jmGalleries, https://jmgalleriesusa.com\r\n951-708-1831 PST";
			// if(isSet($_POST['promocode'])) { $_POST['promocode'] = strtoupper($_POST['promocode']); }
            // $result = $core->api_Insert_Order();
            // echo "ajax_email_process(sql-return)\n\n";
            // echo $core->printp_r($result) . "\n\n";
            break;

		case "SubscribeForm":
            /* deprecated */
			// $to = EMAIL_TO;
			// $subject = 'webform/SUBSCRIBE';
			// $header_from = "FROM: " . $_POST['contactfirstname'] . " " . $_POST['contactlastname']. " <'" . $_POST['subcontactemail'] . "'>";
			// $reply_to = $_POST['subcontactemail'];
			// $sendReply = '0';
			// $send_reply_subject = null;
			// $send_reply_message = null;
            break;

		case "referrCollectorForm":

            $to = EMAIL_TO_NAME . EMAIL_TO_ADDRESS;
            echo "ajax_email_build(to: " . $to . ")" . __LINE__ . "\n";

            if(!$_POST['subject']) {
                $subject = 'webform[jmGalleries] - no subject provided';
            } else {
                $subject = $_POST['referred_by'];
            }

            $message = "Hello, " . $_POST['ref_name'] . "\n\n" . "Your friend, " . $_POST['referred_by'] . ", thought that you might be interested in looking at some fine-art photography by Fine Art Photographer, j.McCarthy.\n\n" . "You can check out his online catalog at, https://jmgalleries.com, and if you find a photo that you think would look great on your home or office wall then use this promo-code: " . $_POST['promo_code'] . " when ordering, for a 15% OFF friends & family discount. \n\n" . "Cheers,\r\n" . $_POST['referred_by'];

            $headers = array(
                'From' =>  $_POST['referred_by']. "<" . $_POST['referred_by_email'] . ">",
                'Reply-To' => $_POST['referred_by_email'],
                'X-Mailer' => 'PHP/' . phpversion()
            );

            echo "ajax_email_build(from: " . $headers['From'] . ")" . __LINE__ . "\n";
            echo "ajax_email_build(replyTo: " . $headers['Reply-To'] . ")" . __LINE__ . "\n";

            $sendReply = '0';
            $send_reply_subject = null;
            $send_reply_message = null;

            echo "ajax_email_build(referrCollectorForm).complete" . __LINE__ . "\n";
			break;

		default:

            $to = EMAIL_TO_NAME . EMAIL_TO_ADDRESS;
            echo "ajax_email_build(to: " . $to . ")" . __LINE__ . "\n";

            if(!$_POST['subject']) {
                $subject = 'webform[jmGalleries] - no subject provided';
            } else {
                $subject = $_POST['subject'];
            }

            $message = json_encode($_POST);
            $headers = array(
                'From' => $_POST['contactname'] . '<' . $_POST['contactemail'] . '>',
                'Reply-To' => $_POST['contactemail'],
                'X-Mailer' => 'PHP/' . phpversion()
            );

            echo "ajax_email_build(from: " . $headers['From'] . ")" . __LINE__ . "\n";
            echo "ajax_email_build(replyTo: " . $headers['Reply-To'] . ")" . __LINE__ . "\n";

            $sendReply = '0';

            echo "ajax_email_build(default).complete" . __LINE__ . "\n";
			break;
	}

	if (mail($to, $subject, $message, $headers)) {
        echo "ajax_email_process(sendmail-success)" . __LINE__ . "\n";
    } else {
        echo "ajax_email_process(sendmail-failed)" . __LINE__ . "\n";
    }

    $sendReply = 1;
    $send_reply_subject = "testing reply back";
    $send_reply_message = "testing reply back message";
    $reply_to = EMAIL_TO_NAME . EMAIL_TO_ADDRESS;

	/* If SendReply is TRUE then send a reply to the requestor */
	if($sendReply == '1') {

        $to = $headers['Reply-To'];
        echo "ajax_email_build(to: " . $to . ")" . __LINE__ . "\n";

        $subject = $send_reply_subject;
        $message = $send_reply_message;
        $headers = array(
            'From' => EMAIL_TO_NAME . EMAIL_TO_ADDRESS,
            'Reply-To' => $reply_to,
            'X-Mailer' => 'PHP/' . phpversion()
        );

        echo "ajax_email_build(from: " . $headers['From'] . ")" . __LINE__ . "\n";
        echo "ajax_email_build(replyTo: " . $headers['Reply-To'] . ")" . __LINE__ . "\n";

        $sendReply = '0';
        echo "ajax_email_build(sendReply).complete" . __LINE__ . "\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "ajax_email_process(send-reply-true)" . __LINE__ . "\n";
        } else {
            echo "ajax_email_process(send-reply-failed)" . __LINE__ . "\n";
        }

        echo "ajax_email_build(Reply-To).complete" . __LINE__ . "\n";
	}

    echo "ajax_email_process(" . $_POST['formType'] . "-success)" . __LINE__ . "\n";

} else {
    echo "ajax_email_process(recaptcha--fail)" . __LINE__ . "\n";
}

exit;
