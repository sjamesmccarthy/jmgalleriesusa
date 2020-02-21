<section class="admin--catalog-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 inventory-add--container">

            <h2 class="pb-32"><?= $this->page->title ?></h2>

            <h1><?= $formTitle ?></h1>

            <form id="catalog-add" action="/studio/api/update/inventory" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <?= $hidden_location_id ?>
            <?= $hidden_collector_id ?>
            <input type="hidden" id="created" name="created" value="<?= $created ?>" />
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <div class="select-wrapper half-size">
                    <label for="location">CURRENT LOCATION</label>
                    <select id="art_location" name="art_location">
                    <option value="0">Current Location ...</option>
                    <?= $location_html ?>
                    </select>
                    
                    <?= $location_history ?>

                </div>
                <div class="select-wrapper half-size vtop">
                    <label for="collector">COLLECTOR</label>
                    <select id="collector" name="collector">
                    <option value="0">(no collector for this piece)</option>
                        <?= $collector_html ?>
                    </select>
                </div>
            </div>

            <div id="collector_meta" class="<?= $show_collector_meta ?> hide">
                <label for="title">Acquired From & Condition Notes</label>
                <input class="half-size" maxlength="255" type="text" id="acquired_from" name="acquired_from" placeholder="Acquired From and Condition Notes" value="<?= $acquired_from ?>">
                <label for="title">Acquired on Date</label>
                <input class="half-size" maxlength="255" type="text" id="acquired_date" name="acquired_date" placeholder="Acquired on Date" value="<?= $purchase_date ?>">
            </div>

            <div>
                <label for="title">TITLE</label>
                <input class="half-size" maxlength="255" type="text" id="title" name="title" placeholder="TITLE" value="<?= $title ?>" required>
                <label for="edition-style">EDITION-STYLE</label>
                <input class="half-size" maxlength="255" type="text" id="edition_style" name="edition_style" placeholder="EDITION STYLE (eg. Gallery, Studio, Open)" value="<?= $edition_style ?>" required>
            </div>

            <div>
                <label for="artist_proof">ARTIST PROOF</label>
                <input class="half-size"  type="text" id="artist_proof" name="artist_proof" placeholder="ARTIST PROOF (eg, AP1)" value="<?= $artist_proof ?>" required>
                <label for="series_num">SERIES NUM</label>
                <input class="half-size" type="text" id="series_num" name="series_num" placeholder="SERIES NUMBER (eg 1, 2019)" value="<?= $series_num ?>">
            </div>
            <div>
                <label for="edition_num">EDITION NUM</label>
                <input class="half-size" type="text" id="edition_num" name="edition_num" placeholder="EDITION NO." value="<?= $edition_num ?>" required>
                <label for="edition_num_max">EDITION NUM MAX</label>
                <input class="half-size" type="text" id="edition_num_max" name="edition_num_max" placeholder="EDITION NO. MAX" value="<?= $edition_num_max ?>" required>
            </div>

            <div>
                <h6>About The Art</h6>

                <div>
                    <label for="print_size">PRINT SIZE</label>
                    <input class="half-size" type="text" id="print_size" name="print_size" placeholder="PRINT SIZE (eg, 16x24, 24x36)" value="<?= $print_size ?>" required>
                    <label for="print_media">PRINT MEDIA</label>
                    <input class="half-size" type="text" id="print_media" name="print_media" placeholder="PRINT MEDIA (eg, Paper, Acrylic)" value="<?= $print_media ?>" required>
                </div>

                <div>
                    <label for="frame_size">FRAME SIZE</label>
                    <input class="half-size" type="text" id="frame_size" name="frame_size" placeholder="FRAME SIZE (eg, 18x26, 28x40)" value="<?= $frame_size ?>" required>
                    <label for="frame_material">FRAME MATERIAL</label>
                    <input class="half-size" type="text" id="frame_material" name="frame_material" placeholder="FRAME MATERIAL (eg, Bass 530, Inset Wood/Metal)" value="<?= $frame_material ?>" required>
                </div>

                <div>
                    <label for="frame_desc">FRAME DESC</label>
                    <input type="text" id="frame_desc" name="frame_desc" placeholder="FRAME DESC (eg, PAINTED ASH, STAINED NATURAL)" value="<?= $frame_desc ?>" required>
                </div>

                <div>
                    <label for="list_price">LIST PRICE</label>
                    <input class="half-size" type="text" id="listed" name="listed" placeholder="LIST PRICE (eg, $240)" value="<?= $listed ?>">
                    <label for="value">VALUE/SOLD FOR</label>
                    <input class="half-size" type="text" id="value" name="value" placeholder="VALUE or SOLD PRICE (eg, $220)" value="<?= $value ?>">
                </div>

                 <div>
                <h6>Notes</h6>
                    <textarea id="notes" name="notes"><?= $notes ?></textarea>
                </div>

            </div>

            <div>
                <h6>Certificate of Authenticity Data</h6>
            </div>

            <div>
                <label for="serial_num">SERIAL NUM</label>
                <input class="half-size" type="text" id="serial_num" name="serial_num" placeholder="SERIAL NO. (eg, 251387)" value="<?= $serial_num ?>">
                <label for="reg_num">REG NUM</label>
                <input class="half-size" type="text" id="reg_num" name="reg_num" placeholder="Artwork Reg No. (eg, 1569069144 aka Born On Date)" value="<?= $reg_num ?>">
            </div>
            
            <div>
                <label for="negative_file">NEGATIVE FILE</label>
                 <input class="half-size" type="text" id="negative_file" name="negative_file" placeholder="NEGATIVE FILE (eg, PRETTY_PHOTO.jpg)" value="<?= $negative_file ?>" required>
                 <label for="born_date">BORN ON</label>
                 <input class="half-size" type="text" id="born_date" name="born_date" placeholder="BORN ON DATE (eg, 2019-12-14 02:23:10)" value="<?= $born_date ?>" required>
            </div>

            <div>
                <h6>Certificates Issued</h6>
                <?= $coa_html ?>
            </div>
            
            <div id="supplier_materials_wrapper" class="mt-32">
                
                <h6>Material Expenses</h6>
                <?= $costs_html ?>
                <p class="material-add"><i class="fas fa-plus-circle"></i></p> 
            </div>

            <button class="mt-32" id="sendform" value="SEND"><?= $button_label ?></button>
            <?= $button_archive_cancel ?>
            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){

    $('.view-lh').on("click", function(e) {
        e.preventDefault();
        $('.lh_container').toggle();
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
        
        // check if it is a manual entry if no assign ele
        var ele = $('#material_expense_supplierid-' + data_exp); //material_expense_supplier-101 (101=data_exp)
        var ele_m = $('#material_expense_supplier-' + data_exp + '_manual-entry'); //material_expense_supplier-8_manual-entry
        var data_quan = parseInt($('#material_quantity-' + data_exp).val());
        var data_inv = $(ele).find(':selected').attr('data-inv');
        var data_cost = $(ele).find(':selected').attr('data-cost');
        var data_cost_unit_math = (data_cost / data_inv) * data_quan;

        console.log('data_exp=' + data_exp + '::ele=' + ele + '::data-cost= ' + data_cost);

        if(!isNaN(data_cost_unit_math)) {
            var data_cost_unit_math = (data_cost / data_inv) * data_quan;
            var data_cost_unit = data_cost_unit_math.toFixed(2);
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
			$(wrapper).append('<div class="supplier_materials"><!-- manual entry container --><div class="material_supplier-' + x + '-container-manual-entry hide"><label for="material-expense">MATERIAL EXPENSE</label><div class="manual-entry material_expense_supplier-' + x + '-manual-entry half-size"><input type="hidden" id="hidden-material_expense_supplierid-' + x + '-manual-entry" name="hidden-material_expense_supplierid_manual-entry[]" value="0"><input type="text" id="material_expense_supplier' + x + '-manual-entry" name="material_expense_supplier_manual-entry[]" placeholder="MANUAL ENTRY" value=""></div><label class="ml-1" for="material-quantity">QUANTITY</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_quantity-' + x + '-manual-entry" name="material_quantity_manual-entry[]" placeholder="QUANTITY" value="0"><label class="ml-1" for="material-cost">COST</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_cost-' + x + '-manual-entry" name="material_cost_manual-entry[]" placeholder="" value="0.00" ><span class="remove-add"><i data-exp="' + x + '" class="fas fa-times"></i></span></div><!-- /manual entry container --><!-- supplier row --><div class="material-supplier-' + x + '-container"><div class="material_expense_supplier-' + x + '-container material_expense_supplier_container select-wrapper half-size"><label for="material-expense">MATERIAL EXPENSE</label><select id="material_expense_supplierid-' + x + '" name="material_expense_supplier_id[]" data-exp="' + x + '"><option value="-">SELECT A MATERIAL EXPENSE</option><?= $materials_html ?></select></div> <label class="ml-1" for="material-quantity">QUANTITY</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_quantity-' + x + '" name="material_quantity[]" placeholder="QUANTITY" value=""><label for="material-cost" class="ml-1">COST</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_cost-' + x + '" name="material_cost[]" placeholder="" value="" ><span class="remove-add"><i data-exp="' + x + '" class="fas fa-times"></i></span></div><!-- /supplier row --></div>'); 
		}
    });
    
    $(wrapper).on("click",'.remove-add', function(e){ 
        e.preventDefault(); 
        $(this).parent('div').remove(); 
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