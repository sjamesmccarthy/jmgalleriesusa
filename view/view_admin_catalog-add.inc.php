 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    $category_html = null;
    
     // Fetch all linked collections
    $category_data = $this->api_Admin_Get_Catalog_Categories();
    // print_r($category_data);
    
    /* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
    if(isSet($this->routes->URI->queryvals)) {
        $edit_id = $this->routes->URI->queryvals[1];

        $edit_data = $this->api_Catalog_Photo($edit_id);
        $this->data = $edit_data;
        extract($edit_data, EXTR_PREFIX_SAME, "dup");

        $available_sizes = htmlspecialchars($available_sizes);

        if($as_gallery == "1") {
            $previous_edition = "as_gallery";
            $edition_label = "LE";
        } 

        if($as_studio == "1") {
            $previous_edition = "as_studio";
            $edition_label = "LE";
        } 

        if($as_open == "1") {
            $previous_edition = "as_open";
            $edition_label = "OT";
        } 

        $collections_data = $this->api_Admin_Get_CollectionsByPhoto($catalog_photo_id, $parent_collections_id);
        if(!isSet($collections_data)) { $collections_html= '<i style="padding-right: 5px;" class="fas fa-link"></i> link other collections'; }
        
        foreach($category_data as $key_tag => $value_tag) {

            if($value_tag['catalog_collections_id'] === $parent_collections_id) { 
                 $collection_code = $value_tag['catalog_code'];
            } 
            
            foreach($collections_data as $key => $value) {
 
                    if($value_tag['catalog_collections_id'] == $value['catalog_collections_id']) {      
                        $collections_html .= '<i style="padding-right: 5px;" class="fas fa-link"></i>' . $value['title'] . '<br />';
                        $col_sel = 'SELECTED';
                    }

            }
            
            if($value_tag['catalog_collections_id'] != $edit_data['parent_collections_id']) {
                $collections_tag_options .= '<option ' . $col_sel . ' value="' . $value_tag['catalog_collections_id'] . '">' . $value_tag['title'] . '</option>';
                $col_sel = null;
                
            }
            
        }

        $page_title = "Editing <b>" . $collection_code .  $catalog_photo_id .  $edition_label . "_" . str_replace(" ", "-", strtoupper($title));
        $display_show = 'photopreviewshow';
        $formType = "update";
        $button_label="update photo " . $edit_file_name;
        $button_archive_cancel = '<button class="btn-delete mt-32 pull-right w-20" id="archive" value="ARCHIVE">archive photo</button>';
        $id_field = '<input type="hidden" name="catalog_photo_id" value="' . $catalog_photo_id . '" />';
        $file_1_hidden = '<input type="hidden" name="file_1_hidden" value="' . $file_name . '.jpg" />';
        $file_2_hidden = '<input type="hidden" name="file_2_hidden" value="' . $file_name . '-thumb.jpg" />';
        $this->nav_label_catalog = "Update";
    } else {

        // Collection Linking
        $collections_data = $this->api_Admin_Get_CollectionsByPhoto($catalog_photo_id, $parent_collections_id);
        if(!isSet($collections_data)) { $collections_html= '<i style="padding-right: 5px;" class="fas fa-link"></i> link other collections'; }

        foreach($category_data as $key_tag => $value_tag) {

            foreach($collections_data as $key => $value) {
               
                    if($value_tag['catalog_collections_id'] == $value['catalog_collections_id']) {      
                        $collections_html .= '<i style="padding-right: 5px;" class="fas fa-link"></i>' . $value['title'] . '<br />';
                        $col_sel = 'SELECTED';
                    }

            }
            
            if($value_tag['catalog_collections_id'] != $edit_data['parent_collections_id']) {
                $collections_tag_options .= '<option ' . $col_sel . ' value="' . $value_tag['catalog_collections_id'] . '">' . $value_tag['title'] . '</option>';
                $col_sel = null;
            }
        }

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
        $available_sizes = "in_code";
        // $this->nav_label_catalog = "Adding Photo";
    }

    /* CATALOG INDEX */
    $navigation_html = $this->component('admin_navigation');

    /* CATEGORY INDEX */
    // $category_data = $this->api_Admin_Get_Catalog_Categories();
    foreach($category_data as $key => $value) {

        if($value['catalog_collections_id'] === $parent_collections_id) { 
            $selected = "SELECTED"; }
        else { $selected = null; }

        if($value['type'] != strtoupper('collection')) {
            $category_html .= '<option ' . $selected . ' value="' . $value['catalog_collections_id'] . '">' . $value['title'] . '</option>';
        } else {
            $category_html .= '<option ' . $selected . ' value="' . $value['catalog_collections_id'] . '">[collection] ' . $value['title'] . '</option>';
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