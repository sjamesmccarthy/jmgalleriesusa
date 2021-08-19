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

    $user_roles = $this->api_Admin_Get_RolesByUser($edit_id);
    $user_apps = $this->api_Admin_Get_AppsByUser($edit_id);

    if($res_type == "ARTIST" || $res_type == "ADMIN") {
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
    $disabled = 'disabled';
} else {
    $formTypeAction = "insert";
    $button_label = "add new user";
    $legacy_exp_field = null;
    $this->page->title = "Adding <b>New User</b>";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/users">cancel</a>';
    $user_roles = null;
    $user_apps = null;
    $res_pin = 'HASH__md5([/username+pin/p])';
}

/* Get List of Apps */
$apps_list = $this->api_Admin_Get_Apps();

foreach ($apps_list AS $k_apps => $v_apps) {
    
    $apps_html .= '<li><input type="checkbox" id="apps-' . $v_apps['short_code'] . '" name="apps[]" value="' . $v_apps['user_apps_id'] . '"';
    
    if(isSet($edit_id)) {
        foreach ($user_apps as $ku_apps => $vu_apps) {
            if ($v_apps['user_apps_id'] == $vu_apps['user_apps_id']) {
                $apps_html .= "CHECKED";
            }
        }
    }

    $apps_html .= '/> 
   <label for="apps-' . $v_apps['short_code'] . '" style="font-size: 1.2rem; background-color: transparent;">' . $v_apps['title'] . '</label></li>';
}

/* Get List of User Roles */
$roles_list = $this->api_Admin_Get_Roles();

foreach ($roles_list AS $k_roles => $v_roles) {

    $roles_html .= '<li><input type="checkbox" id="role-' . $v_roles['role'] . '" name="role[]" value="' . $v_roles['user_role_id'] . '" ';

    if(isSet($edit_id)) {
        foreach ($user_roles as $ku_roles => $vu_roles) {
            if ($v_roles['user_role_id'] == $vu_roles['user_role_id']) {
                $roles_html .= "CHECKED";
            }
        }
    }
        $roles_html .= '/> 
        <label for="role-' . $v_roles['role'] . '" style="font-size: 1.2rem; background-color: transparent;">' . $v_roles['role'] . '</label></li>';

}

/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

?>