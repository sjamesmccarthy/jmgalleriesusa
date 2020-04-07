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
    
    $edit_id = $this->routes->URI->queryvals[1];

    $edit_data = $this->api_Admin_Get_Collector($edit_id);
    extract($edit_data, EXTR_PREFIX_ALL, "res");

    $artwork_data = $this->api_Admin_Get_Collector_Artwork($res_first_name, $res_last_name);
    $artwork_count = count($artwork_data);
    $data_json = json_encode($artwork_data);

    $user_data = $this->api_Admin_Get_Collector_UserAct($res_collector_id);
    $user_count = count($user_data);

    if($user_count >= 1) {
        $user_account_html = "<a href='/studio/users-add?id=" . $user_data['user_id'] . "'>User Account Active.</a> Last activity on " . date("F jS, Y", strtotime($user_data['created']));
    } else {
        $user_account_html = '<a href="/studio/users-add?e=' . $res_email . '&id=' . $res_collector_id . '">Activate User Account for this collector</a>';
    }

    $this->page->title = "Editing Collector Profile: <b>" . $res_first_name ." " . $res_last_name .  "</b>";
    $formTypeAction = "update";
    $button_label="update collector";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/collectors">cancel</a>';
    $id_field = '<input type="hidden" name="collector_id" value="' . $res_collector_id . '" />';
    $this->nav_label_inventory = "Updating Collector";
} else {
    $formTypeAction = "insert";
    $button_label = "add new collector profile";
    $this->page->title = "Adding <b>New Collector</b> Profile";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/collectors">cancel</a>';
    $this->nav_label_inventory = "Adding Collector Profile";
}

/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

?>