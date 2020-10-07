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
            $edition = "<span style='text-transform: lowercase;'>tiny</span><span style='text-transform: uppercase;'>VIEWS</span><span style='font-size: .9rem;'><sup>&trade;</sup></span> Open";
            $edition_text = 'tinyVIEWS Open Edition';
            if ($frame != "PRINT-ONLY") {
                $frame = str_replace("$$", "$" . $fc, $frame);
                $frame_long = ' with a ' . $frame . ' frame';
            } else {
                $frame_long = 'PRINT-ONLY';
            }

        } else {

            $edition = "Limited";
            $edition_text = "Limited Edition";
            if ($frame == 'FRAMELESS') {
                $frame_long = 'Acrylic Print (without frame)';
                $message_PH_frame = null;
            } else {
                $frame = "Premium Designer (Specify Color In Notes Below)";
                $frame_long = ' with a ' . $frame . ' frame';
                $message_PH_frame = true;
            }
        }

    $formTitle = "CHECKOUT";
    $subTitle = "Thank you for your interest in collecting a j.McCarthy photograph";
    $formTitleSub = "<span class='light'>" . $subTitle . ",</span> <span class='light initialcaps'>" . $photo . " " . $edition . " Edition </span>";
    if ($this->config->component_notice == 'true') {
        $subNotice = '<p class="notice mb-16">' . $this->data_notices->WARNING['content'] . '</p>';
    }

    $order_about_you = "<h3>About You</h3>";
    $subject_PH = "PURCHASE ORDER for " . strtoupper($photo);

    /* Shipping Information */
    // $message_PH = "IN THE BOX BELOW PLEASE TELL US THE FOLLOWING: <ul class='contact-ul mb-16'><li>Shipping Address (Provide Postal Code) or Pickup (Las Vegas, Nevada)</li><li>Phone Number, An art consultant will contact you within 24 hours to complete this order</li><li>Preferred Billing Method: Credit Card, Cash or BitCoin</li><li>And, any other questions you may have.</li></ul>";
    $message_PH_label = 
        '<input type="hidden" name="edition" value ="' . $edition . '" />' .
        '<input type="hidden" name="title" value ="' . $photo . '" />' .
        '<input type="hidden" name="size" value ="' . $size . '" />' .
        '<input type="hidden" name="price" value ="' . $cost . '" />' .
        '<input type="hidden" name="framing" value ="' . $frame . '" />' .
        '<input type="hidden" name="catalog_id" value ="' . $catalog_no . '" />' .
        '<input type="hidden" name="invoice_no" value ="' . time() . '-' . $catalog_no . '" />' .
        '<h3 class="">Ship To</h3>' . 
        '<p><input class="half-size-old" type="text" name="address" placeholder="SHIPPING ADDRESS (eg, 123 Main St.)" value="' . $address . '" $required />' .
        '<input class="half-size-old" type="text" name="address_other" placeholder="SHIPPING ADDRESS SECOND LINE (eg, Suite, Apt)" value="' . $address_exxtra . '"/></p>' .
        '<p><input class="half-size-old" type="text" name="city" placeholder="CITY (eg, Las Vegas, Dallas, Barstow)" value="' . $city . '"required/>' .
        '<input class="half-size-old" type="text" name="state" placeholder="State (eg, NV, CA, NY, TX)" value="' . $state . '"required/></p>' .
        '<p><input class="half-size-old" type="text" name="postalcode" placeholder="Postal Code (eg, 95474)" value="' . $postalcode . '"required/><p>' .
        '<p><input class="half-size-old" type="text" name="phone" placeholder="PHONE (eg, 951-708-1831)" value="' . $phone . '"required /><p>';

    if($message_PH_frame != null) {
        $message_PH = "Please specify your Premium Designer Frame color below as well as any additional shipping or billing information. More information on this can be found at https://jmgalleries.com/styles";
    } else {
        $message_PH = "Please specify any additional order information here. This would include your optional Premium Desinger Frame choice if selected, or any special shipping or billing information.";
    }

    $button_label = "PLACE YOUR ORDER";
    $promo_field = '<p class="pt-8 pb-32"><input class="half-size-old" style="margin-bottom: 0;" type="text" id="promocode" name="promocode" placeholder="PROMO CODE" value="' . $promo_code . '" /> <span class="ml-16 tiny"><a href="#" id="apply_promo">apply code</a></span></p>';
    $payment_field = "<p class='pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /> <!-- <i style='font-size: 1.8rem; margin-left: 5px;' class='fab fa-bitcoin'></i> --><br /><span class='small'Estimated Total Not Including Tax or Shipping or any Promotional Codes.<br />Visa, Mastercard, American Express and Discover accepted and processed with Square. Shipping costs and tax, if applicable, will be included on final Invoice. <!-- Bitcoin is accepted via Coinbase or Square Cash App.<br />-->Cash (USD) is accepted on pickup only orders. No checks. <b>There is no payment due at this time. You will be invoiced separately through Square.</b></span></p>";
    $subject_VAL = $subject_PH . ' ' . $edition_text;
    $subject_disabled = 'disabled="disabled" style="background-color: rgba(0,0,0,.02); border: 1px solid rgba(0,0,0,.03); color: #000;"';
    $formType = "RequestQuoteForm"; 
    $estimated_cost_calc = "<span id='estimated_cost_format'>" . number_format($cost, 2) . " USD</span></h2>";
    $estimated_cost = "<span id='estimated_cost' class='hidden'>" . $cost . "</span>";
    $formSizes = '<h3 class="mt-32">$' . $estimated_cost_calc . '</h3><input class="half-size-old" type="text" id="contactsize" name="contactsize" value="' . urldecode($size) . ' ' . $frame_long . ' [CATALOG NUMBER ' . $catalog_no . ']" disabled="disabled" style="background-color: rgba(0,0,0,.02); border: 1px solid rgba(0,0,0,.03); color: #000;" required />';


} else {
    // Just a regular contact form
    $formTitle = strtoupper($this->page->title);
    $subTitle = null;
    $order_about_you = null;
    $subject_PH = "IN A FEW WORDS, WHAT IS THIS MESSAGE ABOUT";
    $message_PH = "PLEASE TELL US HOW WE MAY BE ABLE TO HELP YOU HERE."; 
    $button_label = "SEND MESSAGE";
    $promo_field = null;
    $payment_field = null;
    $subject_VAL = null;
    $subject_disabled = null;
    $formType = "ContactForm";
    $subNotice = null;
}
    
?>