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
  

        if(isSet($email)) {
            $collector_address = $this->api_Admin_Get_Collector('null',$email);
            extract($collector_address, EXTR_PREFIX_SAME, "dup");
        }

        if(isSet($frame) AND $edition == 'tinyviews') {
            // if($frame != "PRINT-ONLY" && $cost <= 80) { $cost = $cost + 20;  $fc=20; }
            // if($frame != "PRINT-ONLY" && $cost >= 81) { $cost = $cost + 40; $fc=40; }

            if ($frame != "PRINT-ONLY") {
                $frame = str_replace("$$", "$" . $fc, $frame);
                $frame_long = ' with a ' . $frame . ' frame';
            } else {
                $frame_long = 'PRINT-ONLY';
            }

        } else {

            if ($frame == 'ACRYLIC') {
                $frame_long = 'Acrylic Print (without frame)';
            } else {
                $frame_long = ' with a ' . $frame . ' frame';
            }
        }

    $formTitle = "CHECKOUT <span class='lowercase light'>for</span> <span class='light initialcaps'>" . $photo . "</span>";
    $subTitle = "Thank you for your interest in collecting a j.McCarthy Limited Edition";
    if ($this->config->component_notice == 'true') {
        $subNotice = '<p class="notice mb-16">' . $this->data_notices->WARNING['content'] . '</p>';
    }
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
        '<p><input class="half-size" type="text" name="phone" placeholder="PHONE (eg, 951-708-1831)" value="' . $phone . '"required /><p>' .
        '<p><input class="half-size" type="text" name="address" placeholder="SHIPPING ADDRESS (eg, 123 Main St.)" value="' . $address . '" $required />' .
        '<input class="half-size" type="text" name="address_other" placeholder="SHIPPING ADDRESS SECOND LINE (eg, Suite, Apt)" value="' . $address_exxtra . '"/></p>' .
        '<p><input class="half-size" type="text" name="city" placeholder="CITY (eg, Las Vegas, Dallas, Barstow)" value="' . $city . '"required/>' .
        '<input class="half-size" type="text" name="state" placeholder="State (eg, NV, CA, NY, TX)" value="' . $state . '"required/></p>' .
        '<p><input class="half-size" type="text" name="postalcode" placeholder="Postal Code (eg, 95474)" value="' . $postalcode . '"required/><p>';


    $button_label = "PLACE YOUR ORDER";
    $promo_field = '<p class="pt-8 pb-32"><input class="half-size" style="margin-bottom: 0;" type="text" id="promocode" name="promocode" placeholder="PROMO CODE" value="' . $promo_code . '" /> <span class="ml-16 tiny"><a href="#" id="apply_promo">apply code</a></span></p>';
    $payment_field = "<p class='pt-16 pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /> <i style='font-size: 1.8rem; margin-left: 5px;' class='fab fa-bitcoin'></i><br /><span class='small'Estimated Total Not Including Tax or Shipping or any Promotional Codes.<br />Visa, Mastercard, American Express and Discover accepted and processed with Square.<br />Bitcoin is accepted via Coinbase or Square Cash App.<br />Cash (USD) is accepted on pickup only orders.<br />No checks.</span></p>";
    $subject_VAL = $subject_PH;
    $formType = "RequestQuoteForm"; 
    $formSizes = '<input class="half-size" type="text" id="contactsize" name="contactsize" value="' . urldecode($size) . ' ' . $frame_long . ' [CATALOG NUMBER ' . $catalog_no . ']" required />';

    $estimated_cost = "<span id='estimated_cost' class='hidden'>" . $cost . "</span><h2><span id='estimated_cost_format'>" . number_format($cost, 2) . " USD</span></h2>";

} else {
    // Just a regular contact form
    $formTitle = $this->page->title;
    $subTitle = null;
    $subject_PH = "PHOTOGRAPH TITLE OR SUBJECT";
    $message_PH = "IN THE AREA BELOW PLEASE TELL US HOW WE CAN HELP YOU."; 
    $button_label = "SEND MESSAGE";
    $promo_field = null;
    $payment_field = null;
    $subject_VAL = null;
    $formType = "ContactForm";
    $subNotice = null;
}
    
?>