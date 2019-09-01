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

$to = 'james@jmgalleries.com';
$subject = 'webform/jmG - ' . $_POST['contactsubject'];

unset($_POST['g-recaptcha-response']);
$message = json_encode($_POST);
$message .= "\n\n" .  '"REMOTE_AGENT" : "' . $_SERVER['HTTP_USER_AGENT'] .'",';

 $headers = 'From: ' . $_POST['contactemail'] . "\r\n" .
            'Reply-To: ' . $_POST['contactemail'] . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . '/jmGForm';

mail($to, $subject, $message, $headers);

print 'Thank you!<br /><a style="font-size:.7em; text-decoration: none;" href="/">jMcCarthyGalleries.Com</a>';

exit;

?>
