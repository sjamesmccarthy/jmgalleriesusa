<?php

/* API call to fetch all products */
$product_data = Core_Api::Api_Product_Get_All();

$tv_le_link = '<!-- <p class="shop-tv-link"><a href="/all?filter=tinyviews">Browse Open Editions</a> / <a href="/collections">Browse Limited Editions</a></p> -->';

if(!$product_data['error']) {
    foreach($product_data as $k => $v) {

        $ship_data = json_decode($v['ship_tier'], true);

        foreach($ship_data as $ks => $sv) {
            if( $v['quantity'] >= 1 && $sv['amount'] == '0') {
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

        if( $v['quantity'] == 0) {
            $only_one = '<br /><span class="soldout">SOLD OUT</span>';
        } else {
            $only_one = null;   
        }

        if($v['desc_short'] != '') {
            $desc_short = '<p class="tiny">' . $v['desc_short'] . '</p>';
        } else {
            $desc_short = null;
        }

        if($v['on_sale'] != '0') {
            $on_sale_amt = $v['price'] * $v['on_sale'];
            $on_sale_price = $v['price'] - round($on_sale_amt);
            $on_sale_percentage = ($v['on_sale'] * 100) . "%";
            $on_sale_label = "<strike style='color:#adacb2'>$" . number_format( $v['price'],2) . "</strike><span style='color: #498d53'> (<!--Save $" . number_format($on_sale_amt) . "-->" . $on_sale_percentage . " off)</span>";
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

        $thumb_html .= '<div style="position: relative; overflow: hidden; margin-bottom: 32px" class="thumb ' . $grid_css .  ' pb-16 filter-thumb-gallery '. $data_filters . '"><a href="/product/' . $v['uri_path'] . '"><img style="width: 100%;" src="/view/__image/product/' . $img_file . '" alt="' . $img_file . '" /></a></p><h4 class="pt-8"><a href="/product/' . $v['uri_path'] . '">' . $v['title'] . '</a></h4>' . $desc_short . $price_html . $only_one . '</p>' . $free_ship . '</div>';
    }
} else {
    $thumb_html .= '<div class="col-12 pt-32"><p class="shop-nothing-found">Good grief Charlie Brown,<br/>our shelves seem to be a bit bare today.<br />Please check back later.</p> <p style="text-align: center" class="pt-32"><a href="/fineart">BACK TO HOME</a></p></div>';
}

?>