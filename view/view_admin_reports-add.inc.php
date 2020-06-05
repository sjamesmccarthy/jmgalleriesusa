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

    $edit_data = $this->api_Admin_Get_Reports_Item($edit_id);
    extract($edit_data, EXTR_PREFIX_ALL, "res");

    $this->page->title = "/r  <b>" . $res_name . "</b>";
    $formTypeAction = "update";
    $button_label="save report";
    // $button_archive_cancel = '<button class="btn-delete mt-32" id="archive" value="ARCHIVE">archive supplier</button>';
    $button_archive_cancel = '<a class="cancel-button" href="/studio/reports">cancel</a>';
    $id_field = '<input type="hidden" name="report_id" value="' . $res_report_id . '" />';
} else {
    $formTypeAction = "insert";
    $button_label = "add new report";
    $legacy_exp_field = null;
    $this->page->title = "Adding <b>New Report / SQL Mark</b>";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/reports">cancel</a>';
}

/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

?>