<?php

// $this->console($_POST);
    
$date = date("F j, Y", time());
$amount_total = number_format( ($_POST['amount_total'] / 100), 2);
$balance_due = ($_POST['price'] + $_POST['ship_UPS_value']) - $amount_total;

switch($_POST['edition_type']) {

    case "product":
        $edition = null;
    break;

    case "limited":
        $edition = ' Limited Edition';
    break;

    case "open":
        $edition = ' Open Edition';
    break;
}

$title = ucwords(  str_replace("-", " ", $_POST['title']) );
$size = $_POST['size'];

/* Shipping
    [shipping_cost] => 30
    [shipping_provider] => ship_ups
    [shipping_cost] => 0
    [shipping_provider] => ship_usps
*/

// if($_POST['ship_UPS_value'] == '30') {
//     $ship_type = 'Shipping Provider: UPS Ground (Your tracking number will be sent once your art has ben shipped)';
// } else {
//     $ship_type = 'Shipping Provider: USPS First Class (no tracking)';
// } 

if($_POST['deposit'] == 'true') {
    $payment_html = "<br>= = = = =<br >$" .  number_format($balance_due,2) . " Balance Due (Will be invoiced later)<br>";
    $deposit_label = "Deposit";

    if($_POST['frame'] == "ADDWITHACRYLIC") {
        $frame_extra_line = "+ Optional* Premium Designer Frame<br><br><i>*An art consultant will be contacting you in regards to your request for an optional Premium Designer frame. Once your framing needs are determined an additional bill for the extra framing will be created and emailed to you.</i>";
    } else if($_POST['frame'] == "FRAMELESS") {
        // $_POST['frame'] = null;
    } else {
        $frame_extra_line = $_POST['frame'] . " Premium Frame";
    }
} else {
    $payment_html = null;
    $deposit_label = 'no deposit - open edition';
    $frame_extra_line = null;
}

if($_POST['edition_type'] == 'open' && $_POST['frame'] != "PRINT-ONLY-WITH-MATTE") {
    $frame_extra_line = "Framed in " . $_POST['frame'];
}

if($_POST['promocode'] != '') {
    $insert_promo = "<p>promo-code: " . strtoupper($_POST['promocode']) . ' applied for -$' . $_POST['promo_amt'] . "</p>";
} else {
    $insert_promo = null;
}

if(isSet($_POST['matted_size'])) {
    $matted_size = " (matted to " . $_POST['matted_size'] . ")";
}

if($_POST['address_other'] != '') {
    $address_other = $_POST['address_other'] . "<br>";
} else {
    $address_other = null;
}

$tmpl = "
<style>

ul li {
    list-style: none;
}

</style>

<span class='noshow'>
<br>
<p style='text-align: left;'>
<img src='https://jmgalleries.com/view/image/logo_fullsize.png' style='width: 8%' />
</p>
</span>

<h1>Thank you for your order.</h1>

<br>
<b>Order Number: </b> " . $_POST['order_no'] . "<br />
<b>Ordered On: </b> " . $date . 
"<br><br><hr><br><br>

<h2 class='pb-16'>Order to be Shipped</h2>
<ul>
<li>
<ul class='ml-32'><li>"
. $title . "<br>"
. $size .  $matted_size . ' ' . $_POST['image_type'] . "<br>"
. $edition . "<br>"
. $frame_extra_line 
. $_POST['frame_forgot'] .
"</li></ul></li>

<li>
<h3 class='pb-16 pt-32'>Shipping Address:</h3><ul class='ml-32'><li>"
. $_POST['contactname'] . "<br>"
. $_POST['address'] . "<br>"
. $address_other 
. $_POST['city'] . "," . $_POST['state'] . " " . $_POST['postalcode'] .
"<br><br>
<b>Shipment Notifcation:</b><br>"
. $_POST['contactname'] . "<br>"
. $_POST['contactemail'] . "<br>"
. $_POST['shipping_provider'] .
"</li></ul></li>
</ul>

<h2 class='pb-16 pt-32'>Billing and Payment Information</h2>
<ul>
<li>
<ul class='ml-32'><li>
<p>$"
. $amount_total. " " . $deposit_label . " charged via Square on card *******" . $_POST['last_4']
. $payment_html . "
</p>" . $insert_promo . "
</p>
<br><br>
</li></ul></li>
</ul>

<hr>
<h3 class='pb-16'>Questions:</h3>
<p>If you have any questions about your order, pelase reply to this message or call 951-708-1831.</p>

<p>COVID-19 Note: Your delivery date reflects no-contact safeguards put in place to protect employees, delivery partners, and customers. We appreciate your patience. We appologize for an delays this may create.</p>

<p class='pt-16'>---<br>
jM Galleries<br>
1894 E William St<br>
Suite 4-178<br>
Carson City, NV 89701<br>
951-708-1831<br>
orders@jmgalleries.com</p>
";

$tmpl_jmg = "Online order received for " . $_POST[contactname] . " from " . $_POST['city'] . ", " . $_POST[state] . " for $" . $amount_total . " (". $deposit_label . ") " . "purchasing " . $title . ".";

?>