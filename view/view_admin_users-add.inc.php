<?php

/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
} else {
    header('location:/studio/signin');
}

if(count($this->data->routePathQuery) == 2) {
    
    $username_query = explode('=', $this->data->routePathQuery[0]);
    $res_username = $username_query[1];
    
    $collector_id_query = explode('=', $this->data->routePathQuery[1]);
    $ac_id = $collector_id_query[1];
    
    unset($this->routes->URI->queryvals);
} 

/* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
if(isSet($this->routes->URI->queryvals)) {
    
    $edit_id = $this->routes->URI->queryvals[1];

    $edit_data = $this->api_Admin_Get_Users_Item($edit_id);
    extract($edit_data, EXTR_PREFIX_ALL, "res");

    if($res_type == "ARTIST") {
        $type_id = $id_field = '<input type="hidden" name="artist_id" value="' . $res_artist_id . '" />';
        $ac_id = $res_artist_id;
    } else {
        $type_id = $id_field = '<input type="hidden" name="collector_id" value="' . $res_collector_id . '" />';
        $ac_id = $res_collector_id;
    }

    $this->page->title = "Editing User: <b>" . $res_username. "</b>";
    $formTypeAction = "update";
    $button_label="update user";
    // $button_archive_cancel = '<button class="btn-delete mt-32" id="archive" value="ARCHIVE">archive supplier</button>';
    $button_archive_cancel = '<a class="cancel-button" href="/studio/users">cancel</a>';
    $id_field = '<input type="hidden" name="user_id" value="' . $res_user_id . '" />';
} else {
    $formTypeAction = "insert";
    $button_label = "add new user";
    $legacy_exp_field = null;
    $this->page->title = "Adding <b>New User</b>";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/users">cancel</a>';
}

/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

?>