<?php
/*
component: admin/reports
description: displays quick links to reports module
css: component_admin_reports.scss
data: db
created: jmccarthy
date: 11/24/19
version: 1
*/

/* Create an API call to get the Reports listings */
$orders_data = $this->api_Admin_Component_Orders();
$order_cnt = count($orders_data);

if ($order_cnt > 0) {
    foreach($orders_data as $key=>$val) {

        /* @TODO: need to refine how this works, timestamp columns can't be NULL */
        $background_color = null;

        if(is_null($val['shipped'])) {
            $icon_state = '<i class="fas fa-shipping-fast"></i>';
        }
        if(is_null($val['packaged'])) {
            $icon_state = '<i class="fas fa-box-open"></i>';
        }
        if(is_null($val['invoiced'])) {
            $icon_state = '<i class="fas fa-file-invoice-dollar"></i>';
        }
        if(is_null($val['printed'])) {
            $icon_state = '<i class="fa-solid fa-print"></i>';
        }
        if(is_null($val['accepted'])) {
            $background_color = 'background-color: #800020; color: #FFF';
            $icon_state = '<i class="fa-solid fa-bell-concierge"></i>';
        }

        if($val['closed'] == 1 || isset($val['shipped'])) {
            $icon_state = '<i class="fas fa-check-double"></i>';
            $background_color = 'background-color: #818589';
        }

        $product = json_decode($val['item'], TRUE);

        $product_desc = $product['title'];
        if($product['edition'] == 'product') {
            $product_desc .= ' (from jM Gallery Shop, id: ' . $val['product_id'] . ')';
        } else {
            if($product['framing'] = "FRAMELESS") { $product['framing'] = 'INSET'; }
            $product_desc .= ' (' .$product['catalog_id'] . ') ' . $product['size'] . ' ' . ucfirst($product['material']) . ' ' . ucfirst($product['edition']) . ' Edition (framing: ' . $product['framing'] . ') <br /> $' . number_format($val['price'],2) . " +" . $val['shipping_provider'];
        }

        $result_html .= '<li class="item" style="' . $background_color . '">';
        $result_html .= '<div class="detail">';
        $result_html .= '<p>' . $icon_state . '' . date("m/d/Y",strtotime($val['received']),) . ' - (<a href="/studio/orders-add?id=' . $val['product_order_id'] . '">' . $val['invoice_number'] . '</a>) - ' . $val['name'] . ' / ' . $val['city'] . ', ' . $val['state'] . ' ' . $val['postal_code'] . '</p>';
        // $result_html .= '<p class="small">' . $product_desc . '</p>';
        $result_html .= '</li>';
    }

} else {
    $result_html .= "No Orders Found";
}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="orders-component--container">

<div class="table--box gray">
    <h4>Order Summary</h4>
    <p class="small"><a href="/studio/orders">View All Orders</a> | <a href="/studio/products">View Inventory</a></p>
</div>

    <ul>
        $result_html
    </ul>

</article>
END;

return($html);

/*
[0] => Array
(
    [product_order_id] => 3
    [product_customer_id] => 3
    [product_id] =>
    [item] => {"edition":"tinyviews","title":"daisies-for-our-lady","size":"12x18","framing":"SNOW-WHITE( $40)","catalog_id":"FFC45OT"}
    [notes] =>
    [quantity] => 1
    [price] => 160
    [tax] =>
    [shipping] =>
    [shipping_provider] =>
    [tracking_number] => WILL SCHEDULE A PICK UP/DELIVERY
    [promo] => MAYFLOWERS
    [promo_amount] => 80.00
    [invoice_number] => 1589239570-FFC45OT
    [deposit] => false
    [received] => 2020-05-11 15:09:11
    [accepted] => 2020-05-12 11:25:28
    [invoiced] => 2020-05-15 12:14:18
    [sq_payment_id] =>
    [sq_last4] =>
    [sq_amount_money] =>
    [sq_status] =>
    [sq_order_id] =>
    [sq_receipt_number] =>
    [sq_receipt_url] =>
    [printed] => 2020-05-15 12:15:19
    [returned] =>
    [packaged] => 2020-05-15 12:14:31
    [shipped] => 2020-05-15 12:15:19
    [closed] => 1
    [name] => Matthew Campbell
    [email] => notcho473@gmail.com
    [phone] => 7028136188
    [address] => 1128 Cactus Rock St.
    [address_other] =>
    [city] => Henderson
    [state] => NV
    [postal_code] => 89011
    [added_collector] =>
    [added_newsletter] => 0
    [created] => 2020-05-11 14:27:18
)
*/

?>
