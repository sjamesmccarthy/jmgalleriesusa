 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* CATALOG INDEX */
    $this->nav_label_inventory = "New Artwork";
    $navigation_html = $this->component('admin_navigation');

    /* Get any notifications of errors */
    if($_SESSION['error'] == "200" && $_SESSION['notify_msg'] != '') {
        $notification_state = "show success";
        $notification_msg = "<p class='heading'>success</p><p>" .  $_SESSION['notify_msg'] . " Has Been Updated</p>";
        $_SESSION['error'] = null;
        $_SESSION['notify_msg'] = null;
    } 
    
    if($_SESSION['error'] == "400" && $_SESSION['notify_msg'] != '') {
        $notification_state = "show error";
        $notification_msg = "<p class='heading'>FAILURE</p><p>" .  $_SESSION['notify_msg'] . "</p>";
        $_SESSION['error'] = null;
        $_SESSION['notify_msg'] = null;
    } 

    /* API - LIST OF PHOTOS IN CATALOG */
    $data_html = $this->api_Admin_Get_Inventory();

    /* TODO: include cost of inventory, will need a separate function fun */
    $active_inventory_count = count($data_html);
    $total_inventory_count = $this->mysqli->affected_rows;
    $data_json = json_encode($data_html);

    /* Set default filters */
    if(isSet($this->routes->URI->queryvals )) {
        $filter = $this->routes->URI->queryvals[1];
        $active_filter = null;
    } else {
        // $filter = null;
        $filter = 'STUDIO';
    }

?>
