<?php

/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
} else {
    header('location:/studio/signin');
}

 /* Get any notifications of errors */
    if($_SESSION['error'] == "200") {
        $notification_state = "show";
        $notification_msg = $_SESSION['notification_msg'];
        $_SESSION['error'] = null;
        $_SESSION['notify_msg'] = null;
    }

/* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
if(isSet($this->routes->URI->queryvals)) {
    
    foreach($this->data->routePathQuery as $key => $val) {
        $params[] = explode('=', $val); // fastest but not best way to handle this
    }

    // $edit_id = $this->routes->URI->queryvals[1];
    // modified 6/10/20 for result tab implementation, not best solution
    $edit_id = $params[0][1];

    $edit_data = $this->api_Admin_Get_Reports_Item($edit_id);
    extract($edit_data, EXTR_PREFIX_ALL, "res");

    $this->page->title = "/r  <b>" . $res_name . "</b>";
    $formTypeAction = "update";
    $button_label="save report";
    $button_state = ""; //noshow
    // $button_archive_cancel = '<button class="btn-delete mt-32" id="archive" value="ARCHIVE">archive supplier</button>';
    $button_archive_cancel = '<a class="cancel-button" href="/studio/reports">cancel</a>';
    $id_field = '<input type="hidden" name="report_id" value="' . $res_report_id . '" />';
} else {
    $formTypeAction = "insert";
    $button_label = "add new report";
    $button_state = "show";
    $legacy_exp_field = null;
    $this->page->title = "Adding <b>New Report / SQL Mark</b>";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/reports">cancel</a>';
}

/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

 if(isSet($this->routes->URI->queryvals )) {
    $filter ='RESULT';
    $form_result_state = "show";
    $form_sql_state = "noshow";
    $active_filter = null;
    $result = $this->api_Admin_Get_Reports_Sql($res_sql);
    $result_json = json_encode($result);
    $columns = array_keys($result[0]);

    foreach ($columns as $key => $val) {
        $table_keys .= "<th>" . $val . "</th>";
        $dataTableColumns .= "{ data:'" . $val . "'},"; 
    }

    $dataTableColumns = rtrim($dataTableColumns, ",");
    
} else {
    $filter = null;
    $form_result_state = "noshow";
    $form_sql_state = "show";
    $active_filter = 'active';
}

?>