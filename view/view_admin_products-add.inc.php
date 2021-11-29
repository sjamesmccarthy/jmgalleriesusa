<?php

/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
} else {
    header('location:/studio/signin');
}

 /* Get any notifications of errors */
    if($_SESSION['error'] == "200") {
        $notification_state = "show";
        $notification_msg = $_SESSION['notification_msg'];
        $_SESSION['error'] = null;
        $_SESSION['notify_msg'] = null;
    }

$res_taxable = 'FALSE';
$read_only = 'READONLY';

/* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
if(isSet($this->routes->URI->queryvals)) {
    
    foreach($this->data->routePathQuery as $key => $val) {
        $params[] = explode('=', $val); // fastest but not best way to handle this, also not reliable if I ever pass ?filter on the query line for non-edits
    }

    $edit_id = $params[0][1];

    $edit_data = $this->api_Admin_Get_Products_Item($edit_id);
    extract($edit_data, EXTR_PREFIX_ALL, "res");
    
    $image_data = json_decode($res_image, TRUE);
    
    $res_ship_tier = htmlspecialchars($res_ship_tier);
    $res_title = htmlspecialchars($res_title);
    $res_teaser = htmlspecialchars($res_teaser);

    /* IMAGES: loop through the json array */
    $i=1;
    foreach ($image_data as $iK => $iV) {

        ${"res_image_" . $i} = $iV['name'];
        if ( !file_exists($_SERVER["DOCUMENT_ROOT"] . "/view/image/product/" . ${"res_image_" . $i}) ) {
            ${"res_image_" . $i} = "ERROR: IMAGE_FILE_NOT_FOUND";
        } 
        
        $i++;
    }

    /* IMAGES: check for thumbnail image file on server */
    // watkins-window-framed-limited-edition_thumb.jpg
    
    if ( file_exists($_SERVER["DOCUMENT_ROOT"] . "/view/image/product/" . $res_uri_path . '_thumb.jpg') ) {
        $res_image_6 = $res_uri_path . '_thumb.jpg';
    }
        
    if($res_image != '') {
        $show_image1_html = '<div class="show-image-container"><img src="/view/image/product/' . $res_image_1 . '" class="show-image" alt="' . $res_image_1 . '" /></div>';
        $image_info_1 = "<span class='file--image_info'>CURRENT IMAGE FILE /view/image/product/" . $res_image_1 . "</span>";   
    } else {
        $show_image1_html = '<div class="image_filler"><img id="file_1_prev" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    if(isSet($res_image_2)) {
        $show_image2_html = '<div class="show-image-container"><img src="/view/image/product/' . $res_image_2 . '" class="show-image" alt="' . $res_image_2 . '" /></div>';
        $image_info_2 = "<span class='file--image_info'>CURRENT IMAGE FILE /view/image/product/" . $res_image_2 . "</span>";
    } else {
        $show_image2_html = '<div class="image_filler"><img id="file_2_prev" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    if(isSet($res_image_3)) {
        $show_image3_html = '<div class="show-image-container"><img src="/view/image/product/' . $res_image_3 . '" class="show-image" alt="' . $res_image_3 . '"  /></div>';
        $image_info_3 = "<span class='file--image_info'>CURRENT IMAGE FILE /view/image/product/" . $res_image_3 . "</span>";
    } else {
        $show_image3_html = '<div class="image_filler"><img id="file_3_prev" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    if(isSet($res_image_4)) {
        $show_image4_html = '<div class="show-image-container"><img src="/view/image/product/' . $res_image_4 . '" class="show-image" alt="' . $res_image_4 . '" /></div>';
        $image_info_4 = "<span class='file--image_info'>CURRENT IMAGE FILE /view/image/product/" . $res_image_4 . "</span>";
    } else {
        $show_image4_html = '<div class="image_filler"><img id="file_4_prev" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    if(isSet($res_image_5)) {
        $show_image5_html = '<div class="show-image-container"><img src="/view/image/product/' . $res_image_5 . '" class="show-image" alt="' . $res_image_5 . '" /></div>';
        $image_info_5 = "<span class='file--image_info'>CURRENT IMAGE FILE /view/image/product/" . $res_image_5 . "</span>";
    } else {
        $show_image5_html = '<div class="image_filler"><img id="file_5_prev" alt="file_5_preview" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }
    
    if(isSet($res_image_6)) {
        $show_image6_html = '<div class="show-image-container"><img src="/view/image/product/' . $res_image_6 . '" class="show-image" alt="' . $res_image_6 . '" /></div>';
        $image_info_6 = "<span class='file--image_info'>CURRENT IMAGE FILE /view/image/product/" . $res_image_6 . "</span>";
    } else {
        $show_image6_html = '<div class="image_filler"><img id="file_56_prev" alt="file_6_preview" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    $this->page->title = "<b>Editing Product: " . $res_product_id . "</b>";
    $formTypeAction = "update";
    $button_label="update fieldnote";
    // $button_archive_cancel = '<button class="btn-delete mt-32" id="archive" value="ARCHIVE">archive supplier</button>';
    $button_archive_cancel = '<a class="cancel-button" href="/studio/products">cancel</a>';
    $id_field = '<input type="hidden" name="products_id" value="' . $res_product_id . '" />';
    $file_1_hidden = '<input type="hidden" name="file_1_hidden" value="' . $res_image_1 . '.jpg" />';
    $short_path_disabled = 'disabled';
    $image_info = "<span class='file--image_info'>CURRENT IMAGE FILE /view/image/product/" . $res_image_1 . "</span>";

} else {

    $formTypeAction = "insert";
    $button_label = "add New Product";
    $file_1_hidden = null; 
    $button_state = "show";
    $legacy_exp_field = null;
    $this->page->title = "Adding <b>New Product To Shop</b>";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/products">cancel</a>';
    // $date_field_hidden = 'noshow';
    $res_created = $mysql_ts = date('Y-m-d H:i:s');
    $show_image1_html = '<div class="image_filler"><img id="file_1_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image2_html = '<div class="image_filler"><img id="file_2_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image3_html = '<div class="image_filler"><img id="file_3_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image4_html = '<div class="image_filler"><img id="file_4_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image5_html = '<div class="image_filler"><img id="file_5_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image6_html = '<div class="image_filler"><img id="file_6_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    
    $res_ship_tier = htmlspecialchars('{"USPS": {
            "name": "USPS Shipping (no tracking)",
            "abrv": "usps",
            "tracking": "false",
            "amount": "10"},
        "UPS": {
            "name": "UPS Ground (with tracking)",
            "abrv": "ups",
            "tracking": "true",
            "amount": "40"
        }}');
    
    $res_in_stock = "true";
}

 /* Get Inventory IDs and names */
    $inventory_data = $this->api_Admin_Get_InventoryForShop();
    
    $inventory_ids_html = '<div class="select-wrapper half-size vtop">
    <label for="art_id">Inventory art_id</label>
    <select id="art_id" name="art_id">
    <option value="- - -" />- - - </option>';
    
    foreach ($inventory_data as $catK => $catV) {
        if($catV['art_id'] == $res_art_id) { $selected = 'SELECTED'; } else { $selected = null; }
        $inventory_ids_html .= '<option ' . $selected . ' value="' . $catV['art_id'] . '">' . $catV['title'] . ' (' . $catV['print_size'] . ')</option>';
    }
    
    $inventory_ids_html .= '</select>
    </div>';
    
/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

 if(isSet($this->routes->URI->queryvals )) {
    $filter ='RESULT';
    $form_result_state = "show";
    $form_sql_state = "noshow";
    $active_filter = null;
    $result = $this->api_Admin_Get_Reports_Sql($res_sql);
    $result_json = json_encode($result);
    $columns = array_keys($result[0]);

    foreach ($columns as $key => $val) {
        $table_keys .= "<th>" . $val . "</th>";
        $dataTableColumns .= "{ data:'" . $val . "'},"; 
    }

    $dataTableColumns = rtrim($dataTableColumns, ",");
    
} else {
    $filter = null;
    $form_result_state = "noshow";
    $form_sql_state = "show";
    $active_filter = 'active';
}

?>