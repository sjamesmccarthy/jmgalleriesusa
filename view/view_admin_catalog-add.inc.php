 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
    if(isSet($this->routes->URI->queryvals)) {
        $edit_file_name = $this->routes->URI->queryvals[1];
        $edit_data = $this->api_Catalog_Photo($edit_file_name);
        $this->data = $edit_data;
        extract($edit_data, EXTR_PREFIX_SAME, "dup");
        $page_title = "Editing <b>" . $title . "</b>";
        $display_show = 'photopreviewshow';
        $formType = "update";
        $button_label="update photo " . $edit_file_name;
        $button_archive_cancel = '<button class="btn-delete mt-32" id="deletePhoto" value="ARCHIVE">archive photo</button>';
        $id_field = '<input type="hidden" name="catalog_photo_id" value="' . $catalog_photo_id . '" />';
        $file_1_hidden = '<input type="hidden" name="file_1_hidden" value="' . $file_name . '.jpg" />';
        $file_2_hidden = '<input type="hidden" name="file_2_hidden" value="' . $file_name . '-thumb.jpg" />';
        $this->nav_label_catalog = "Update";
    } else {
        $formType = "insert";
        $button_label = "add new photo";
        $page_title = "Adding <b>New Catalog Photo</b>";
        $button_archive_cancel = '<a class="cancel-button mt-32" href="/studio/catalog">cancel</a>';
        $id_field = null;
        $file_1_hidden = null;
        $file_2_hidden = null;
        $created = date("Y-m-d H:i:s");
        $as_open = 0;
        $as_studio = 1;
        $as_tinyview = 0;
        $as_gallery = 0;
        $print_media = "paper";
        // $this->nav_label_catalog = "Adding Photo";
    }

    /* CATALOG INDEX */
    $navigation_html = $this->component('admin_navigation');

    /* CATEGORY INDEX */
    $category_data = $this->api_Admin_Get_Catalog_Categories();
    foreach($category_data as $key => $value) {

        if($value['catalog_category_id'] === $catalog_category_id) { 
            $selected = "SELECTED"; } 
        else { $selected = null; }

        if($value['type'] != strtoupper('collection')) {
            $category_html .= '<option ' . $selected . ' value="' . $value['catalog_category_id'] . '">' . $value['title'] . '</option>';
        } else {
            $category_html .= '<option ' . $selected . ' value="' . $value['catalog_category_id'] . '">[collection] ' . $value['title'] . '</option>';
        }
    }

    /* LOCATIONS INDEX */
    $location_data = $this->api_Admin_Get_Locations();

    foreach($location_data as $key => $value) {

        if($value['art_location_id'] === $on_display) { 
            $selected = "SELECTED"; } 
        else { $selected = null; }

        $location_html .= '<option ' . $selected . ' value="' . $value['art_location_id'] . '">' . $value['location'] . '</option>';
    }

?>