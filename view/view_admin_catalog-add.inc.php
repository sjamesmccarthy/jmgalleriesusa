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
    } else {
        $page_title = "Adding New Catalog Photo";
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

    $date = date(DATE_RFC2822);
    $button_label = "Add Photo To Catalog";
    $formType = "new";

    /* API - LIST OF PHOTOS IN CATALOG */
    $data_html = $this->api_Admin_Get_Photo_Catalog();
    $data_json = json_encode($data_html);

?>