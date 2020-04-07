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
        
        $supplier_id = $this->routes->URI->queryvals[1];

        $edit_data = $this->api_Admin_Get_Suppliers_Item($supplier_id);
        extract($edit_data, EXTR_PREFIX_ALL, "res");

        $material_data = $this->api_Admin_Get_Materials_By_Supplier($supplier_id);
        $active_materials_count = count($material_data);
        $data_json = json_encode($material_data);

        $this->page->title = "Editing Supplier: <b>" . $res_company . "</b>";
        $formTypeAction = "update";
        $button_label="update supplier info";
        // $button_archive_cancel = '<button class="btn-delete mt-32" id="archive" value="ARCHIVE">archive supplier</button>';
        $button_archive_cancel = '<a class="cancel-button" href="/studio/suppliers">cancel</a>';
        $id_field = '<input type="hidden" name="supplier_id" value="' . $res_supplier_id . '" />';
    } else {
        $formTypeAction = "insert";
        $button_label = "add new supplier";
        $legacy_exp_field = null;
        $this->page->title = "Adding <b>New Supplier</b>";
        $button_archive_cancel = '<a class="cancel-button" href="/studio/suppliers">cancel</a>';
    }

    /* NAVIGATION LOAD */
    $navigation_html = $this->component('admin_navigation');

?>