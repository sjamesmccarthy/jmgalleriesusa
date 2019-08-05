<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   04-12-2017 7:34:05
 * @Email:  james@jmccarthy.xyz
 * @Filename: ajax_process.php
 * @Last modified by:   sjamesmccarthy
 * @Last modified time: 05-22-2017 6:21:02
 * @Copyright: 2017
 */

 /* get common site data */
 include_once('config.php');

 $to = CONTACT_EMAIL;
$subject = 'jMcCarthy Galleries - ' . $_POST['interest'];

 // $message = $_POST['name'] . "\n" . $_POST['contactinfo'] . "\n" . $_POST['interest'] . "\n" . $_POST['comments'];

$message = '{' . "\n";

foreach ($_POST as $key => $value) {

	if($key != "g-recaptcha-response") {
		$message .= "\t" .  '"' . $key . '" : "' . $value .'",';
	}
}

// Added to json HTTP_USER_AGENT, 'REMOTE_ADDR
$message .= "\t" .  '"REMOTE_ADDR" : "' . $_SERVER['REMOTE_ADDR'] .'",';
$message .= "\t" .  '"REMOTE_AGENT" : "' . $_SERVER['HTTP_USER_AGENT'] .'",';

$message = rtrim($message, ',');
$message .= "\n}";
$message = str_replace(",",",\n", $message);

 $headers = 'From: james <james@jmccarthy.xyz>' . "\r\n" .
            'Reply-To: james@blacktea.photo' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

print 'Thank you!<br /><a style="font-size:.7em; text-decoration: none;" href="/">jMcCarthyGalleries.Com</a>';
exit;

?>
