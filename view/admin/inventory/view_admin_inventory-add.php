<section class="admin--catalog-add">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col inventory-add--container">

            <div class="admin-header">
                <h2><?= $this->page->title ?></h2>
                <p class="close-x"><i class="fas fa-times-circle"></i></p>
            </div>

            <!-- <h1><?= $formTitle ?></h1> -->

            <form id="catalog-add" action="/studio/api/update/inventory" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <?= $legacy_exp_field ?>
            <?= $hidden_location_id ?>
            <?= $hidden_collector_id ?>
            <?= $hidden_remove_manual_suppliers ?>
            <?= $redirect_url ?>

            <input type="hidden" id="created" name="created" value="<?= $created ?>" />
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <div class="select-wrapper half-size">
                    <label for="location">CURRENT LOCATION</label>
                    <select id="art_location" name="art_location" <?= $btn_readonly ?>>
                    <option value="0">Current Location ...</option>
                    <?= $location_html ?>
                    </select>
                </div>
                <div class="select-wrapper half-size vtop">
                    <label for="collector">COLLECTOR</label>
                    <select id="collector" name="collector" <?= $btn_readonly ?>>
                    <option value="0">No Collector for this piece</option>
                    <!-- <option value="0">(no collector for this piece)</option> -->
                    <optgroup label="--- COLLECTORS">
                        <?= $collector_html ?>
                    </optgroup>
                    </select>
                </div>
            </div>
            
            <div>
                <?= $location_history ?>
            </div>
            
            <div>
                <div class="half-size">
                <label for="title">TITLE</label>
                <input class="" maxlength="255" type="text" id="title" name="title" placeholder="TITLE" value="<?= $title ?>" <?= $btn_readonly ?> required>
                </div>
                
                <?= $edition_menu ?>
            </div>

                <input class="half-size" type="hidden" id="series_num" name="series_num" placeholder="SERIES NUMBER (eg 1, 2019)" value="<?= $series_num ?>" <?= $btn_readonly ?>>
                <input class="half-size"  type="hidden" id="artist_proof" name="artist_proof" placeholder="ARTIST PROOF (eg, AP1)" value="<?= $artist_proof ?>" <?= $btn_readonly ?>>

            <div>
                <label for="edition_num">EDITION NUM</label>
                <input class="half-size" type="text" id="edition_num" name="edition_num" placeholder="EDITION NO." value="<?= $edition_num ?>" <?= $btn_readonly ?>>
                <label for="edition_num_max">EDITION NUM MAX</label>
                <input class="half-size" type="hidden" id="edition_num_max" name="edition_num_max" value="<?= $edition_num_max ?>" />
                <input class="half-size" type="text" id="edition_num_max_display" name="edition_num_max_display" placeholder="EDITION NO. MAX" value="<?= $edition_num_max ?>"  disabled />
            </div>

            <div>
                <h6>About The Art</h6>

                <div>
                    <label for="print_size">PRINT SIZE</label>
                    <input class="half-size" type="text" id="print_size" name="print_size" placeholder="PRINT SIZE (eg, 16x24, 24x36)" value="<?= $print_size ?>" <?= $btn_readonly ?> required>
                    <label for="print_media">PRINT MEDIA</label>
                    <input class="half-size" type="text" id="print_media" name="print_media" placeholder="PRINT MEDIA (eg, Paper, Acrylic)" value="<?= $print_media ?>" <?= $btn_readonly ?> required>
                </div>

                <div>
                    <label for="frame_size">FRAME SIZE</label>
                    <input class="half-size" type="text" id="frame_size" name="frame_size" placeholder="FRAME SIZE (eg, 18x26, 28x40)" value="<?= $frame_size ?>" <?= $btn_readonly ?> >
                    <label for="frame_material">FRAME MATERIAL</label>
                    <input class="half-size" type="text" id="frame_material" name="frame_material" placeholder="FRAME MATERIAL (eg, Bass 530, Inset Wood/Metal)" value="<?= $frame_material ?>" <?= $btn_readonly ?> >
                </div>

                <div>
                    <label for="frame_desc">FRAME DESC</label>
                    <input type="text" id="frame_desc" name="frame_desc" placeholder="FRAME DESC (eg, PAINTED ASH, STAINED NATURAL)" value="<?= $frame_desc ?>" <?= $btn_readonly ?> >
                </div>

                <div>
                    <label for="list_price">LIST PRICE</label>
                    <input class="half-size" type="text" id="listed" name="listed" placeholder="LIST PRICE (eg, $240)" value="<?= $listed ?>" <?= $btn_readonly ?>>
                    <label for="value">VALUE/SOLD FOR</label>
                    <input class="half-size" type="text" id="value" name="value" placeholder="VALUE or SOLD PRICE (eg, $220)" value="<?= $value ?>" <?= $btn_readonly ?>>
                </div>

                 <div>
                <h6>Notes</h6>
                    <textarea id="notes" name="notes" <?= $btn_readonly ?>><?= $notes ?></textarea>
                </div>

                <div class="mt-16">
                    <label style="display:inline-block;" for="negative_file">NEGATIVE FILE (also used in validation hash algorithm)</label>
                     <input class="half-size" type="text" id="negative_file" name="negative_file" placeholder="NEGATIVE FILE (eg, PRETTY_PHOTO.jpg)" value="<?= $negative_file ?>" <?= $btn_readonly ?> required>
                     <?= $catalog_ids_html ?>
                </div>
                

            </div>

            <div class="coa--container <?= $coa_css ?>">
                <div>
                    <h6>Certificate of Authenticity Data</h6>
                </div>
    
                <div>
                    <label for="serial_num">SERIAL NUM</label>
                    <input class="half-size" type="text" id="serial_num" name="serial_num" placeholder="SERIAL NO. (eg, 251387)" value="<?= $serial_num ?>" <?= $btn_readonly ?>>
                    <label style="display:inline-block; margin-left: 0 !important;" for="reg_num">REG NUM (Validation Hash =  <?= $validation_hash ?>) algorithm in settings</label>
                    <input class="half-size" type="text" id="reg_num" name="reg_num" placeholder="Artwork Reg No. (eg, 1569069144 aka Born On Date)" value="<?= $reg_num ?>" <?= $btn_readonly ?>>
                </div>
    
                <!-- $show_collector_meta -->
                <div id="collector_meta">
                    <label for="title">Acquired From & Condition Notes</label>
                    <input class="half-size" maxlength="255" type="text" id="acquired_from" name="acquired_from" placeholder="Acquired From and Condition Notes" value="<?= $acquired_from ?>" <?= $btn_readonly ?>>
                    <label for="title">Acquired on Date</label>
                    <input class="half-size" maxlength="255" type="text" id="acquired_date" name="acquired_date" placeholder="Acquired on Date" value="<?= $purchase_date ?>" <?= $btn_readonly ?>>
                </div>
                
                <div><label for="born_date">BORN ON</label>
                    <input class="half-size" type="text" id="born_date" name="born_date" placeholder="BORN ON DATE (eg, 2019-12-14 02:23:10)" value="<?= $born_date ?>" <?= $btn_readonly ?> required>
                </div>
                
                <div>
                    <h6>Certificates Issued</h6>
                    <?= $coa_html ?>
                </div>
            </div>
            
            <?php ?>
            <div id="pl-summary">
                <h6 class="mt-16">P/L Summary</h6>
                <p>Total Costs = <?= $calcd_cost_html ?> / Sold Value = $<?= $value ?> / <u>PL = $<?= number_format( ($value - $calcd_cost_html), 2,'.',''); ?></u></p>
            </div>

            <div id="supplier_materials_wrapper" class="mt-32">
                
                <h6>Material Expenses</h6>
                <?= $costs_html ?>
                <p class="material-add <?= $disabled_hidden ?>"><i class="fas fa-plus-circle"></i></p> 
            </div>

            <button class="mt-32 w-50 <?= $disabled_button_class ?>" id="sendform" value="SEND" <?= $btn_readonly ?>><?= $button_label ?></button>
            <?= $button_archive_cancel ?>
            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){
        
    // if( $('#edition_style').val() == "STUDIO" || $('#edition_style').val() == "LIMITED" ) {
    //     $('.coa--container').show();
    // }
    
    $('.close-x').on("click", function() {
        window.location.href = '/studio/inventory';
    });

    $('.view-lh').on("click", function(e) {
        e.preventDefault();
        $('.lh_container').toggle();
    })
    
    $('#edition_style').on("change", function(e) {
        e.preventDefault();
        console.log( $(this).find(':selected').val() );
        $('#edition_num_max').val($(this).find(':selected').attr('data-max-ed'));
        $('#edition_num_max_display').val($(this).find(':selected').attr('data-max-ed'));
        
        if( $(this).find(':selected').val() == 'STUDIO' || $(this).find(':selected').val() == 'LIMITED' ) {
            $('.coa--container').show();
        } else {
            $('.coa--container').hide();
        }
    })

    $('#collector').on('change', function() {
        
        var ele = "#collector_meta";
        var ele_select = "#collector";
        var ele_location = "#art_location";

        if( $(ele_select).prop('selectedIndex') == 0) {
            $(ele).hide();
            if($(ele_location).prop('selectedIndex') == 3) {
                $(ele_location).val(0).change();
            } else {
                $(ele_location).val(<?= $loc_idx ?>).change();
            }
        } else {
            $(ele).show();
            $(ele + " >input").attr("required", true);
            $(ele_location).val(3).change();
        }

    });

    
    $(document).on('change', '#supplier_materials_wrapper select', function() {
        
        var data_exp = $(this).attr('data-exp');
        var container_class = '.material-supplier-' + data_exp + '-container';
        var container_class_manual = '.material_supplier-' + data_exp + '-container-manual-entry';
        var ele_id = 'select#' + $(this).prop('id');

        if( $(ele_id).prop('selectedIndex') == 1) {
           
            $(container_class_manual).show();
            $(ele_id).prop('selectedIndex','0');

            $(container_class).hide();
            $(container_class + " select").attr("disabled", true);
            $(container_class + " input").attr("disabled", true);
        } else {
            $(container_class_manual + " input").attr("disabled", true);
        }

    });

    $(document).on('blur', '.material_quan', function() { 
        var data_exp = $(this).attr('data-exp');
        var data_id = $(this).prop('id');
        var ele_m = $(this).prop('name');
        
        // check if it is a manual entry if no assign ele
        var ele = $('#material_expense_supplierid-' + data_exp); //material_expense_supplier-101 (101=data_exp)
        // var ele_m = $('#material_expense_supplier-' + data_exp + '_manual-entry'); //material_expense_supplier-8_manual-entry
        var data_quan = parseInt($('#material_quantity-' + data_exp).val());
        var data_inv = $(ele).find(':selected').attr('data-inv');
        var data_cost = $(ele).find(':selected').attr('data-cost');
        var data_cost_unit_math = (data_cost / data_inv) * data_quan;

        if(!isNaN(data_cost_unit_math)) {
            var data_cost_unit_math = (data_cost / data_inv) * data_quan;
            var data_cost_unit = data_cost_unit_math.toFixed(2);
            $('#material_cost-' + data_exp).val(data_cost_unit);
        }

        if(ele_m == "material_quantity_manual-entry[]") {
            console.log('found manual-entry-doMath() - ' + data_exp);
            var data_cost_unit_math = ( $('#material_cost-' + data_exp).val() * $('#material_quantity-' + data_exp).val() );
            var data_cost_unit = data_cost_unit_math.toFixed(2);
            console.log( 'material_cost-' + data_exp + ' = ' + $('#material_cost-' + data_exp).val() );
            $('#material_cost-' + data_exp).val(data_cost_unit);
        }

    });

    $(document).on('click', '.cancel-link', function() {
        
        var data_exp = $(this).attr('data-exp');
        var container_class = '.' + $(this).attr('data-field') + '-container';
        var ele_id = 'select#' + $(this).attr('data-field');
        var input_ele_id = '.' + $(this).attr('data-field') + '-manual-entry';

        $(container_class).show();
        $(input_ele_id).removeClass('show');
        $(ele_id).prop('selectedIndex','0');
    });

    var max_fields      = 300; //maximum input boxes allowed
	var wrapper   		= $("#supplier_materials_wrapper"); //Fields wrapper
	var add_button      = $(".material-add"); //Add button ID
	
    var x = 100; //initlal text box count
	$(wrapper).on("click",'.material-add', function(e){  
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div class="supplier_materials"><!-- manual entry container --><div class="material_supplier-' + x + '-container-manual-entry hide"><label for="material-expense">MATERIAL EXPENSE</label><div class="manual-entry material_expense_supplier-' + x + '-manual-entry two-thirds"><input type="hidden" id="hidden-material_expense_supplierid-' + x + '-manual-entry" name="hidden-material_expense_supplierid_manual-entry[]" value="0"><input type="text" id="material_expense_supplier' + x + '-manual-entry" name="material_expense_supplier_manual-entry[]" placeholder="MANUAL ENTRY" value=""></div><label class="ml-1" for="material-quantity">QUANTITY</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_quantity-' + x + '-manual-entry" name="material_quantity_manual-entry[]" placeholder="QUANTITY" value="0"><label class="ml-1" for="material-cost">COST</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_cost-' + x + '-manual-entry" name="material_cost_manual-entry[]" placeholder="" value="0.00" ><span class="remove-add" data-supid="' + x + '"><i data-exp="' + x + '" class="fas fa-times"></i></span></div><!-- /manual entry container --><!-- supplier row --><div class="material-supplier-' + x + '-container"><div class="material_expense_supplier-' + x + '-container material_expense_supplier_container select-wrapper two-thirds"><label for="material-expense">MATERIAL EXPENSE</label><select id="material_expense_supplierid-' + x + '" name="material_expense_supplier_id[]" data-exp="' + x + '"><option value="-">SELECT A MATERIAL EXPENSE</option><?= $materials_html ?></select></div> <label class="ml-1" for="material-quantity">QUANTITY</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_quantity-' + x + '" name="material_quantity[]" placeholder="QUANTITY" value=""><label for="material-cost" class="ml-1">COST</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_cost-' + x + '" name="material_cost[]" placeholder="" value="" ><span class="remove-add"><i data-exp="' + x + '" class="fas fa-times"></i></span></div><!-- /supplier row --></div>'); 
		}
    });
    
    $(wrapper).on("click",'.remove-add', function(e){ 
        e.preventDefault(); 
        $(this).parent('div').remove(); 
        var data_supid = $(this).attr('data-supid');
        var hidden_field_vals = $('#hidden_remove_manual_suppliers').val() + ',' + data_supid;
        $('#hidden_remove_manual_suppliers').val(hidden_field_vals);
        console.log($('#hidden_remove_manual_suppliers').val());
        x--;
	})

    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#sendform');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#catalog-add').submit();               
          } 
        });
    });

});

</script>