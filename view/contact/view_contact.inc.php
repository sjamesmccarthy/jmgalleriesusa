<?php

if(isSet($this->routes->URI->queryvals)) {

    switch($this->routes->URI->queryvals[0]) {

        case "call":
            header('location:tel:+19512625142');
            break;

        case "vcf-jmg":
            break;

        case "vcf-ts":
            break;

        default:
            break;
    }

}


    // Just a regular contact form
    // $formTitle = $this->page->title;
    $action_uri = "/view/__ajax/ajax_email_process.php";
    $action_id = "contactForm";
    $formTitle = "I'd Love To Hear From You";
    $subject_PH = "IN A FEW WORDS, WHAT IS THIS MESSAGE ABOUT";
    $message_PH = "Write Your Message Here ....";
    $button_label = "SEND MESSAGE";
    $formType = "ContactForm";
    $subNotice = null;

?>
