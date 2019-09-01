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

if($_POST){
	function getCaptcha($SecretKey) {
		$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh&response={$SecretKey}");
		$Return = json_decode($Response);
		return($Return);
	}
	$Return = getCaptcha($_POST['g-recaptcha-response']);
	var_dump($Return);
} 

$orderNumber = time();
$to = 'james@jmgalleries.com';
$subject = 'AMAZING_ORDER: US-' . $orderNumber;

unset($_POST['g-recaptcha-response']);
$message = json_encode($_POST);
$message .= "\n\n" .  '"REMOTE_AGENT" : "' . $_SERVER['HTTP_USER_AGENT'] .'",';

 $headers = 'From: ' . $_POST['contactinfoemail'] . "\r\n" .
            'Reply-To: ' . $_POST['contactinfoemail'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . '/jmGForm';

mail($to, $subject, $message, $headers);
// print 'Success.jmGalleries.Sent';

// Now Send Confirmation to Person
$to = $_POST['contactinfoemail'];
$subject = "Your jM Galleies Order US-" . $orderNumber;

$message = 'Thank you for your Pre-Order Request #' . $orderNumber . '. An art consultant will be in contact with you at, ' . $_POST['contactinfoemail'] . ' within 48 hours to setup payment and shipping of your new artwork, ' . $_POST['amazingOfferTitle'] . ' (1) 13x19, Limited-Edition, Fine-Art Print.' . "\r\n\r\n" . "Thank you for your support!\r\nJames, jmGalleries, https://jmgalleriesusa.com\r\n951-708-1831 PST";

$headers = 'From: jM Galleries <' . $to . ">\r\n" .
    'Reply-To: ' . $to . "\r\n" .
    'X-Mailer: PHP/' . phpversion() . '/jmGForm';

mail($to, $subject, $message, $headers);
print 'Success.Customer.Sent / Success.jmGalleries.Sent';

exit;

?>


?>