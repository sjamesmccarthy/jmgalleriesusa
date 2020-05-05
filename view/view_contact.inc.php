<?php

if(isSet($this->data->routePathQuery[0])) {

    // https://jmgalleriesusa.com/contact?photo=horizontal-limits&size=SIZE-60CM/16x24&frame=DARK-WALNUT&cost=1000
    // https://jmgalleriesusa/contact?photo=Facade%20To%20The%20Sky&size=60CM&frame=DARK-WALNUT&cost=480&promo_code=COLAMOF-SAVE52&email=matt@matt.com&name=Matthew%20Campbell
    // [1] photo
    // [2] size
    // [3] frame
    // [4] cost
    // [5] promo_code
    // [6] name
    // [7] email
    // [8] edition
    // [9] catalog_no
    
    foreach ($this->data->routePathQuery as $key => $value)
    {
        $query_str = explode("=", $value);
        ${$query_str[0]} = urldecode($query_str[1]);
    }    
   
    $formTitle = "CHECKOUT <span class='lowercase light'>for</span> <span class='light initialcaps'>" . $photo . "</span>";
    $subTitle = "Thank you for your interest in collecting a j.McCarthy Limited Edition";
    $subject_PH = "PURCHASE ORDER for " . strtoupper($photo);
    // . " with a " . $frame . " frame";
    $message_PH = "IN THE BOX BELOW PLEASE TELL US THE FOLLOWING: <ul class='contact-ul mb-16'><li>Shipping Address (Provide Postal Code) or Pickup (Las Vegas, Nevada)</li><li>Phone Number, An art consultant will contact you within 24 hours to complete this order</li><li>Preferred Billing Method: Credit Card, Cash or BitCoin</li><li>And, any other questions you may have.</li></ul>";
    $button_label = "PLACE YOUR ORDER";
    $promo_field = '<p class="pt-16 pb-16"><input type="text" id="contactpromocode" name="contactpromocode" placeholder="PROMO CODE" value="' . $promo_code . '" /></p>';
    $payment_field = "<p class='pt-16 pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /> <i style='font-size: 1.8rem; margin-left: 5px;' class='fab fa-bitcoin'></i><br />Estimated Total Not Including Tax or Shipping.<br />Visa, Mastercard, American Express and Discover accepted and processed with Square.<br />Bitcoin is accpeted via Coinbase or Square Cash App.</p>";
    $subject_VAL = $subject_PH;
    $formType = "RequestQuoteForm"; 

    // if($_REQUEST['open']) {
        // $formSizes = "<div class='select-wrapper'><label for='buysize'></label><select name='buysize'><option value='---'>SELECT YOUR tinyViews&trade; EDITION SIZE</option><option vlaue='4x6'>4x6 ($20)</option><option vlaue='8x8'>8x8 ($40)</option><option vlaue='8x10'>8x10 ($80)</option></select></div>";
        // $promo_field = null;
        // $subject_VAL = $subject_PH . " tinyViews&trade; Edition";
        // $shipping = "Shipping for tinysView&trade; is a flat-rate $5 in the USA. For orders outside the USA we will contact you with an estimate.";

    // } else {

        if(isSet($frame) AND $edition == 'tinyviews') {
            if($frame != "PRINT-ONLY" && $cost <= 80) { $cost = $cost + 20;  $fc=20; }
            if($frame != "PRINT-ONLY" && $cost >= 81) { $cost = $cost + 40; $fc=40; }

            if ($frame != "PRINT-ONLY") {
                $frame = str_replace("$$", "$" . $fc, $frame);
                $frame = 'WITH ' . $frame . ' FRAME';
            } else {
                $frame = 'PRINT-ONLY';
            }
        }

        $formSizes = '<p><input type="text" id="contactsize" name="contactsize" value="' . urldecode($size) . ' ' . $frame . ' [CATALOG NUMBER ' . $catalog_no . ']" required /></p>';

        // if(isSet($promo_code) && $promo_code == "COLAMOF-SAVE52") {
        //     $formSizes = '<p><input type="text" id="contactsize" name="contactsize" value="60CM/16x20 WITH ' . $frame . ' FRAME" required></p>';
        //     $estimated_cost = "<h2>$480</h2>";
        // }
    // }

    $estimated_cost = "<h2>" . $cost . " USD</h2>";

} else {
    $formTitle = $this->title;
    $subTitle = null;
    $subject_PH = "PHOTOGRAPH TITLE OR SUBJECT";
    $message_PH = null; 
    $button_label = "SEND MESSAGE";
    $promo_field = null;
    $payment_field = null;
    $subject_VAL = null;
    $formType = "ContactForm";
}
    
?>