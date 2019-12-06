 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* CATALOG INDEX */
    $navigation_html = $this->component('admin_navigation');

    /* CATEGORY INDEX */
    $category_data = $this->api_Admin_Get_Catalog_Categories();
    foreach($category_data as $key => $value) {
        if($value['type'] != strtoupper('collection')) {
            $category_html .= '<option value="' . $value['catalog_category_id'] . '">' . $value['title'] . '</option>';
        } else {
            $category_html .= '<option value="' . $value['catalog_category_id'] . '">[collection] ' . $value['title'] . '</option>';
        }
    }

    /* LOCATIONS INDEX */
    $location_data = $this->api_Admin_Get_Locations();

    foreach($location_data as $key => $value) {
        $location_html .= '<option value="' . $value['art_location_id'] . '">' . $value['location'] . '</option>';
    }

    $date = date(DATE_RFC2822);
    $button_label = "Add Photo To Catalog";
    $formType = "new";

    /* API - LIST OF PHOTOS IN CATALOG */
    $data_html = $this->api_Admin_Get_Photo_Catalog();
    $data_json = json_encode($data_html);

?>