 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* Get Supplier_Materials for drop select list */
    $supplier_materials_data = $this->api_Admin_Get_Inventory_Supplier_Materials();

        if( count($supplier_materials_data) > 0) {
            $materials_html .= "<option>--manual entry</option>";
            foreach( $supplier_materials_data as $key => $val) {

                if($val['supplier_id'] != '18') {
                $materials_html .= '<option value="' . $val['supplier_materials_id'] . '" ';
                $materials_html .= 'data-unit="' . $val['unit_type'] . '" ';
                $materials_html .= 'data-inv="' . $val['quantity_bought'] . '"';
                $materials_html .= 'data-cost="' . $val['cost'] . '">';
                $materials_html .= $val['material_type'] . ", " . $val['material_desc'] . ', (' . $val['supplier'] . ') [' . $val['unit_type'] . ']';
                $materials_html .= '</option>';
                }
            }
    }

    /* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
    if(isSet($this->routes->URI->queryvals)) {
        
        $edit_id = $this->routes->URI->queryvals[1];

        $edit_data = $this->api_Admin_Get_Inventory_Item($edit_id);
        extract($edit_data, EXTR_PREFIX_SAME, "dup");

        /* Fetch locations history data */
        $locationsHistory_data = $this->api_Admin_Get_Locations_History($edit_id);
        

        if( count($locationsHistory_data) > 0) {

            foreach( $locationsHistory_data as $key_lh => $val_lh) {

                if(isSet($val_lh['date_ended'])) {
                    $location_history_html .= "-" . strtoupper($val_lh['location']) . " from " . date("F d, Y", strtotime($val_lh['date_started'])) . " to " . date("F d, Y", strtotime($val_lh['date_ended'])) . "<br />";
                } else {
                    if($val_lh['location'] == "COLLECTOR") {
                        // $val_lh['location'] = $val_lh['location'] . ' (' . $val_lh['last_name'] . ')';
                    }
                    $location_history_html .= "<b>Currently located at " . $val_lh['location'] . " since " . date("F d, Y", strtotime($val_lh['date_started'])) . "</b><br />";
                } 
            }

            $location_history = '<a class="view-lh" href="#">view location history</a><div class="lh_container">' . $location_history_html . '</div>';
        } 

        $edit_data['coa'] = $this->api_Admin_Get_Inventory_COA($edit_id);
        extract($edit_data['coa'][0], EXTR_PREFIX_SAME, "dup");

        if( count($edit_data['coa']) > 0) {

                
            foreach( $edit_data['coa'] as $key => $val) {
                $coa_html = "<div class='coa_list coa_list_found'><p class='coa-icon'><i class='fas fa-award'></i></p><p>" . $val['coa_first_name'] . " " . $val['coa_last_name'] . "<br />Certificate of Authenticity issued on " . date("F d, Y", strtotime($val['coa_purchase_date'])) . "</p></div>";
            }

        } else {
            $coa_html = "<p class='coa_list'>No COAs were found for this artwork, perhaps it hasn't been sold yet.</p>";
        }

        /* Costs for Art */
        $costs_data = $this->api_Admin_Get_Inventory_Item_Costs($edit_id);
        
        if($this->api['table'] == 'art_costs') {
            $art_costs_supplier_id = 18;
            if( count($costs_data > 0) ) {

                $x=1;
                foreach( $costs_data as $row => $vals ) {  
                    foreach( $costs_data[0] as $key => $val) {
                        $x++;
                        $costs_html .= '<div class="supplier_materials"><div class="AUTO_GENERATED-- manual-entry material_expense_supplier-' . $x . '-manual-entry half-size show"><label for="material-expense">MATERIAL EXPENSE</label>
                        <input type="hidden" id="hidden-material_expense_supplierid_manual-entry" name="hidden-material_expense_supplierid_manual-entry[]" placeholder="MANUAL ENTRY" value="' . $art_costs_supplier_id . '">
                        <input type="text" id="material_expense_supplier-' . $x . '_manual-entry" name="material_expense_supplier_manual-entry[]" placeholder="MANUAL ENTRY" value="' . ucwords('legacy ' . $key) . '"></div><label class="ml-1" for="material-quantity">QUANTITY</label> <input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_quantity-' . $x . '" name="material_quantity_manual-entry[]" placeholder="QUANTITY" value="1" ><label class="ml-1" for="material-cost">COST</label><input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_cost-' . $x . '" name="material_cost_manual-entry[]" placeholder="" value="' . $val . '" ><span class="remove-add"><i data-exp="' . $x . '" class="fas fa-times"></i></span></div>';
                    } 
                }

            } else {
                $costs_html = "<p class=''>No costs found for this artwork. (tbl:" . $this->api['table'] . ")</p>";
            }
        } else {

        $x=1;
        
        // outer loop for the cost_data
        foreach( $costs_data as $key_sc => $val_sc) {

            // $costs_html .= "<option value='manual'>--- manual entry</option>";
            
            if($val_sc['manual_entry'] == "TRUE") {

                // $manual_entries = "MANUAL ENTRY for supplier_materials_id: " . $val_sc['supplier_materials_id'];
                // $manual_entries .= " for supply item: ". $val_sc['material_desc'];
                // $manual_entries .= "  with a cost of  $". $val_sc['calcd_cost'];
                // $manual_entries .= "  " . $val_sc['unit_type'];
                // $manual_entries .= "<hr />";

                $manual_entries = '<div class="supplier_materials"><div class="AUTO_GENERATED-- manual-entry material_expense_supplier-' . $x . '-manual-entry half-size show"><label for="material-expense">MATERIAL EXPENSE</label>
                <input type="hidden" id="hidden-material_expense_supplierid_manual-entry" name="hidden-material_expense_supplierid_manual-entry[]" placeholder="MANUAL ENTRY" value="' . $val_sc['supplier_materials_id'] . '">
                <input type="text" id="material_expense_supplier-' . $x . '_manual-entry" name="material_expense_supplier_manual-entry[]" placeholder="MANUAL ENTRY" value="' . ucwords($val_sc['material_desc']) . '"></div><label class="ml-1" for="material-quantity">QUANTITY</label> <input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_quantity-' . $x . '" name="material_quantity_manual-entry[]" placeholder="QUANTITY" value="' . $val_sc['material_used'] . '" ><label class="ml-1" for="material-cost">COST</label><input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_cost-' . $x . '" name="material_cost_manual-entry[]" placeholder="" value="' . $val_sc['calcd_cost'] . '" ><span class="remove-add"><i data-exp="' . $x . '" class="fas fa-times"></i></span></div>'; 

            } else { 

                /* MODIFIED THIS on 1/22/20 by adding "id" to the _name_ in select element */
                $costs_html .= '<div class="supplier_materials"><div class="material_expense_supplier-' . $x . '-container material_expense_supplier_container select-wrapper half-size">';
                $costs_html .= '<label for="material-expense">MATERIAL EXPENSE</label>';
                $costs_html .= "<select id='material_expense_supplierid-" . $x . "' name='material_expense_supplierid[]' attr=" . $x . " >";
                
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
                
                $costs_html .= '<label class="ml-1" for="material-quantity">QUANTITY</label>';
                $costs_html .= '<input  data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_quantity-' . $x . '" name="material_quantity[]" placeholder="QUANTITY" value="' . $val_sc['material_used'] . '">';
                $costs_html .= '<label for="material-cost">COST</label>';
                $costs_html .= '<input  data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_cost-' . $x . '" name="material_cost[]" placeholder="" value="' . $val_sc['calcd_cost'] . '" ><span class="remove-add"><i data-exp="' . $x . '" class="fas fa-times"></i></span></div>';
            }
                
            $costs_html .= $manual_entries;

            $x++;
            $materials_html_a = null;
            $manual_entries = null;
        }
    }
        $this->page->title = "Editing <b>" . $title . "</b> finished artwork.";
        $formTypeAction = "update";
        $button_label="update artwork: " . $title;
        $button_archive_cancel = '<a class="cancel-button" href="/studio/inventory">cancel</a>';
        $id_field = '<input type="hidden" name="art_id" value="' . $art_id . '" />';
        $this->nav_label_inventory = "Updating Artwork";
        if($edit_data['reg_num'] == "" ) { $reg_num = strtotime($edit_data['born_date']); }
        $born_date = date("Y-m-d H:i:s", strtotime($edit_data['born_date']));
    } else {
        $formTypeAction = "insert";
        $button_label = "add new artwork";
        $this->page->title = "Adding <b>New Artwork</b> to Inventory";
        $button_archive_cancel = '<a class="cancel-button" href="/studio/inventory">cancel</a>';
        $this->nav_label_inventory = "Adding Artwork";
        $reg_num = time();
        $born_date = date("Y-m-d H:i:s", $reg_num);
    }

    /* CATALOG INDEX */
    $navigation_html = $this->component('admin_navigation');

    /* LOCATIONS INDEX */
    $location_data = $this->api_Admin_Get_Locations('all');
    
    // $this->printp_r($edit_data);
    $i=1;
    foreach($location_data as $key_loc => $val_loc) {

        /* If Editing an existing record */
        if($val_loc['art_location_id'] === $edit_data['art_location_id']) { 
            $selected = "SELECTED"; 
            $loc_idx = $i;
            $hidden_location_id = '<input type="hidden" name="state_location_id" id="state_location_id" value="' . $edit_data['art_location_id'] . '">';
        } 
        else { $selected = null; }

        $location_html .= '<option ' . $selected . ' value="' . $val_loc['art_location_id'] . '">' . $val_loc['location'] . '</option>';
        $i++;
    }

    /* COLLECTORS INDEX */
    $collector_data = $this->api_Admin_Get_Collectors_List();

    foreach($collector_data as $key_col => $val_col) {

        /* If Editing an existing record */
        if($val_col['collector_id'] === $collector_id) { 
            $selected = "SELECTED"; 
            $hidden_collector_id = '<input type="hidden" name="state_collector_id" id="state_collector_id" value="' . $collector_id . '">';
            $show_collector_meta = "show";
        } 
        else { $selected = null; }

        if(!empty($val_col['company']) ) {
            $company = $val_col['company'];
                if( !empty($val_col['first_name']) ) { 
                    $company = ' (' . $val_col['company'] . ')';
                }
        } else {
            $company = null;
        }

        $collector_html .= '<option ' . $selected . ' value="' . $val_col['collector_id'] . '">' . $val_col['first_name'] . ' ' . $val_col['last_name'] .  $company . '</option>';
    }

?>