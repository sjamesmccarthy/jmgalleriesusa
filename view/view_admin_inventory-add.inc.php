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
        // $edit_file_name = $this->routes->URI->queryvals[1];
        // $edit_data = $this->api_Catalog_Photo($edit_file_name);
        // $this->data = $edit_data;
        // extract($edit_data, EXTR_PREFIX_SAME, "dup");
        $page_title = "Editing <b>" . $title . "</b>";
        // $display_show = 'photopreviewshow';
        // $formType = "update";
        $button_label="update artwork " . $edit_file_name;
        $button_archive_cancel = '<a class="cancel-button" href="/studio/inventory">cancel</a>';
        // $id_field = '<input type="hidden" name="catalog_photo_id" value="' . $catalog_photo_id . '" />';
        $this->nav_label_inventory = "Updating Artwork";
    } else {
        // $formType = "insert";
        $button_label = "add new artwork";
        $page_title = "Adding <b>New Artwork</b> to Inventory";
        $button_archive_cancel = '<a class="cancel-button" href="/studio/inventory">cancel</a>';
        // $id_field = null;
        // $created = date("Y-m-d H:i:s");
        // $as_open = 0;
        // $as_studio = 1;
        // $as_tinyview = 0;
        // $as_gallery = 0;
        // $print_media = "paper";
        $this->nav_label_inventory = "Adding Artwork";
    }

    /* CATALOG INDEX */
    $navigation_html = $this->component('admin_navigation');

     /* LOCATIONS INDEX */
    $location_data = $this->api_Admin_Get_Locations();

    foreach($location_data as $key => $value) {

        if($value['art_location_id'] === $on_display) { 
            $selected = "SELECTED"; } 
        else { $selected = null; }

        $location_html .= '<option ' . $selected . ' value="' . $value['art_location_id'] . '">' . $value['location'] . '</option>';
    }

?>