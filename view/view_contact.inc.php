<?php

if(isSet($this->data->routePathQuery[0])) {

    // https://jmgalleriesusa/contact?photo=wandering&size=SIZE:%2012x18&frame=PRINT-ONLY&cost=120&edition=tinyviews&catalog_no=MDT25OT
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

    $formTitle = "CHECKOUT <span class='lowercase light'>for</span> <span class='light initialcaps'>" . $photo . "</span>";
    $subTitle = "Thank you for your interest in collecting a j.McCarthy Limited Edition";
    $subject_PH = "PURCHASE ORDER for " . strtoupper($photo);

    /* Shipping Information */
    // $message_PH = "IN THE BOX BELOW PLEASE TELL US THE FOLLOWING: <ul class='contact-ul mb-16'><li>Shipping Address (Provide Postal Code) or Pickup (Las Vegas, Nevada)</li><li>Phone Number, An art consultant will contact you within 24 hours to complete this order</li><li>Preferred Billing Method: Credit Card, Cash or BitCoin</li><li>And, any other questions you may have.</li></ul>";
    $message_PH = 
        '<input type="hidden" name="edition" value ="' . $edition . '" />' .
        '<input type="hidden" name="title" value ="' . $photo . '" />' .
        '<input type="hidden" name="size" value ="' . $size . '" />' .
        '<input type="hidden" name="price" value ="' . $cost . '" />' .
        '<input type="hidden" name="framing" value ="' . $frame . '" />' .
        '<input type="hidden" name="catalog_id" value ="' . $catalog_no . '" />' .
        '<input type="hidden" name="invoice_no" value ="' . time() . '-' . $catalog_no . '" />' .
        '<p><input type="text" name="phone" placeholder="PHONE (eg. 951-708-1831)" required /><p>' .
        '<p><input type="text" name="address" placeholder="SHIPPING ADDRESS" required /><p>' .
        '<p><input type="text" name="address_other" placeholder="SHIPPING ADDRESS SECOND LINE (eg. Suite, Apt)" /><p>' .
        '<p><input type="text" name="city" placeholder="CITY (eg. RENO, LAS VEGAS, TEMECULA)" required/><p>' .
        '<p><input type="text" name="state" placeholder="State (eg. NV, CA, NY, TX)" required/><p>' .
        '<p><input type="text" name="postalcode" placeholder="Postal Code (eg. 95474)" required/><p>';


    $button_label = "PLACE YOUR ORDER";
    $promo_field = '<p class="pt-16 pb-16"><input style="margin-bottom: 0;" type="text" id="promocode" name="promocode" placeholder="PROMO CODE (DISCOUNT WILL BE APPLIED ON FINAL INVOICE)" value="' . $promo_code . '" /><!-- <br /><span class="tiny">Discount will be applied on final invoice</span>--></p>';
    $payment_field = "<p class='pt-16 pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /> <i style='font-size: 1.8rem; margin-left: 5px;' class='fab fa-bitcoin'></i><br />Estimated Total Not Including Tax or Shipping or any Promotional Codes.<br />Visa, Mastercard, American Express and Discover accepted and processed with Square.<br />Bitcoin is accpeted via Coinbase or Square Cash App.</p>";
    $subject_VAL = $subject_PH;
    $formType = "RequestQuoteForm"; 
    $formSizes = '<p><input type="text" id="contactsize" name="contactsize" value="' . urldecode($size) . ' ' . $frame . ' [CATALOG NUMBER ' . $catalog_no . ']" required /></p>';
    $estimated_cost = "<h2>" . $cost . " USD</h2>";

} else {
    // Just a regular contact form
    $formTitle = $this->title;
    $subTitle = null;
    $subject_PH = "PHOTOGRAPH TITLE OR SUBJECT";
    $message_PH = "IN THE AREA BELOW PLEASE TELL US HOW WE CAN HELP YOU."; 
    $button_label = "SEND MESSAGE";
    $promo_field = null;
    $payment_field = null;
    $subject_VAL = null;
    $formType = "ContactForm";
}
    
?>