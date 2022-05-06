 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* CATALOG INDEX */
    $this->nav_label_inventory = "New Collector";
    $navigation_html = $this->component('admin_navigation');

    /* Get any notifications of errors */
    if($_SESSION['error'] == "200") {
        $notification_state = "show";
        $notification_msg = "<p class='heading'>success</p><p>" .  $_SESSION['notify_msg'] . " Has Been Updated</p>";
        $_SESSION['error'] = null;
        $_SESSION['notify_msg'] = null;
    }

    /* API - LIST OF PHOTOS IN CATALOG */
    $data_html = $this->api_Admin_Get_Collectors();
    $active_collectors_count = count($data_html);
    $data_json = json_encode($data_html);

    if(isSet($this->routes->URI->queryvals )) {
        $filter = $this->routes->URI->queryvals[1];
    } else {
        $filter = null;
    }

?>