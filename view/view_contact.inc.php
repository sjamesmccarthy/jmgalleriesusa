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
    
    // https://jmgalleries.com/contact
    // ?photo=first-light
    // &size=5x7
    // &frame=PRINT-ONLY
    // &cost=129.95
    //
    //
    // &edition=tinyviews
    // &catalog_no=MDT8OT

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
            $deposit = false;
            $deposit_hidden = null;
            $order_type = "ORDER";

            if ($frame != "PRINT-ONLY-WITH-MATTE") {
                $frame = str_replace("$$", "$" . $fc, $frame);
                $frame_long = ' with a ' . $frame . ' frame';
                $print_note = null;
            } else {
                $frame_long = 'Matted Print (or Giclée) only ';
            }
            
            $print_note = '<p class="tiny pb-16 blue">Note: All prints are matted one size up. So, a 5x7 print is matted to 8x10; or a 8x10 print is matted to 11x14; or a 11x14 print is matted to 16x20. If optionally framed, the overall total size will include the matte. So a framed and matted 5x7 print will have an approx. total size of 10x12.</p>';

        } else {

            $edition = "Limited";
            $edition_text = "Limited Edition";
            $deposit= true;
            $deposit_hidden = "<input type='hidden' id='deposit' name='deposit' value='true' />";
            $limited_deposit = "<p class='pb-16' style='margin-top: -1rem;'><b>$100 REQUIRED DEPOSIT TODAY</b>, and remaining balance will be separately invoiced.</p>";
            $order_type = "DEPOSIT";
            $frame_uri = $frame;
            $frame_desc = $frame;

            if ($frame == 'FRAMELESS') {
                $frame_long = 'Acrylic Print (no frame included)';
                $message_PH_frame = null;
            } else {

                if($frame_uri == "ADDWITHACRYLIC") {
                    $img_type = "Acrylic Print";
                    $frame_desc = 'Black Vodka, Whiskey or Bourbon';
                    $message_PH_frame = true;
                } else {
                    $img_type = 'Fine Art Paper';
                    $frame_desc = 'Black Vodka, Whiskey or Bourbon';
                }

                $frame = "Premium Designer (" . $frame_desc . ")";
                $frame_long = $img_type . ' with a ' . $frame . ' frame';
                $message_PH_frame = true;
            }
        }
    
    $action_uri = "/view/ajax_square_payment_process.php";
    $action_id = "nonce-form";
    $formTitle = "Checkout";
    $subTitle = "Thank you for your interest in collecting a j.McCarthy photograph";
    $formTitleSub = "<span class='light'>" . $subTitle;
    //  . ",</span> <span class='light initialcaps'>" . $photo . " " . $edition . " Edition </span>";
    if ($this->config->component_notice == 'true') {
        $subNotice = '<p class="notice mb-16">' . $this->data_notices->WARNING['content'] . '</p>';
    }

    $order_about_you = "<h3>About You</h3>";
    $subject_PH = "ORDER for " . strtoupper($photo);

    $hide_for_order = 'hide-for-order';
    /* Shipping Information */
    // $message_PH = "IN THE BOX BELOW PLEASE TELL US THE FOLLOWING: <ul class='contact-ul mb-16'><li>Shipping Address (Provide Postal Code) or Pickup (Las Vegas, Nevada)</li><li>Phone Number, An art consultant will contact you within 24 hours to complete this order</li><li>Preferred Billing Method: Credit Card, Cash or BitCoin</li><li>And, any other questions you may have.</li></ul>";
    $message_H3 = "<h3 class='pt-32 pb-16'>Additional Order Information</h3>";
    $message_PH_label = 
        '<input type="hidden" name="edition" value ="' . $edition . '" />' .
        '<input type="hidden" name="title" value ="' . $photo . '" />' .
        '<input type="hidden" name="size" value ="' . $size . '" />' .
        '<input type="hidden" id="price" name="price" value ="' . $cost . '" />' .
        '<input type="hidden" name="image_type" value ="' . $img_type . '" />' .
        '<input type="hidden" name="framing" value ="' . $frame_long . '" />' .
        '<input type="hidden" name="catalog_id" value ="' . $catalog_no . '" />' .
        '<input type="hidden" name="invoice_no" value ="' . time() . '-' . $catalog_no . '" />' .
        '<h3 class="pt-16">Ship To</h3>' . 
        '<p><input class="half-size-old" type="text" name="address" placeholder="SHIPPING ADDRESS (eg, 123 Main St.)" value="' . $address . '" $required />' .
        '<input class="half-size-old" type="text" name="address_other" placeholder="SHIPPING ADDRESS SECOND LINE (eg, Suite, Apt)" value="' . $address_exxtra . '"/></p>' .
        '<p><input class="half-size-old" type="text" name="city" placeholder="CITY (eg, Las Vegas, Dallas, Barstow)" value="' . $city . '"required/>' .
        '<input class="half-size-old" type="text" name="state" placeholder="State (eg, NV, CA, NY, TX)" value="' . $state . '"required/></p>' .
        '<p><input class="half-size-old" type="text" name="postalcode" placeholder="Postal Code (eg, 95474)" value="' . $postalcode . '"required/><p>' .
        '<p><input class="half-size-old" type="text" name="phone" placeholder="PHONE (eg, 951-708-1831)" value="' . $phone . '"required /><p>
        
        <ul class="shipping">
            <li>
                <input CHECKED type="checkbox" id="ship_USPS" name="ship_USPS" value="1" /> 
                <label for="ship_USPS" style="color: #000"> Standard Free Shipping - USPS First Class (no tracking)</label>
            </li>
            <li>
                <input type="hidden" id="ship_UPS_value" name="ship_UPS_value" value="0" /> 
                <input type="checkbox" id="ship_UPS" name="ship_UPS" value="30" /> 
                <label for="ship_UPS" style="color: #000"> UPS Ground Shipping - $30 (with tracking)</label>
            </li>
        </ul>';

    if($message_PH_frame != null) {

        if($frame_uri == "ADDWITHACRYLIC") {
            $sq_extraBilling_PH = "<p class='tiny pb-16 blue'>You additionally requested a Premium Designer Frame. This is not included in your pricing shown above, and will be an additional cost determined later. An art consulatant will be contacting you in regards to your framing needs and a separate invoice will be sent to your e-mail.</p>";

            $sq_extraBilling = "<div class='tiny'><b>IMPORTANT NOTE:</b> " . $sq_extraBilling_PH . "</div>";

        }

        $message_PH = "Please specify your Premium Designer Frame color below. More information on this can be found at https://jmgalleries.com/styles\n\n" . $sq_extraBilling_PH;

    } else {
        $message_PH = null;
        $sq_extraBilling = null;
    }

    $promo_field = '<p class="pt-8 pb-32 promo-container"><input class="half-size-old" style="margin-bottom: 0;" type="text" id="promocode" name="promocode" placeholder="PROMO CODE" value="' . $promo_code . '" /><input type="hidden" id="promo_amt" name="promo_amt" value="0" /><span class="ml-16 tiny promo-btn"><a href="#" id="apply_promo">apply code</a></span></p><p class="promo-label"><b>PROMO <span class="promo-name"></span> APPLIED</b></p>';
    $payment_field = "<h3 class='mt-32'>Payment</h3><p class='pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /> <!-- <i style='font-size: 1.8rem; margin-left: 5px;' class='fab fa-bitcoin'></i> --><br /><span class='small'Estimated Total Not Including Tax or Shipping or any Promotional Codes.<br />Visa, Mastercard, American Express and Discover accepted and processed with Square. <!-- Shipping costs and tax, if applicable, will be included on final bill. Bitcoin is accepted via Coinbase or Square Cash App.<br /> Cash (USD) is accepted on pickup only orders. No checks. <u>There is no payment due at this time.</u> You will be billed separately through Square.--></span></p>";
    $subject_VAL = $subject_PH . ' ' . $edition_text;
    $subject_disabled = 'disabled="disabled"';
    $disabled_css = 'disabled-order';
    // $formType = "RequestQuoteForm"; 
    $formType = "SquarePaymentForm"; 

    $estimated_cost_raw = $cost * 100;
    $estimated_cost_calc = "<span id='estimated_cost_format'>" . number_format($cost, 2) . "</span>";
    $estimated_cost = "<span id='estimated_cost' class='hidden'>" . $cost . "</span>";
    $formSizes = '<h3 class="mt-32">$' . $estimated_cost_calc . '</h3>' . $limited_deposit . '<input class="half-size-old "' . $disabled_css . ' type="text" id="contactsize" name="contactsize" value="' . urldecode($size) . ' ' . 
    $frame_long . ' -- CATALOG NUMBER ' . $catalog_no . '" disabled="disabled" required />' . $print_note .  $sq_extraBilling_PH;

    if($deposit == true) { 
        $estimated_cost_raw = 100.0 * 100; 
        $estimated_cost_calc = "<span id='estimated_cost_format'>100</span></h2>";
    }

    $pay_SqPaymentForm = '<script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script>';
    $pay_SqForm_CSS = '<link rel="stylesheet" type="text/css" href="/view/css/sq-payment-form.css?<?= time(); ?>">';
    $pay_SqPaymentForm_localjs = '<script type="text/javascript" src="/view/js/squareapi.js"></script>';
    $pay_SqPaymentFormFields = '
        <input type="text" id="amount_total" name="amount_total" value="' . $estimated_cost_raw  . '" />
        <div id="sq-walletbox">
            <button id="sq-google-pay" class="button-google-pay"></button>
            <button id="sq-apple-pay" class="sq-apple-pay"></button>
            <button id="sq-masterpass" class="sq-masterpass"></button>
            <div class="sq-wallet-divider">
            <span class="sq-wallet-divider__text">Or</span>
            </div>
        </div>
    
        <div id="form-container">
            <div id="sq-card-number"></div>
            <div id="sq-expiration-date"></div>
            <div id="sq-cvv"></div>
            <div id="sq-postal-code"></div>
            <!-- <button id="sq-creditcard" 
                onclick="onGetCardNonce(event)">Pay $1.00</button> -->
        </div>
        <div>' . $sq_extraBilling . '</div>';
    
        $button_label = "PLACE YOUR $" . $estimated_cost_calc . " " . $order_type;

} else {
    // Just a regular contact form
    // $formTitle = $this->page->title;
    $action_uri = "/view/ajax_email_process.php";
    $action_id = "contactForm";
    $formTitle = "We'd Love To Hear From You";
    $subTitle = null;
    $order_about_you = null;
    $hide_for_order = null;
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