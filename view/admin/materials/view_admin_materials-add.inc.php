<?php

/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
} else {
    header('location:/studio/signin');
}

if($this->routes->URI->queryvals[0] == "ref") {
    $res_supplier_id = $this->routes->URI->queryvals[1];
    $redirect_url = "<input type='hidden' name='supplier_redirect' value='" . $res_supplier_id . "' />";
    unset($this->routes->URI->queryvals);
} else {
    $redirect_url = null;
}

/* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
if(isSet($this->routes->URI->queryvals)) {
    
    $edit_id = $this->routes->URI->queryvals[1];

    $edit_data = $this->api_Admin_Get_Materials_Item($edit_id);
    extract($edit_data, EXTR_PREFIX_ALL, "res");

    $this->page->title = "Editing Material: <b>" . $res_material . "</b>";
    $formTypeAction = "update";
    $button_label="update material";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/materials">cancel</a>';
    $id_field = '<input type="hidden" name="supplier_materials_id" value="' . $res_supplier_materials_id . '" />';

    if(isSet($this->data->routePathQuery[1])) {
        $params = explode('=',$this->data->routePathQuery[1]);
        $res_supplier_id = $params[1];
        $redirect_url = "<input type='hidden' name='supplier_redirect' value='" . $res_supplier_id . "' />";
    } else {
        $redirect_url = null;
    }

    // $this->nav_label_inventory = "Updating Material";
} else {
    $formTypeAction = "insert";
    $button_label = "add new material";
    $this->page->title = "Adding <b>New Material</b>";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/materials">cancel</a>';
    // $this->nav_label_inventory = "Adding Material";
}

/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

/* SUPPLIER INDEX */
$suppliers_data = $this->api_Admin_Get_Suppliers();

foreach($suppliers_data as $key => $value) {

    if($value['supplier_id'] == $res_supplier_id) { 
        $selected = "SELECTED"; } 
    else { $selected = null; }

    $suppliers_html .= '<option ' . $selected . ' value="' . $value['supplier_id'] . '">' . $value['company'] . '</option>';
    $selected = null;;
}

?>