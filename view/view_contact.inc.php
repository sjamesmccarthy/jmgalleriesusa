<?php

if(isSet($this->data->routePathQuery[0])) {
    $photo_split = explode("=", $this->data->routePathQuery[0]);
    $photo = $photo_split[1];
    $photo = urldecode($photo);
    
    $promo_split = explode("=", $this->data->routePathQuery[1]);
    $promo_code = $promo_split[1];

    $email_split = explode("=", $this->data->routePathQuery[2]);
    $email = $email_split[1];
    $email = urldecode($email);

    $name_split = explode("=", $this->data->routePathQuery[3]);
    $name = $name_split[1];
    $name = urldecode($name);

    $message_split = explode("=", $this->data->routePathQuery[4]);
    $msg = $message_split[1];
    $msg = urldecode($msg);

    $formTitle = "CHECKOUT for <b>" . $photo . "</b>";
    $subTitle = "Thank you for your interest in collecting a j.McCarthy Limited Edition";
    $subject_PH = "PURCHASE ORDER for " . strtoupper($photo);
    $message_PH = "IN THE BOX BELOW PLEASE TELL US THE FOLLOWING: <ul class='contact-ul mb-16'><li>Shipping Address (Provide Postal Code) or Pickup (Las Vegas, Nevada)</li><li>Phone Number, An art consultant will contact you within 24 hours to complete this order</li><li>Preferred Billing Method: Credit Card, Cash or BitCoin</li><li>And, any other questions you may have.</li></ul>";
    $button_label = "PLACE YOUR ORDER";
    $promo_field = '<p class="pt-16 pb-16"><input type="text" id="contactpromocode" name="contactpromocode" placeholder="PROMO CODE" value="' . $promo_code . '" /></p>';
    $payment_field = "<p class='pt-16 pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /><br />Visa, Mastercard, American Express and Discover are accepted and processed with Square.<br />Bitcoin is also accepted on request.</p>";
    $subject_VAL = $subject_PH;
    $formType = "RequestQuoteForm"; 

    if($_REQUEST['open']) {
        $formSizes = "<div class='select-wrapper'><label for='buysize'></label><select name='buysize'><option value='---'>SELECT YOUR tinyViews&trade; EDITION SIZE</option><option vlaue='4x6'>4x6 ($20)</option><option vlaue='8x8'>8x8 ($40)</option><option vlaue='8x10'>8x10 ($80)</option></select></div>";
        $promo_field = null;
        $subject_VAL = $subject_PH . " tinyViews&trade; Edition";
    } else {
        $formSizes = "<div class='select-wrapper'><label for='buysize'></label><select name='buysize'><option value='---'>SELECT YOUR LIMITED EDITION SIZE</option><option vlaue='16x24'>16x24 ($1000)</option><option vlaue='20x30'>20x30 ($1875)</option><option vlaue='24x36'>2x36 ($2700)</option><option vlaue='30x45'>30x45 (CALL)</option><option vlaue='40x60'>40x60 (CALL)</option></select></div>";
    }

} else {
    $formTitle = $this->title;
    $subTitle = null;
    $subject_PH = "PHOTOGRAPH TITLE OR SUBJECT";
    $message_PH = "TYPE YOUR MESSAGE BELOW";
    $button_label = "SEND MESSAGE";
    $promo_field = null;
    $payment_field = null;
    $subject_VAL = null;
    $formType = "ContactForm";
}
    
?>