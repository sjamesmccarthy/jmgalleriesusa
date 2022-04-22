<?php

/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
} else {
    header('location:/studio/signin');
}

if(count($this->data->routePathQuery) == 2) {
    
    $ref = explode('=', $this->data->routePathQuery[0]);
    $cust_id = $ref[1];
    
    $cust_data = $this->api_Admin_Get_Order_Customer($cust_id);
    extract($cust_data, EXTR_PREFIX_ALL, "res");    
    $name = explode(' ', $res_name);
    $res_first_name = $name[0];
    $res_last_name = $name[1];
    $res_postalcode = $res_postal_code;

    $order = explode('=', $this->data->routePathQuery[1]);
    $redirect_id = $order[1];
    $redirect_url = "<input type='hidden' name='orders_redirect' value='" . $redirect_id . "' />";

    unset($this->routes->URI->queryvals);
} else {
    $redirect_url = null;
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
    // $user_count = count($user_data);
    if(!is_null($user_data)) { $user_count = count($user_data); }

    $purchases = '<section id="purchases">
       
                <h4>Limited & Studio Edition Purchases (' . $artwork_count . ')</h4>
                    
                <table id="dataTableArtwork" class="display mt-16" style="width: 100% !important;">
                <thead>
                    <tr>
                        <th>title</th>
                        <th>size</th>
                        <th>serial_num</th>
                        <th>reg_num</th>
                        <th>purchase_date</th>
                        <th>value</th>
                    </tr>
                </thead>
                    <tbody></tbody>
                </table>
            </section>';

    if($user_count >= 1) {
        $clean_date = date("F j, Y \\a\\t h:m A T", strtotime($user_data['last_login']));
        $user_account_html = "<ul><li><a href='/studio/users-add?id=" . $user_data['user_id'] . "'>ACTIVE (" . $user_data['username'] . ")</a><br />&mdash; Last seen on " . $clean_date . " from " . $user_data['last_login_ip'] . "</li></ul>";
    } else {
        $user_account_html = '<ul><li><b class="text-red">INACTIVE</b> &mdash; <a href="/studio/users-add?e=' . $res_email . '&id=' . $res_collector_id . '&type=COLLECTOR">ACTIVATE USER ACCOUNT for this collector</a><li>';
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