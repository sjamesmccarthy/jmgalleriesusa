<?php

if(isSet($this->data->routePathQuery[0])) {
    $photo_split = explode("=", $this->data->routePathQuery[0]);
    $photo = $photo_split[1];
    $formTitle = "CHECKOUT for <b>" . $photo . "</b>";
    $subTitle = "Thank you for your interest in collecting a j.McCarthy Limited Edition";
    $subject_PH = "PURCHASE ORDER for  " . strtoupper($photo);
    $message_PH = "IN THE BOX BELOW PLEASE TELL US THE FOLLOWING: <ul class='contact-ul mb-16'><li>Shipping Address (Provide Postal Code) or Pickup (Las Vegas, Nevada)</li><li>Phone Number, An art consultant will contact you within 24 hours to complete this order</li><li>Preferred Billing Method: Credit Card, Cash or BitCoin</li><li>And, any other questions you may have.</li></ul>";
    $button_label = "PLACE YOUR ORDER";
    $promo_field = '<p class="pt-16 pb-16"><input type="text" id="contactpromocode" name="contactpromocode" placeholder="PROMO CODE" value="" /></p>';
    $payment_field = "<p class='pt-16 pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /><br />Visa, Mastercard, American Express and Discover are accepted and processed with Square.<br />Bitcoin is also accepted on request.</p>";
    $subject_VAL = $subject_PH;
    $formType = "RequestQuoteForm"; 
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