<?php

if(isSet($this->data->routePathQuery[0])) {
    $photo_split = explode("=", $this->data->routePathQuery[0]);
    $photo = $photo_split[1];
    $formTitle = "CHECKOUT";
    $subTitle = "Thank you for your interest in collecting a jM Fine-Art Limited Edition <b>" . $photo . "</b>";
    $subject_PH = "PURCHASING " . strtoupper($photo);
    $message_PH = "PLEASE TELL US A LITTLE BIT MORE ABOUT YOUR PURCHASE. <ul class='contact-ul mb-16'><li>Edition: Gallery or Studio</li><li>Size: 16x24, 20x30, 24x36, etc.</li><li>Frame: Yes / No</li><li>Ship (Provide Postal Code) or Pickup (Las Vegas, Nevada)</li><li>Phone Number, An art consultant will contact you within 24 hours to complete this order</li></ul>";
    $button_label = "PLACE YOUR ORDER";
    $payment_field = "<p class='pt-16 pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /><br />Visa, Mastercard, American Express and Discover are accepted and processed with Square.<br />Bitcoin is also accepted on request.</p>";
    $subject_VAL = $subject_PH;
    $formType = "RequestQuoteForm"; 
} else {
    $formTitle = $this->title;
    $subTitle = null;
    $subject_PH = "PHOTOGRAPH TITLE OR SUBJECT";
    $message_PH = "TYPE YOUR MESSAGE BELOW";
    $button_label = "SEND MESSAGE";
    $payment_field = null;
    $subject_VAL = null;
    $formType = "ContactForm";
}
    
?>