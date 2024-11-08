<?php 
    
/* FILMSTRIP: GALLERY THUMBS */
$you_may_also_like_html = $this->component('most_popular');


/* FETCH DETAILS FOR PRODUCT BEING VIEWED */
$pg_data = $this->api_Product_Get_Item($this->page->uri);
// $this->console($pg_data);

if($pg_data['error_no'] == '0REC') {
    header('location:/404');
}

extract($pg_data, EXTR_PREFIX_ALL, "res");

/* FORM FIELDS: HIDDEN */
$hidden_felds = '<input type="hidden" name="formType" value="SquarePaymentForm_productOrder" />';
$hidden_felds .= '<input type="hidden" name="product_id" value="' . $res_product_id . '" />';
$hidden_felds .= '<input type="hidden" name="title" value="' . urlencode($res_title) . '" />';
$hidden_felds .= "<input type='hidden' name='ship_rates' value='" . $res_ship_tier . "' />";
$hidden_felds .= "<input type='hidden' name='edition_type' value='product' />";

/* PRICING */
    
    if($res_on_sale != '0') {
        $on_sale_amt = $res_price * $res_on_sale;
        $on_sale_price = $res_price - round($on_sale_amt);
        $on_sale_percentage = ($res_on_sale * 100) . "%";
        $on_sale_label = "<span class='--strike'><strike>$" . number_format( $res_price,2) . "</strike></span><p class='--savings'>You Save $" . number_format($on_sale_amt) . " (" . $on_sale_percentage . " off)</p>";
        $price_html = '<p class="--price">$' . number_format( $on_sale_price,2 ) . ' ' . $on_sale_label;
    } else {
        $on_sale_price = null;
        $on_sale_label = null;
        $price_html = '<p class="--price">$' . number_format($res_price,2);
    }

$hidden_felds .= '<input type="hidden" name="price" value="' . $res_price . '" />';
$hidden_felds .= '<input type="hidden" name="price_sale" value="' . round($on_sale_price,2) . '" />';

/* DETAILS */
if($res_details != '') {

    $list = explode("\n", $res_details);
    $res_details_html = "<ul>";
    // $res_details_html = "<p class='mt-16 normal'><span class='bold'>Details</span><br />" . $res_details . "</p>";
    foreach ($list as $item) {
        $res_details_html .= "<li>" . $item . "</li>";
    }

    $res_details_html .= "</ul>";

}

/* SHIPPING & INVENTORY */
$ship_rates = json_decode($res_ship_tier,TRUE);
// $this->console($ship_rates);

$options_html = "<ul class='--shipping'>";
$options_quantity_html = '<div class="select-wrapper half-size"><select id="quantity" name="quantity" style="margin-bottom: 0">';

/* Inject InStock & Shipping Options */
if($res_quantity >= 1 && $res_in_stock == "true") {
    $options_html .= "<li>In Stock</li>";
    $in_stock_html = "<p class='--instock mt-32'>In Stock</p>";

    $options_html .= "<p class='mt-16 mb-16'>Shipping:</p>";
    foreach($ship_rates as $sK => $sV) {
        $options_html .= "<li>" . $sV['name'];
        if($sV['amount'] != 0) {
            $options_html .= " +$" . $sV['amount'];
            $free_ship = null;
        } else {
            $options_html .= " - FREE";
            $free_ship =  '<p class="--shipping-free">FREE SHIPPING USA</p>';
        }
        $options_html .= "</li>";
    }

    for ($x = 1; $x <= $res_quantity; $x++) {
        $options_quantity_html .= '<option value="' . $x . '">' . $x . '</option>';
    }

    $options_quantity_html .= "</select></div>";
    $buy_button = '<button class="buy_btn">Buy Now</button>';

} else {
    $options_quantity_html = '<div class="--soldout">SOLD OUT</div>';
    $buy_button = null;
    // $options_quantity_html = null;
}

$options_html .= "</ul>";

if($res_quantity == 1) {
    $options_quantity_html = "<input type='hidden' name='quantity' value='1' />";
}

/* IMAGES */
$res_image = json_decode($res_image, true);
// $this->console($res_image);

/* 
<div class="fotorama">
  <img src="https://s.fotorama.io/1.jpg">
  <img src="https://s.fotorama.io/2.jpg">
</div>
*/

$image_html = '<div style="max-width:85%; margin: auto;">';
// $image_html .= '<div class="slider">';
$image_html .= '<div class="fotorama" data-nav="thumbs" data-arrows="false"
data-click="true" data-swipe="true" data-allowfullscreen="true">';

    foreach($res_image as $iK => $iV) {  
        
        $target_file = $_SERVER["DOCUMENT_ROOT"] . '/view/__image/product/' . $iV['name'];
        
        if(file_exists( $target_file ) && $iK != "file_6" & $iV['size'] != "0") {
            // $image_html .= '<div><img src="/view/__image/product/' . $iV['name'] . '" alt="product image" /></div>';
            $image_html .= '<img src="/view/__image/product/' . $iV['name'] . '" alt="product image" />';
        }
        
    }

$image_html .= "</div></div>";
?>