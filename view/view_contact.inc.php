<?php

if(isSet($this->data->routePathQuery[0])) {
    $photo_split = explode("=", $this->data->routePathQuery[0]);
    $photo = $photo_split[1];
    $formTitle = "CHECKOUT";
    $subTitle = "Thank you for your interest in collecting a jM Fine-Art Limited Edition <b>" . $photo . "</b>";
    $subject_PH = "PURCHASING " . strtoupper($photo);
    $message_PH = "PLEASE TELL US A LITTLE BIT MORE ABOUT WHAT YOU ARE LOOKING FOR BELOW. <ul class='contact-ul'><li><a href='/styles'>Mounted Wall Art or Acrylic</a></li><li>What size: 16x24, 20x30, 24x36, etc.</li><li>Will you need a open-air, hand-made wood frame? Read about our <a href='/styles'>frames and styles.</a></li></ul>";
    $button_label = "PLACE YOUR ORDER";
    $payment_field = "<p class='pt-16 pb-16'>PAYMENT <img style='width: 100px; vertical-align: middle' src='/view/image/square-payment-icons.png' /><br />Visa, Mastercard, American Express and Discover are accepted and processed with Square.</p>";
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