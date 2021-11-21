<?php

// $this->console($_POST);

$date = date("F j, Y", time());
$amount_total = number_format( ($_POST['amount_total'] / 100), 2);
$balance_due = ($_POST['price'] + $_POST['ship_UPS_value']) - $amount_total;
$title = ucwords(  str_replace("-", " ", $_POST['title']) );


// if($_POST['ship_UPS_value'] == '30') {
//     $ship_type = 'Shipping Provider: UPS Ground (Your tracking number will be sent once your art has ben shipped)';
// } else {
//     $ship_type = 'Shipping Provider: USPS First Class (no tracking)';
// } 

if($_POST['deposit'] == 'true') {
    $payment_html = "<br>= = = = =<br >$" .  $balance_due . " Balance Due (Will be invoiced later)<br>";
    $deposit_label = "Deposit";
    $frame_extra_line = "<br><i>An art consultant will contact you regarding your framing options.</i>";
} else {
    $payment_html = null;
    $deposit_label = null;
    $frame_extra_line = null;
}

if($_POST['promocode'] != '') {
    $insert_promo = "<p>promo-code: " . strtoupper($_POST['promocode']) . ' applied for $' . $_POST['promo_amt'] . "</p>";
} else {
    $insert_promo = null;
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
<img src='https://jmgalleries.com/view/image/logo_fullsize.png' style='width: 8%' alt='jm galleries logo' />
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
<ul class='ml-32'><li>(" . $_POST['quantity'] . ") "
. $title .
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
. $_POST['shipping_provider'] . " +$" . $_POST['ship'] . " " .
"</li></ul></li>
</ul>

<h2 class='pb-16 pt-32'>Billing and Payment Information</h2>
<ul>
<li>
<ul class='ml-32'><li>
<p>$"
. $amount_total. " " . $deposit_label . " pending via Square on credit card *******" . $_POST['last_4'] . "<!-- <br />--NOTE: We will contact you later for this information -->"
. $payment_html . "
</p>
<div class='pb-16 pt-16 pr-16 mt-8 notice-WARNING'><p style='line-height: 1.3'>NOTICE: Our payment processing is currently under going maintenance so an art consultant will be in contact with you regarding payment. We apologize for the inconvenience.</p></div>"
. $insert_promo . "
<br><br>
</li></ul></li>
</ul>

<hr>
<h3 class='pb-16'>Questions:</h3>
<p>If you have any questions about your order, pelase reply to this message or call 951-708-1831.</p>

<p class='pt-16'>---<br>
jM Galleries<br>
1894 E William St<br>
Suite 4-178<br>
Carson City, NV 89701<br>
951-708-1831<br>
orders@jmgalleries.com</p>
";

$tmpl_jmg = "Online order received for " . $_POST[contactname] . " from " . $_POST['city'] . ", " . $_POST[state] . " for $" . $amount_total . " purchasing " . $_POST['title'] . ".";

?>