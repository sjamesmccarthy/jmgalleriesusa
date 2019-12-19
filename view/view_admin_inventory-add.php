<section class="admin--catalog-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 inventory-add--container">

            <h2 class="pb-32"><?= $page_title ?></h2>

            <h1><?= $formTitle ?></h1>

            <form id="catalog-add" action="/studio/api/update/catalog" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formType ?>" />
            <?= $id_field ?>
            <input type="hidden" id="created" name="created" value="<?= $created ?>" />
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <div class="half-size">
                   <!-- Current Location:  -->
                </div>
                <div class="select-wrapper half-size">
                    <label for="location">LOCATION</label>
                <select id="on_display" name="on_display">
                    <option value="0">on Display (Select Location)</option>
                    <?= $location_html ?>
                </select> 
                </div>
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
                    <textarea id="notes" name="notes" required><?= $notes ?></textarea>
                </div>

            </div>

            <div>
                <h6>Certificate of Authenticity Data</h6>
            <div>

            <div>
                <label for="serial_num">SERIAL NUM</label>
                <input class="half-size" type="text" id="serial_num" name="serial_num" placeholder="SERIAL NO. (eg, 251387)" value="<?= $serial_num ?>" required>
                <label for="reg_num">REG NUM</label>
                <input class="half-size" type="text" id="reg_num" name="reg_num" placeholder="Artwork Reg No. (eg, 1569069144 aka Born On Date)" value="<?= $reg_num ?>" required>
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
                
                <h6>Material Expenses <span class="material-add"><i class="fas fa-plus-circle"></i></span> </h6>

                <?= $costs_html ?>

                <div class="supplier_materials">

                    <label for="material-expense">MATERIAL EXPENSE</label>
                    <div class="manual-entry material_expense_supplier-0-manual-entry half-size">
                        <input type="text" class="" id="material_expense_supplier-0-manual-entry" name="material_expense_supplier-0-manual-entry" placeholder="MANUAL ENTRY" value="">
                        <span class="cancel-link" data-field="material_expense_supplier-0">X</span>
                    </div>
                    <div class="material_expense_supplier-0-container material_expense_supplier_container select-wrapper half-size">
                        <select data-exp="0" id="material_expense_supplier-0" name="material_expense_supplier-0">
                            <option value="-">SELECT A MATERIAL EXPENSE</option>
                            <?= $materials_html ?>
                        </select> 
                    </div>
                    <label for="material-quantity">QUANTITY</label>
                    <input data-exp="0" class="width-auto material_quan" type="text" id="material_quantity-0" name="material_quantity-0" placeholder="QUANTITY" value="0" >
                     <label for="material-cost" class="ml-1">COST</label>
                    <input data-exp="0" class="width-auto" type="text" id="material_cost-0" name="material_cost-0" placeholder="$" value="0.00">
                    <span class="remove-add"><i data-exp="0" class="fas fa-times"></i></span>
                </div>
            
            </div>

            <!-- <div class="total_exp">
                TOTAL EXPENSES: <input style="width: 100px; background-color: #FFF;" type="text" id="total_exp_calc" value="0.00">
            </div> -->

            <button class="mt-32" id="sendform" value="SEND"><?= $button_label ?></button>
            <?= $button_archive_cancel ?>
            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){

    $(document).on('change', 'select', function() {
        
        var data_exp = $(this).attr('data-exp');
        var container_class = '.' + $(this).prop('id') + '-container';
        var ele_id = 'select#' + $(this).prop('id');
        var input_ele_id = '.' + $(this).prop('id') + '-manual-entry';
        
        console.log(data_exp);
        // console.log('container_class: ' + $(this).prop('id') + '-container' );
        // console.log('ele_id: ' + $(this).prop('id') );
        // console.log('input_ele_id: ' + $(this).prop('id') + '-manual-entry');

         if( $(ele_id).prop('selectedIndex') == 1) {
             $(container_class).hide();
             console.log('index1');
             $(input_ele_id).addClass('show');
         }

    });

    $(document).on('blur', '.material_quan', function() { 

        var data_exp = $(this).attr('data-exp');
        var data_id = $(this).prop('id');
        
        // check if it is a manual entry if no assign ele
        var ele = $('#material_expense_supplier-' + data_exp);
        var ele_m = $('#material_expense_supplier-' + data_exp + '-manual-entry');
        var data_quan = parseInt($('#material_quantity-' + data_exp).val());
        var data_inv = $(ele).find(':selected').attr('data-inv');
        var data_cost = $(ele).find(':selected').attr('data-cost');
        var data_cost_unit_math = (data_cost / data_inv) * data_quan;

        if(isNaN(data_cost_unit_math)) {
            var data_cost_unit_math = 0.00;
        } else {
            var data_cost_unit_math = (data_cost / data_inv) * data_quan;
        }

        var data_cost_unit = data_cost_unit_math.toFixed(2);
        $('#material_cost-' + data_exp).val( '$' + data_cost_unit);

    });

    $(document).on('click', '.cancel-link', function() {
        
        var data_exp = $(this).attr('data-exp');
        var container_class = '.' + $(this).attr('data-field') + '-container';
        var ele_id = 'select#' + $(this).attr('data-field');
        var input_ele_id = '.' + $(this).attr('data-field') + '-manual-entry';

        // console.log(container_class);
        // console.log(ele_id);
        // console.log(input_ele_id);

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
			$(wrapper).append('<div class="supplier_materials"><label for="material-expense">MATERIAL EXPENSE</label><div class="manual-entry material_expense_supplier-' + x + '-manual-entry half-size"><input type="text" id="material_expense_supplier-' + x + '-manual-entry" name="material_expense_supplier-' + x + '-manual-entry" placeholder="MANUAL ENTRY" value=""><span class="cancel-link" data-field="material_expense_supplier-' + x + '">X</span></div><div class="material_expense_supplier-' + x + '-container material_expense_supplier_container select-wrapper half-size"><select id="material_expense_supplier-' + x + '" name="material_expense_supplier-' + x + '" data-exp="' + x + '"><option value="-">SELECT A MATERIAL EXPENSE</option><?= $materials_html ?></select></div> <label for="material-quantity">QUANTITY</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_quantity-' + x + '" name="material_quantity-' + x + '" placeholder="QUANTITY" value="0"> <label for="material-cost" class="ml-1">COST</label><input data-exp="' + x + '" class="width-auto material_quan" type="text" id="material_cost-' + x + '" name="material_cost-' + x + '" placeholder="$" value="0.00" ><span class="remove-add"><i data-exp="' + x + '" class="fas fa-times"></i></span></div>'); 

            /* <option value="-">SELECT A MATERIAL EXPENSE</option><option value="manual">--- manual entry</option><option value="22" data-unit="sheet" data-inv="20" data-cost="38.21">**LOW - paper - Polar Gloss Metallic 255, 13x19 by sheet (Red River) [sheet]</option><option value="322" data-unit="length" data-inv="100" data-cost="114.00">moulding - Bass 530, 3/4" (Foster Mill & Planing) [length]</option><option value="124" data-unit="each" data-inv="1" data-cost="9.99">matboard - White matboard (Hobby Lobby) [each]</option> */
		}
    });
    
    $(wrapper).on("click",'.remove-add', function(e){ 
        e.preventDefault(); 

        /* create exp data-att, etc */
        // var data_exp = $(this).attr('data-exp');
        // var ele = $('#material_cost-' + data_exp);
        // console.log( 'cost-value-removed: ' + $('#material_cost-' + data_exp).val() );
        // var fetch_total = parseFloat($('#total_exp_calc').val()) - parseFloat(data_cost_unit);
        // var total = fetch_total;
        // $('#total_exp_calc').val(total);

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