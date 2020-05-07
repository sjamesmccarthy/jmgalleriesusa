<?php

/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
} else {
    header('location:/studio/signin');
}

if(count($this->data->routePathQuery) == 2) {
    
    $username_query = explode('=', $this->data->routePathQuery[0]);
    $res_username = $username_query[1];
    
    $collector_id_query = explode('=', $this->data->routePathQuery[1]);
    $ac_id = $collector_id_query[1];
    
    unset($this->routes->URI->queryvals);
} 

$received = 1;

/* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
if(isSet($this->routes->URI->queryvals)) {
    
    $edit_id = $this->routes->URI->queryvals[1];

    $edit_data = $this->api_Admin_Get_Order($edit_id);
    extract($edit_data, EXTR_PREFIX_ALL, "res");
    $item_info = json_decode($res_item);
 
    /* Math for total price */
    $promos = array("TESTCODE"=>"10%", "COLLECT20"=>"20");
    
    foreach ($promos as $k => $v) {
        if($res_discount == $k) { $promo_discount = $v; $promo_active = 1; }
    }

    $total_price = (int)$res_price + (int)$res_tax + (int)$res_shipping - (int)$promo_discount;
    if ($promo_active == 1) {
        $promo_discount = "(REFLECTS " . $res_discount . " PROMO " . $promo_discount . " OFF)";
    }
    
    if( isSet($res_received) AND isSet($res_invoiced) AND isSet($res_printed) AND isSet($res_packaged) AND isSet($res_shipped) ) {
        $button_label="order closed";
        $button_archive_cancel = NULL;
        $form_disabled = 'disabled';
        $closed = 'closed';
        if($res_tracking_number != '') { $res_tracking_number_formatted = " | " . $res_tracking_number; $disable_css = "fake-disabled"; }
    } else {
        $button_label="update order";
        $button_archive_cancel = '<button class="btn-delete mt-32" id="archive" value="ARCHIVE">CANCEL ORDER</button>';
        $form_disabled = null;
        $closed = null;
        if($res_tracking_number != '') { $res_tracking_number_formatted = $res_tracking_number; $disable_css = "fake-disabled"; }
    }

    $this->page->title = "Editing Order: <b>" . $res_invoice_number. "</b>";
    $formTypeAction = "update";
  
    $id_field = '<input type="hidden" name="order_id" value="' . $res_product_order_id . '" />';
    $id_field .= '<input type="hidden" name="product_customer_id" value="' . $res_product_customer_id . '" />';
} 

/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

?>