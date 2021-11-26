 <?php

    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

        /* What is this code block for again? Thu, 25 Nov 2021 */
        if(count($this->data->routePathQuery) > 2) {
            
            foreach($this->data->routePathQuery as $key => $val) {
                $params[] = explode('=', $val); // fastest but not best way to handle this
            }
        
            $title = $params[2][1];
            if($params[4][1] == 'tinyviews') {
                $edition_style = "OPEN";
            } else {
                $edition_style = "GALLERY";
            }
        
            $edition_num_max = $this->config->limited_edition_max;
            $print_size = $params[5][1];
            $print_media = "PAPER";
            $frame_desc = urldecode($params[6][1]);
            $listed = $params[7][1];
            $value = $params[8][1];
            $negative_file = $params[9][1];
            $acquired_from = "WEB ORDER";
            $purchase_date = urldecode($params[10][1]);
        
            // collector ID set below $params[3][1]
            $redirect_url = "<input type='hidden' name='orders_redirect' value='" . $params[0][1] . "' />";
            $redirect_url .= "<input type='hidden' name='product_order_id' value='" . $params[0][1] . "' />";
        
        
            unset($this->routes->URI->queryvals);
        } else {
            $redirect_url = null;
        }
        /* ****** */

    /* Get Supplier_Materials for drop select list */
    $supplier_materials_data = $this->api_Admin_Get_Inventory_Supplier_Materials();

        if( count($supplier_materials_data) > 0) {
            $materials_html .= "<option>--manual entry</option>";
            foreach( $supplier_materials_data as $key => $val) {

                // if($val['supplier_id'] != '18') {
                $materials_html .= '<option value="' . $val['supplier_materials_id'] . '" ';
                $materials_html .= 'data-unit="' . $val['unit_type'] . '" ';
                $materials_html .= 'data-inv="' . $val['quantity_bought'] . '"';
                $materials_html .= 'data-cost="' . $val['cost'] . '">';
                $materials_html .= $val['material_type'] . ", " . $val['material_desc'] . ', (' . $val['supplier'] . ') [' . $val['unit_type'] . ']';
                $materials_html .= '</option>';
                // }
            }
    }

    $coa_html = "<p class='coa_list'>No COAs were found for this artwork, perhaps it hasn't been sold yet.</p>";
    
    /* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
    if(isSet($this->routes->URI->queryvals)) {
        
        $edit_id = $this->routes->URI->queryvals[1];
        
        $edit_data = $this->api_Admin_Get_Inventory_Item($edit_id);
        extract($edit_data, EXTR_PREFIX_SAME, "dup");

        /* Fetch locations history data */
        $locationsHistory_data = $this->api_Admin_Get_Locations_History($edit_id);
        
        if($art_location_id == "3" || $art_location_id == "11" || $art_location_id == "9" || $art_location_id == "8") {
            // 3 = Sold (Collector) : 11 = Sold (non-collector)
            $btn_readonly = 'disabled';
            $disabled_hidden = 'disabled-hidden';
            $disabled_button_class = 'disabled-button-sold';
            $button_disabled_label = 'THIS RECORD CAN NO LONGER BE EDITED';
            $title_state = 'Sold';
        } else {
            $btn_readonly = null;
            $disabled_hidden = '';
            $disabled_button_class = '';
            $button_disabled_label = 'UPDATE ARTWORK';
            $title_state = 'Editing';
        }
        
        if( count($locationsHistory_data) > 0) {

            foreach( $locationsHistory_data as $key_lh => $val_lh) {

                if(isSet($val_lh['date_ended'])) {
                    $location_history_html .= "<p>" .  date("m/d/Y", strtotime($val_lh['date_started'])) . " thru " . date("m/d/Y", strtotime($val_lh['date_ended'])) . " @" . strtoupper($val_lh['location']) . "</p>";
                } else {
                    if($val_lh['location'] == "COLLECTOR") {
                        // $val_lh['location'] = $val_lh['location'] . ' (' . $val_lh['last_name'] . ')';
                    }
                    $location_history_html .= "<p><b>Currently @" . $val_lh['location'] . " as of " . date("F d, Y", strtotime($val_lh['date_started'])) . "</b></p>";
                } 
            }

            $location_history = '<a class="view-lh" href="#">view location history</a><div class="lh_container">' . $location_history_html . '</div>';
        } 

        $edit_data['coa'] = $this->api_Admin_Get_Inventory_COA($edit_id);
        
        if($edition_style == "STUDIO" || $edition_style == "LIMITED") {
            $coa_css = '_show-container';    
        } else {
            $coa_css = null;
        }
        
        if( count($edit_data['coa']) > 0) {
        extract($edit_data['coa'][0], EXTR_PREFIX_SAME, "dup");

            foreach( $edit_data['coa'] as $key => $val) {
                $coa_html = "<div class='coa_list coa_list_found'><p class='coa-icon'><i class='fas fa-award'></i></p><p>" . $val['coa_first_name'] . " " . $val['coa_last_name'] . "<br />Certificate of Authenticity issued on " . date("F d, Y", strtotime($val['coa_purchase_date'])) . "</p></div>";
            }

        } else {
            // $coa_html = "<p class='coa_list'>No COAs were found for this artwork, perhaps it hasn't been sold yet.</p>";
        }

        /* Costs for Art */
        $costs_data = $this->api_Admin_Get_Inventory_Item_Costs($edit_id);
        
        if($this->api['table'] == 'art_costs') {
            
            $art_costs_supplier_id = null;
            $legacy_exp_field = '<input type="hidden" name="legacy_exp" value="' . $art_id . '" />';
            // $art_costs_supplier_id = 18;
            if( count($costs_data > 0) ) {

                $x=1;
                foreach( $costs_data as $row => $vals ) {  
                    foreach( $costs_data[0] as $key => $val) {
                        $calcd_cost_html = $val + $calcd_cost_html;

                        $x++;
                        $costs_html .= '<div class="supplier_materials"><div class="AUTO_GENERATED-- manual-entry material_expense_supplier-' . $x . '-manual-entry two-thirds show"><label for="material-expense">MATERIAL EXPENSE (tbl: art_costs)</label>
                        <input type="hidden" id="hidden-material_expense_supplierid_manual-entry" name="hidden-material_expense_supplierid_manual-entry[]" placeholder="MANUAL ENTRY" value="' . $art_costs_supplier_id . '">
                        <input type="text" id="material_expense_supplier-' . $x . '_manual-entry" name="material_expense_supplier_manual-entry[]" placeholder="MANUAL ENTRY" value="' . ucwords('legacy ' . $key) . '" ' . $btn_readonly . '></div><label class="ml-1" for="material-quantity">QUANTITY</label> <input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_quantity-' . $x . '" name="material_quantity_manual-entry[]" placeholder="QUANTITY" value="1" ' . $btn_readonly . ' ><label class="ml-1" for="material-cost">COST</label><input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_cost-' . $x . '" name="material_cost_manual-entry[]" placeholder="" value="' . $val . ' " ' . $btn_readonly . '><span class="remove-add ' . $disabled_hidden .  '"><i data-exp="' . $x . '" class="fas fa-times"></i></span></div>';
                    } 
                }

            } else {
                $costs_html = "<p class=''>No costs found for this artwork. (tbl:" . $this->api['table'] . ")</p>";
            }
        } else {

        $x=1;
        
        // outer loop for the cost_data
        foreach( $costs_data as $key_sc => $val_sc) {
            
            $calcd_cost_html = $val_sc['calcd_cost'] + $calcd_cost_html;

            if($val_sc['manual_entry'] == "TRUE") {

                // REMOVED calcd_cost to cost --check sql and API(api_Admin_Get_Inventory_Item_Costs)
                $manual_entries = '<div class="supplier_materials"><div class="AUTO_GENERATED-- manual-entry material_expense_supplier-' . $x . '-manual-entry two-thirds  show"><label for="material-expense">MATERIAL EXPENSE (tbl: art_costs_supplier)</label>
                <input type="hidden" id="hidden-material_expense_supplierid_manual-entry" name="hidden-material_expense_supplierid_manual-entry[]" placeholder="MANUAL ENTRY" value="' . $val_sc['supplier_materials_id'] . '">
                <input type="text" id="material_expense_supplier-' . $x . '_manual-entry" name="material_expense_supplier_manual-entry[]" placeholder="MANUAL ENTRY" value="' . ucwords($val_sc['material_desc']) . '" ' . $btn_readonly . '></div><label class="ml-1" for="material-quantity">QUANTITY</label> <input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_quantity-' . $x . '" name="material_quantity_manual-entry[]" placeholder="QUANTITY" value="' . $val_sc['material_used'] . '" ' . $btn_readonly . '><label class="ml-1" for="material-cost">COST</label><input data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_cost-' . $x . '" name="material_cost_manual-entry[]" placeholder="" value="' . $val_sc['cost'] . '" ' . $btn_readonly . '><span class="remove-add ' . $disabled_hidden . '" data-supid="' . $x . '"><i data-exp="' . $x . '" class="fas fa-times"></i></span></div>'; 

            } else { 

                /* MODIFIED THIS on 1/22/20 by adding "id" to the _name_ in select element */
                $costs_html .= '<div class="supplier_materials"><div class="material_expense_supplier-' . $x . '-container material_expense_supplier_container select-wrapper two-thirds">';
                $costs_html .= '<label for="material-expense">MATERIAL EXPENSE (else)</label>';
                $costs_html .= "<select id='material_expense_supplierid-" . $x . "' name='material_expense_supplier_id[]' attr=" . $x . " ' . $btn_readonly . '>";
                
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
                $costs_html .= '<input  data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_quantity-' . $x . '" name="material_quantity[]" placeholder="QUANTITY" value="' . $val_sc['material_used'] . '"' . $btn_readonly . '>';
                $costs_html .= '<label for="material-cost">COST</label>';
                $costs_html .= '<input  data-exp="' . $x . '" class="width-auto material_quan" type="text" id="material_cost-' . $x . '" name="material_cost[]" placeholder="" value="' . $val_sc['cost'] . '"  ' . $btn_readonly . '><span class="remove-add ' . $disabled_hidden . '"><i data-exp="' . $x . '" class="fas fa-times"></i></span></div>';
            }
                
            $costs_html .= $manual_entries;

            $x++;
            $materials_html_a = null;
            $manual_entries = null;
        }
    }
        $this->page->title = $title_state . " Art: <b>" . $title . "</b> (" . $art_id . ")";
        $formTypeAction = "update";
        $button_label= $button_disabled_label;
        $button_archive_cancel = '<a class="cancel-button" href="/studio/inventory">CANCEL</a>';
        $id_field = '<input type="hidden" name="art_id" value="' . $art_id . '" />';
        $hidden_remove_manual_suppliers = '<input type="hidden" name="hidden_remove_manual_suppliers" id="hidden_remove_manual_suppliers" />';
        $this->nav_label_inventory = "Updating Artwork";
        if($edit_data['reg_num'] == "" ) { $reg_num = strtotime($edit_data['born_date']); }
        $born_date = date("Y-m-d H:i:s", strtotime($edit_data['born_date']));

        $secret = "{$serial_num}-{$reg_num}-{$negative_file}";
        $validation_hash = hash("adler32", $secret, FALSE);

    } else {
        $formTypeAction = "insert";
        $button_label = "add new artwork";
        $legacy_exp_field = null;
        $this->page->title = "Adding <b>New Artwork</b> to Inventory";
        $button_archive_cancel = '<a class="cancel-button" href="/studio/inventory">cancel</a>';
        $this->nav_label_inventory = "Adding Artwork";
        $hidden_remove_manual_suppliers = null;
        $reg_num = time();
        $born_date = date("Y-m-d H:i:s", $reg_num);
    }

    /* CATALOG INDEX */
    $navigation_html = $this->component('admin_navigation');

    /* LOCATIONS INDEX */
    $location_data = $this->api_Admin_Get_Locations('all');
    
    $i=1;
    foreach($location_data as $key_loc => $val_loc) {
  
        /* If Editing an existing record */
        if($val_loc['art_location_id'] === $edit_data['art_location_id']) { 
            $selected = "SELECTED"; 
            $loc_idx = $i;
            $hidden_location_id = '<input type="hidden" name="state_location_id" id="state_location_id" value="' . $edit_data['art_location_id'] . '">';
            
            // if($val_loc['status'] == 'DISABLED') { 
            //     $disabled_location_hidden = '<input type="hidden" name="art_location" value="' . $edit_data['art_location_id'] . '" />';
            // }
        } 
        else { $selected = null; $btn_disabled = null; }
        
        if($val_loc['status'] == 'DISABLED') { 
            $disabled_label = '(DISABLED)'; 
            
            if($val_loc['art_location_id'] != $edit_data['art_location_id']) { 
                $disable_attr = 'disabled'; 
            } else {
                $disable_attr = null;
            }
            
        } else { 
            $disabled_label = null; 
            $disable_attr=null;
        }
        
        $location_html .= '<option ' . $selected . ' value="' . $val_loc['art_location_id'] . '" ' . $disable_attr . '>' . $disabled_label . ' ' . $val_loc['location']  . '</option>';
        $i++;
    }

    /* COLLECTORS INDEX */
    $collector_data = $this->api_Admin_Get_Collectors_List();

    foreach($collector_data as $key_col => $val_col) {

        /* If Editing an existing record */
        if($val_col['collector_id'] === $edit_data['coa'][0]['collector_id'] || $val_col['collector_id'] === $params[3][1]) { 
            $selected = "SELECTED"; 
            $hidden_collector_id = '<input type="hidden" name="state_collector_id" id="state_collector_id" value="' . $edit_data['coa'][0]['collector_id'] . '">';
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

    /* GET EDITIONS AND MAX EDITIONS */    
    $edition_styles_array = json_decode($this->config->edition_types, TRUE);
    
        $series_num = 0;
        $artist_proof = 0;
        
        $edition_menu = '<div class="select-wrapper half-size vtop">
                            <label for="edition-style">EDITION-STYLE: ' . $edition_style . '</label>
                            <select id="edition_style" name="edition_style"' . $btn_readonly . ' >
                            <option value="- - -" />- - - </option>';
        
        if(array_key_exists('open', $edition_styles_array)) { 
            $edition_desc = 'OPEN'; 
            if($edition_desc == $edition_style) { $selected = 'SELECTED'; } else { $selected = null; }
            $edition_menu .= '<option ' . $selected . ' data-max-ed="' . $edition_styles_array['open'] . '" value="OPEN">' . $edition_desc . ' Ed.</option>';
            $edition_max = $edition_styles_array['open'];
        }
        
        if(array_key_exists('studio', $edition_styles_array)) { 
            $edition_desc = 'STUDIO'; 
            if($edition_desc == $edition_style) { $selected = 'SELECTED'; } else { $selected = null; }
            $edition_menu .= '<option ' . $selected . ' data-max-ed="' . $edition_styles_array['studio'] . '" value="STUDIO">' . $edition_desc . ' Ed.</option>';
            $edition_max = $edition_styles_array['studio'];
        }
        
        if(array_key_exists('limited', $edition_styles_array)) { 
            $edition_desc = 'LIMITED'; 
            if($edition_desc == $edition_style) { $selected = 'SELECTED'; } else { $selected = null; }
            $edition_menu .= '<option ' . $selected . ' data-max-ed="' . $edition_styles_array['limited'] . '" value="LIMITED">' . $edition_desc . ' Ed.</option>';
            $edition_max = $edition_styles_array['limited'];
        }
        
        $edition_menu .= '</select>
                                </div>';
    
    /* Get Catalog IDs and names */
    $catalog_ids = $this->api_Admin_Get_Photo_Catalog('all');
    
    $catalog_ids_html = '<div class="select-wrapper half-size vtop">
    <label for="catalog_photo_id">Catalog Id</label>
    <select id="catalog_photo_id" name="catalog_photo_id">
    <option value="- - -" />- - - </option>';
    
    foreach ($catalog_ids as $catK => $catV) {
        if($catV['catalog_photo_id'] == $catalog_photo_id) { print "matchFound: " + $catV['catalog_photo_id']; $selected = 'SELECTED'; } else { $selected = null; }
        $catalog_ids_html .= '<option ' . $selected . ' value="' . $catV['catalog_photo_id'] . '">' . $catV['title'] . ' (' . $catV['catalog_photo_id'] . ')</option>';
    }
    
    $catalog_ids_html .= '</select>
    </div>';
?>