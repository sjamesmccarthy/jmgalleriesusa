<?php

/* API call to fetch all products */
$product_data = $this->api_Product_Get_All();

/*
[0] => Array
        (
            [product_id] => 2
            [artist_id] => 1
            [title] => Trim & Frame Calendar
            [desc] => Start 2020 off right with a j.McCarthy Trim & Frame Calendar. Each month enjoy a new fine-art photograph printed on high quality photo paper. On the last day of the month simply trim off the calendar continue enjoying. You can hang them on the fridge with a small magnet or frame* them in any frame with a 5x5 opening. Each packet includes 12 months starting on January and ends  December. *Frame not included.
            [image] => {"1":"trim-frame-calendar_1.jpg","2":"trim-frame-calendar_2.jpg","3":"trim-frame-calendar_3.jpg"}
            [price] => 19.95
            [taxable] => false
            [upc] => 
            [in_stock] => true
            [quantity] => 2
            [ship_tier] => {"USPS First Class":"0"}
            [type] => single
            [uri_path] => trim-frame-calendar
            [created] => 2020-11-20 06:50:32
            [status] => ACTIVE
            [last_update] => 2020-11-30 10:12:18
        )
*/

$tv_le_link = '<p class="shop-tv-link"><a href="/all?filter=tinyviews">Browse Open Editions</a></p>';

foreach($product_data as $k => $v) {

    $ship_data = json_decode($v['ship_tier'], true);

    foreach($ship_data as $ks => $sv) {
        if( $sv['amount'] == '0') {
            $free_ship =  '<p class="shipping-free">FREE SHIPPING USA</p>';
        } else {
            $free_ship = null;
        }
    }

    if( $v['quantity'] == 1) {
        $only_one = '<br /><span style="color: red">Only 1 More Left!</span>';
    } else {
        $only_one = null;   
    }

    if($v['desc_short'] != '') {
        $desc_short = '<p class="tiny">' . $v['desc_short'] . '</p>';
    } else {
        $desc_short = null;
    }

    if($v['on_sale'] != '') {
        $on_sale_amt = $v['price'] * $v['on_sale'];
        $on_sale_price = $v['price'] - round($on_sale_amt);
        $on_sale_label = "<strike style='color:#adacb2'>$" . number_format( $v['price'],2) . "</strike><span style='color: #498d53'> (Save $" . number_format($on_sale_amt) . ")</span>";
        $price_html = '<p style="display: inline-block; margin-right: .5rem;"><b>$' . number_format( $on_sale_price ) . '</b> ' . $on_sale_label;
    } else {
        $on_sale_price = null;
        $on_sale_label = null;
        $price_html = '<p><b>$' . number_format($v['price'],2) . '</b>';
    }

    $img_file = $v['uri_path'] . '_thumb.jpg';

    /* For Mobile */
    /* On last two thumbnails add some css */
    if($count == 2) {
        $grid_css = 'col';
    } else if ($count == 3) {
        $grid_css = 'col';
    } else {
        $grid_css = 'col';
    }

    $thumb_html .= '<div style="position: relative; padding: 0 10px; overflow: hidden; margin-bottom: 32px" class="thumb ' . $grid_css .  ' pb-16 filter-thumb-gallery '. $data_filters . '"><a href="/product/' . $v['uri_path'] . '"><img style="width: 100%;" src="/view/image/product/' . $img_file . '" /></a></p><h4 class="pt-8"><a href="/product/' . $v['uri_path'] . '">' . $v['title'] . '</a></h4>' . $desc_short . $price_html . $only_one . '</p>' . $free_ship . '</div>';

}

?>