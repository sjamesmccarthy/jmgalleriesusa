<?php
extract($_POST, EXTR_PREFIX_ALL, "res");

/* Look up prodcut in database and check price */
$product_data = $this->api_Product_Get_Item(null,$_POST['product_id']);
// $this->console($product_data);

if($_POST['product_id'] == '1' || $_POST['product_id'] == '2' ) {
    $res_ship_rates = $product_data['ship_tier'];
} else {
    if ($_POST['price'] != $product_data['price']) {
    header('location:/order-problem');
    }
}


$order_title = urldecode($res_title);
// $action_uri = "/view/ajax_square_payment_process.php";
$action_uri = "/view/ajax_square_payment_local.php";
$formTitle = "Checkout";

/* Extra form fields for different order type */
switch($res_formType) {
    
    case "SquarePaymentForm_productOrder":
        $formType="SquarePaymentForm_productOrder";
        $subtitle = 'Thank you for your interest in a j.McCarthy fine-art product.';
        $add_frame_note = null;
        $sq_extraBilling = null;
        $limited_deposit = null;
        $order_type = "ORDER";
        $estimated_cost_raw = ($res_price * 100) * $res_quantity;
        $order_subject = '(' . $res_quantity . ') ' . $order_title;
        $hidden_fields = '<input type="hidden" name="quantity" value="' .  $res_quantity . '" />';
        $hidden_fields = '<input type="hidden" name="size" value="NA" />';
        $hidden_fields = "<input type='hidden' id='deposit' name='deposit' value='false' />";
    break;

    case "SquarePaymentForm_fineArt":
        $formType="SquarePaymentForm_fineArt";
        $subtitle = 'Thank you for your interest in a j.McCarthy Fine Art Photograph';

        if($res_frame == "ADDWITHACRYLIC") {
            $item_framing = "\n+ADD FRAME optional* Premium Designer frame.";
            $res_frame_price = 0;
            $add_frame_note_content = "*An art consultant will be contacting you in regards to your request for an optional Premium Designer frame. Once your framing needs are determined an additional bill for the extra framing will be created and emailed to you.";
            $add_frame_note = "\n" . $add_frame_note_content;
            $sq_extraBilling = "<div class='tiny'><b>IMPORTANT NOTE:</b><p class='tiny pb-16 blue'>Once your framing needs are determined an additional bill for the extra framing will be created and emailed to you.</p></div>";
        } else {
            $add_frame_note = null;
        }

        if($res_frame == "FRAMELESS") { $res_frame_price = 0; }
        if($res_frame == "FRAMEINCLUDED") { 
            $res_frame = ""; 
            $frame_forgot_not = "\n\n**We noticed you forgot to select a Premium Designer frame. We will have an art consultant contact you."; 
            $hidden_fields .= "<input type='hidden' name='frame_forgot' value='" . $frame_forgot_not . "' />";
        }

        if($res_matted_size != 0) {
            $matted_size = "(matted to " . $res_matted_size . ")";
            $hidden_matted = '<input type="hidden" name="matted_size" value ="' . $res_matted_size . '" />';
        }

        if($res_frame_price != "0") {
            if($res_edition == "limited") { 
                $frame_style = " Premium Designer"; 
            } else { 
                $frame_style = null; 
            }

            if($res_frame != "PRINT-ONLY-WITH-MATTE") {
                $item_framing = "\nFramed in a " . $res_frame . $frame_style . ' frame' . $frame_forgot_not;
            }
        }

        if($res_edition_type == "limited") {
            $deposit = "true";
            $hidden_fields .= "<input type='hidden' id='deposit' name='deposit' value='true' />";
            $hidden_fields .= "<input type='hidden' id='edition_type' name='edition_type' value='limited' />";
            $limited_deposit = "<p class='mt-8'><b>$100 REQUIRED DEPOSIT TODAY</b>, and remaining balance will be separately invoiced.</p>";
            $order_type = "DEPOSIT";
            $estimated_cost_raw = 100.0 * 100; 
            $cost = "100";
            $edition_type_long = "Limited Edition";
        } else if ($res_edition_type == "open") {
            $deposit = "false";
            $hidden_fields .= "<input type='hidden' id='deposit' name='deposit' value='false' />";
            $hidden_fields .= "<input type='hidden' id='edition_type' name='edition_type' value='open' />";
            $order_type = "ORDER";
            $estimated_cost_raw = $res_price * 100;
            $edition_type_long = "Open Edition";
        } else {
            $deposit = "false";
            $hidden_fields .= "<input type='hidden' id='deposit' name='deposit' value='false' />";
            $hidden_fields .= "<input type='hidden' id='edition_type' name='edition_type' value='product' />";
            $order_type = "ORDER";
            $estimated_cost_raw = $res_price * 100;
        }

        $order_subject = '(' . $res_quantity . ') ' . $order_title . "\n" . $res_buysize     . $matted_size . " " . $res_img_type . $item_framing . "\n" . $edition_type_long  . "\n" . $add_frame_note;

        $hidden_fields .= '<input type="hidden" name="quantity" value="' .  $res_quantity . '" />';
        $hidden_fields .= '<input type="hidden" name="size" value ="' . $res_buysize . '" />';
        $hidden_fields .= '<input type="hidden" name="catalog_id" value ="' . $res_catalog_no . '" />';
        $hidden_fields .= '<input type="hidden" name="image_type" value ="' . $res_img_type . '" />';
        $hidden_fields .= '<input type="hidden" name="frame" value ="' . $res_frame . '" />';
        $hidden_fields .= $hidden_matted;

    break;

    default:
    echo "formType.switch.Default(error)<br>";
    break;

}

