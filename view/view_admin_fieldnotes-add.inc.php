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

/* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
if(isSet($this->routes->URI->queryvals)) {
    
    foreach($this->data->routePathQuery as $key => $val) {
        $params[] = explode('=', $val); // fastest but not best way to handle this
    }

    // $edit_id = $this->routes->URI->queryvals[1];
    // modified 6/10/20 for result tab implementation, not best solution
    $edit_id = $params[0][1];

    $edit_data = $this->api_Admin_Get_Fieldnotes_Item($edit_id);
    $image_data = $this->api_Admin_Get_FieldnotesImagesById($edit_id);
    
    extract($edit_data, EXTR_PREFIX_ALL, "res");
    $res_title = htmlspecialchars($res_title);
    $res_teaser = htmlspecialchars($res_teaser);

    if( $image_data[0] != 'NaN') {
        $imgsLoaded = 1;
        $i=1;
        foreach ($image_data as $iK => $iV) {
            ${"res_image_" . $iV['file_order']} = $iV['path'];
            ${"res_caption_file_" . $iV['file_order']} = $iV['caption'];
            $i++;
        }
    } else {
        $res_image = null;
    }

    $tags_data = $this->api_Admin_Get_Fieldnotes_Tags($edit_id);
    foreach ($tags_data as $key => $value) {
        $tags  .= $value['tag'] . ", ";
    }
        $res_tags = trim($tags, ", ");

    /* TODO: condense this isn't a single loop */
    
    if($res_image != '') {
        $show_image1_html = '<div class="show-image-container"><img src="/view/image/fieldnotes/' . $res_image . '" class="show-image" alt="' . $res_image . '" /></div>';
        $res_caption_file_1 = $res_caption;
    } else {
        $show_image1_html = '<div class="image_filler"><img id="file_1_prev" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    if(isSet($res_image_2)) {
        $show_image2_html = '<div class="show-image-container"><img src="/view/image/fieldnotes/' . $res_image_2 . '" class="show-image" alt="'  $res_image_2 . '" /></div>';
    } else {
        $show_image2_html = '<div class="image_filler"><img id="file_2_prev" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    if(isSet($res_image_3)) {
        $show_image3_html = '<div class="show-image-container"><img src="/view/image/fieldnotes/' . $res_image_3 . '" class="show-image" alt="'  $res_image_3 . '"  /></div>';
    } else {
        $show_image3_html = '<div class="image_filler"><img id="file_3_prev" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    if(isSet($res_image_4)) {
        $show_image4_html = '<div class="show-image-container"><img src="/view/image/fieldnotes/' . $res_image_4 . '" class="show-image" alt="'  $res_image_4 . '" /></div>';
    } else {
        $show_image4_html = '<div class="image_filler"><img id="file_4_prev" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    if(isSet($res_image_5)) {
        $show_image5_html = '<div class="show-image-container"><img src="/view/image/fieldnotes/' . $res_image_5 . '" class="show-image" alt="'  $res_image_5 . '" /></div>';
    } else {
        $show_image5_html = '<div class="image_filler"><img id="file_5_prev" alt="file_5_preview" /><h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4></div>';
    }

    $this->page->title = "<b>Editing Field Note, ID " . $res_fieldnotes_id . "</b>";
    $formTypeAction = "update";
    $button_label="update fieldnote";
    // $button_archive_cancel = '<button class="btn-delete mt-32" id="archive" value="ARCHIVE">archive supplier</button>';
    $button_archive_cancel = '<a class="cancel-button" href="/studio/fieldnotes">cancel</a>';
    $id_field = '<input type="hidden" name="fieldnotes_id" value="' . $res_fieldnotes_id . '" />';
    $file_1_hidden = '<input type="hidden" name="file_1_hidden" value="' . $res_image . '.jpg" />';
    $short_path_disabled = 'disabled';
    $image_info = "<span class='file--image_info'>CURRENT IMAGE FILE /view/image/fieldnotes/" . $res_image . "</span>";

} else {
    $formTypeAction = "insert";
    $button_label = "add new field note";
    $file_1_hidden = null; 
    $button_state = "show";
    $legacy_exp_field = null;
    $this->page->title = "Adding <b>New Field Note</b>";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/fieldnotes">cancel</a>';
    // $date_field_hidden = 'noshow';
    $res_created = $mysql_ts = date('Y-m-d H:i:s');
    $show_image1_html = '<div class="image_filler"><img id="file_1_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image2_html = '<div class="image_filler"><img id="file_2_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image3_html = '<div class="image_filler"><img id="file_3_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image4_html = '<div class="image_filler"><img id="file_4_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
    $show_image5_html = '<div class="image_filler"><img id="file_5_prev" style="width: 100%;" /><!-- <h4 class="center">UPLOAD IMAGE<br />1050 x 619 pixels</h4> --></div>';
}

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