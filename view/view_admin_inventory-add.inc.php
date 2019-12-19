 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* Get Supplier_Materials */
    $supplier_materials_data = $this->api_Admin_Get_Inventory_Supplier_Materials();
    
        if( count($supplier_materials_data) > 0) {
            $materials_html .= "<option>--manual entry</option>";
            foreach( $supplier_materials_data as $key => $val) {
                $materials_html .= '<option value="' . $val['supplier_materials_id'] . '" ';
                $materials_html .= 'data-unit="' . $val['unit_type'] . '" ';
                $materials_html .= 'data-inv="' . $val['quantity_bought'] . '"';
                $materials_html .= 'data-cost="' . $val['cost'] . '">';
                $materials_html .= $val['material_type'] . ", " . $val['material_desc'] . ', (' . $val['supplier'] . ') [' . $val['unit_type'] . ']';
                $materials_html .= '</option>';
            }
    }

    /* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
    if(isSet($this->routes->URI->queryvals)) {

        $edit_id = $this->routes->URI->queryvals[1];
        
        $edit_data = $this->api_Admin_Get_Inventory_Item($edit_id);
        $this->data = $edit_data;
        extract($edit_data, EXTR_PREFIX_SAME, "dup");

        $coa_data = $this->api_Admin_Get_Inventory_COA($edit_id);
        $this->data['coa'] = $coa_data;

        if( count($this->data['coa']) > 0) {

            foreach( $this->data['coa'] as $key => $val) {
                $coa_html = "<div class='coa_list coa_list_found'><p class='coa-icon'><i class='fas fa-award'></i></p><p>" . $val['coa_first_name'] . " " . $val['coa_last_name'] . "<br />Certificate of Authenticity issued on " . date("F d, Y", strtotime($val['coa_purchase_date'])) . "</p></div>";
            }

        } else {
            $coa_html = "<p class='coa_list'>No COAs fround for this artwork, perhaps it hasn't been sold yet.</p>";
        }

        /* Costs for Art */
        $costs_data = $this->api_Admin_Get_Inventory_Item_Costs($edit_id);
        // $this->printp_r($costs_data);

        if($this->api['table'] == 'art_costs') {
            if( count($costs_data > 0) ) {

                $x=1;
                foreach( $costs_data as $row => $vals ) {  
                    foreach( $costs_data[0] as $key => $val) {
                        $x++;
                        $costs_html .= '<div class="supplier_materials"><div class="AUTO_GENERATED-- manual-entry material_expense_supplier-' . $x . '-manual-entry half-size show"><input type="text" id="material_expense_supplier-' . $x . '-manual-entry" name="material_expense_supplier-' . $x . '-manual-entry" placeholder="MANUAL ENTRY" value="' . $key . '"></div> <input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_quantity-' . $x . '" name="material_quantity-' . $x . '" placeholder="QUANTITY" value="1" > <input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_cost-' . $x . '" name="material_cost-' . $x . '" placeholder="$" value="' . $val . '" ><span class="remove-add"><i data-exp="' . $x . '" class="fas fa-times"></i></span></div>';
                    } 
                }

            } else {
                $costs_html = "<p class=''>No costs found for this artwork. (tbl:" . $this->api['table'] . ")</p>";
            }
        } else {

            // $this->printp_r($costs_data);

            $x=1;
// outer loop for the cost_data
foreach( $costs_data as $key_sc => $val_sc) {

            $costs_html .= '<div class="supplier_materials"><div class="material_expense_supplier-' . $x . '-container material_expense_supplier_container select-wrapper half-size">';
            $costs_html .= "<select attr=" . $x . " disabled>";
            // $costs_html .= "<option value='manual'>--- manual entry</option>";

            foreach( $supplier_materials_data as $key_a => $val_a) {
                    
                if($val_a['supplier_materials_id'] == $val_sc['supplier_materials_id']) { $SELECTED = 'SELECTED'; } else { $SELECTED = null; }

                $materials_html_a .= '<option ' . $SELECTED . ' value="' . $val_a['supplier_materials_id'] . '" ';
                $materials_html_a .= 'data-unit="' . $val_a['unit_type'] . '" ';
                $materials_html_a .= 'data-inv="' . $val_a['quantity_bought'] . '"';
                $materials_html_a .= 'data-cost="' . $val_a['cost'] . '">';
                $materials_html_a .= $val_a['material_type'] . ", " . $val_a['material_desc'] . ', (' . $val_a['supplier'] . ') [' . $val_a['unit_type'] . ']';
                $materials_html_a .= '</option>';
                }
            $costs_html .= $materials_html_a;
            $costs_html .= "</select>";
            $costs_html .= "</div>";

            $costs_html .= '<input disabled data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_quantity-' . $x . '" name="material_quantity-' . $x . '" placeholder="QUANTITY" value="' . $val_sc['material_used'] . '"> <input disabled data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_cost-' . $x . '" name="material_cost-' . $x . '" placeholder="$" value="' . $val_sc['calcd_cost'] . '" ><span class="remove-add"><i data-exp="' . $x . '" class="fas fa-times"></i></span></div>';
            $x++;
            $materials_html_a = null;
        }
    }
        
        $page_title = "Editing <b>" . $title . "</b>, record  " . $edit_id;
        $formTypeAction = "update";
        $button_label="update artwork: " . $title;
        $button_archive_cancel = '<a class="cancel-button" href="/studio/inventory">cancel</a>';
        $id_field = '<input type="hidden" name="art_id" value="' . $art_id . '" />';
        $this->nav_label_inventory = "Updating Artwork";
    } else {
        $formTypeAction = "insert";
        $button_label = "add new artwork";
        $page_title = "Adding <b>New Artwork</b> to Inventory";
        $button_archive_cancel = '<a class="cancel-button" href="/studio/inventory">cancel</a>';
        $this->nav_label_inventory = "Adding Artwork";
    }

    /* CATALOG INDEX */
    $navigation_html = $this->component('admin_navigation');


    /* LOCATIONS INDEX */
    $location_data = $this->api_Admin_Get_Locations('all');

    foreach($location_data as $key_loc => $val_loc) {

        // if($val_loc['art_location_id'] === $on_display) { 
        //     $selected = "SELECTED"; } 
        // else { $selected = null; }

        $location_html .= '<option ' . $selected . ' value="' . $val_loc['art_location_id'] . '">' . $val_loc['location'] . '</option>';
    }


?>