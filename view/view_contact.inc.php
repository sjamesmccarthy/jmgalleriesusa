<?php

if(isSet($this->data->routePathQuery[0])) {
    $photo_split = explode("=", $this->data->routePathQuery[0]);
    $photo = $photo_split[1];
    $formTitle = "REQUEST A QUOTE";
    $subTitle = "Thank you for your interest in collecting a Limited Edition <b>" . $photo . "</b>";
    $subject_PH = "QUOTE REQUEST for " . strtoupper($photo);
    $message_PH = "PLEASE TELL US A LITTLE BIT MORE ABOUT WHAT YOU ARE LOOKING FOR BELOW. <ul class='contact-ul'><li><a href='/styles'>Mounted Wall Art or Acrylic</a></li><li>What size: 16x24, 20x30, 24x36, etc.</li><li>Will you need a open-air, hand-made wood frame? Read about our <a href='/styles'>frames and styles.</a></li></ul>";
    $button_label = "REQUEST A QUOTE";
    $subject_VAL = $subject_PH;
    $formType = "RequestQuoteForm"; 
} else {
    $formTitle = $this->title;
    $subTitle = null;
    $subject_PH = "PHOTOGRAPH TITLE OR SUBJECT";
    $message_PH = "TYPE YOUR MESSAGE BELOW";
    $button_label = "SEND MESSAGE";
    $subject_VAL = null;
    $formType = "ContactForm";
}
    
?>