<?php

/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   12-23-2018 12:49:35
 * @Email:  james@jmgalleries.com
 * @Filename: ajax_amazing-offer.php
 * @Last modified by:   sjamesmccarthy
 * @Last modified time: 12-23-2018 12:49:35
 * @Copyright: 2018
 */

/* get common site data */
include_once('config.php');
$orderNumber = time();

$to = CONTACT_EMAIL;
$subject = 'AMAZING_ORDER: US-' . $orderNumber;

$message = '{' . "\n";

foreach ($_POST as $key => $value) {

    if ($key != "g-recaptcha-response") {
        $message .= "\t" . '"' . $key . '" : "' . $value . '",';
    }
}

// Added to json HTTP_USER_AGENT, 'REMOTE_ADDR
$message .= "\t" . '"REMOTE_ADDR" : "' . $_SERVER['REMOTE_ADDR'] . '",';
$message .= "\t" . '"REMOTE_AGENT" : "' . $_SERVER['HTTP_USER_AGENT'] . '",';

$message = rtrim($message, ',');
$message .= "\n}";
$message = str_replace(",", ",\n", $message);

$headers = 'From: jmGalleries <' . CONTACT_EMAIL . ">\r\n" .
    'Reply-To: jmGalleries <' . CONTACT_EMAIL . ">\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

// Now Send Confirmation to Person
$to = $_POST['contactinfoEmail'];
$subject = "Your jmGalleies Order US-" . $orderNumber;

$message = 'Thank you for your Pre-Order Request #' . $orderNumber . '. An art consultant will be in contact with you at either, ' . $_POST['contactinfoEmail'] . ', or by telephone at, ' . $_POST['contactinfoPhone'] . ' within 48 hours to setup payment and shipping of your new artwork, ' . $_POST['amazingOfferTitle'] . ' (1) 17 x 25 Framed, Limited-Edition, Fine-Art Print.' . "\r\n\r\n" . "Thank you for your support!\r\nJames, jmGalleries, https://jmgalleries.com\r\n951-708-1831 PST";

$headers = 'From: jmGalleries <' . CONTACT_EMAIL . ">\r\n" .
    'Reply-To: ' . CONTACT_EMAIL . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);


/* Ajax response */
print '<h1 class="amazing-offer-title" style="margin-top: 0; font-size: 2.0rem; padding: 0 20px 20px 20px">Thank you for your Pre-Order Request #' . $orderNumber . '</h1><p style="text-align: left;">An art consultant will be in contact with you at either, ' . $_POST['contactinfoEmail'] . ', or by telephone at, ' . $_POST['contactinfoPhone'] . ' within 48 hours to setup payment and shipping of your new artwork, ' . $_POST['amazingOfferTitle'] . ' (1) 17 x 25 Framed, Limited-Edition, Fine-Art Print. <b>If you do do not receive the confirmation email please check your Spam/Junk folder or call ' . PHONE . '.';

exit;

?>