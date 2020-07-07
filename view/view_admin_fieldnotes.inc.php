 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* CATALOG INDEX */
    $this->nav_label_inventory = "New Field Note";
    $navigation_html = $this->component('admin_navigation');

     /* Get any notifications of errors */
    if($_SESSION['error'] == "200" && $_SESSION['notify_msg'] != '') {
        $notification_state = "show";
        $notification_msg = "<p class='heading'>success</p><p>" .  $_SESSION['notify_msg'] . " Has Been Updated</p>";
        $_SESSION['error'] = null;
        $_SESSION['notify_msg'] = null;
    }

    /* API - LIST OF PHOTOS IN CATALOG */
    $data_html = $this->api_Admin_Get_Fieldnotes();
    $active_fieldnotes_count = count($data_html);
        if( is_null($active_fieldnotes_count) ) {
            $active_fieldnotes_count = 0;
        }
    $data_json = json_encode($data_html);


?>