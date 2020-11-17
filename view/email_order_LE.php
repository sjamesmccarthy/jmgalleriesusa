<?php

$date = date("F j, Y", time());
$amount_total = $_POST['amount_total'] / 100;
$balance_due = ($_POST['price'] + $_POST['ship_UPS_value']) - $amount_total;
$title = ucwords(  str_replace("-", " ", $_POST['title']) );
$size = $_POST['size'] . "(image size)";

if($_POST['ship_UPS_value'] == '30') {
    $ship_type = 'Shipping Provider: UPS Ground (Your tracking number will be sent once your art has ben shipped)';
} else {
    $ship_type = 'Shipping Provider: USPS First Class (no tracking)';
} 

if($_POST['deposit'] == 'true') {
    $payment_html = "<br>= = = = =<br >$" .  $balance_due . " Balance Due (Will be invoiced later)<br>";
    $deposit_label = "Deposit";
    $frame_extra_line = "<br><i>An art consultant will contact you regarding your framing options.</i>";
} else {
    $payment_html = null;
    $deposit_label = null;
    $frame_extra_line = null;
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
<b>Order Number: </b> " . $_POST['invoice_no'] . "<br />
<b>Ordered On: </b> " . $date . 
"<br><br><hr><br><br>

<h2 class='pb-16'>Art to be Shipped</h2>
<ul>
<li>
<ul class='ml-32'><li>"
. $title . "<br>"
. $size . "<br>"
. $_POST['framing'] 
. $frame_extra_line .
"</li></ul></li>

<li>
<h3 class='pb-16 pt-32'>Shipping Address:</h3><ul class='ml-32'><li>"
. $_POST['contactname'] . "<br>"
. $_POST['address'] . "<br>"
. $_POST['address_other'] . "<br>"
. $_POST['city'] . "," . $_POST['state'] . " " . $_POST['postalcode'] .
"<br><br>
<b>Shipment Notifcation:</b><br>"
. $_POST['contactname'] . "<br>"
. $_POST['contactemail'] . "<br>"
. $ship_type .
"</li></ul></li>
</ul>

<h2 class='pb-16 pt-32'>Billing and Payment Information</h2>
<ul>
<li>
<ul class='ml-32'><li>
<p>$"
. $amount_total. " " . $deposit_label . " charged via Sqaure." 
. $payment_html . "
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

?>