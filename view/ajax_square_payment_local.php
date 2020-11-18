<?php 

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

/* ********* */
/* Now lets save some data to the local database for our internal use 
4111 1111 1111 1111
*/


$sq_result_json = json_encode($result);
$sq_result_api = json_decode($sq_result_json);
$result = $core->api_Insert_Order($sq_result_api);

if($result['result'] == "200") {

    $name = explode(" ", $_POST['contactname']);

    /* Send confirmation email to customer */
    $to  = $_POST['contactname'] . '<' . $_POST['contactemail'] . '>';
    $subject = "Hello, we're processing your order ";

    // message
    require_once($_SERVER["DOCUMENT_ROOT"] . '/view/email_order_LE.php');
    $message = $tmpl;

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    // Additional headers
    $headers .= 'FROM: jM Galleries Store <james@jmgalleries.com>' . "\r\n";
    $headers .= 'Reply-To: jmG Galleries <james@jmgalleries.com>' . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

    mail($to, $subject, $message, $headers);

    /* Send confirmation email to jM Galleries */
    $to  = 'jmG Orders <james@jmgalleries.com>' . "\r\n";
    $subject = "online order received" . $_POST['invoice_no'];

    // message
    $message = "Online order received for " . $_POST[contactname] . " from " . $_POST['city'] . ", " . $_POST[state] . " for $" . $_POST['price'] . " purchasing " . $_POST['title'] . ".";

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

    // Additional headers
    $headers .= 'FROM: jM Galleries Order Bot <james@jmalleries.com>' . "\r\n";
    $headers .= 'Reply-To: jmG Galleries <orders@jmgalleries.com>' . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

    mail($to, $subject, $message, $headers);

    // redirect to success page
    $_SESSION['order_data'] = $_POST;
    header('location:/order-confirmation');

} else {

    // redirect to problem found page
    $_SESSION['order_data'] = $_POST;
    header('location:/order-problem');

}