/* Orgnize Shipping Rates */
$res_ship_rates = json_decode($res_ship_rates,TRUE);
$ship_methods = count((array)$res_ship_rates);

if($ship_methods == 1) { 
    $disabled = 'disabled'; 
} else { 
    $disabled = null; 
}

    foreach($res_ship_rates as $sK => $sV) {

            if($sV['amount'] == '0') {
                $ship_amount = ' - FREE';
            } else {
                $ship_amount = ' +$' . $sV['amount'];
            }

            if($ship_methods == 1){
                $disabled = 'disabled';
                $checked = 'checked';
                $add_ship_cost = $sV['amount'];
                $add_shipping_provider = $sV['name'];
            } else {
                $disabled = null;
                $checked = null;
                $add_ship_cost = 0;
                $add_shipping_provider = $sV['name'];
            }

            $ship_rates_html .= '<li>
            <!-- <input type="hidden" id="ship_' . $sV['abrv'] . '_value" name="ship_' . $sV['abrv']. '" value="0" /> -->
            <input type="checkbox" data-shipper="' . $sV['name'] . '"' . $checked . ' class="ship" id="ship_' . $sV['abrv']. '" name="ship" value="' . $sV['amount'] . '" ' . $disabled . '/> 
            <label for="ship_' . $sV['abrv'] . '" style="color: #000"> ' . $sV['name'] . $ship_amount . '</label>
            </li>';

    }

/* Calculate pricing */
if(!isSet($res_price_sale) || $res_price_sale =='0') {
    $cost = ($res_price * $res_quantity) + $add_ship_cost;
} else {
    $cost = ($res_price_sale * $res_quantity) + $add_ship_cost;
}

if($deposit == "true") {
    $estimated_cost_raw = 100 * 100;
} else {
    $estimated_cost_raw = $cost * 100;
}

$estimated_cost_raw_formatted = number_format( ($estimated_cost_raw/100), 2);
$estimated_cost_calc = number_format($cost, 2);

if ($this->config->component_notice == 'true') {
    $subNotice = '<p class="notice mb-16">' . $this->data_notices->WARNING['content'] . '</p>';
}

/* Initialize Sqaure payment fields */
$pay_SqPaymentForm = '<script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script>';
// $pay_SqForm_CSS = '<link rel="stylesheet" type="text/css" href="/view/css/sq-payment-form.css?' . time() . '">';
$pay_SqPaymentForm_localjs = '<script type="text/javascript" src="/view/js/squareapi-' . $this->env . '.js"></script>';
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

$button_label = "PLACE YOUR $<span id='estimated_cost_format_btn'>" . $estimated_cost_raw_formatted . "</span> " . $order_type;

?>