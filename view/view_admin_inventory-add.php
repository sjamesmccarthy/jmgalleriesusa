<section class="admin--catalog-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 inventory-add--container">

            <h2 class="pb-32"><?= $page_title ?></h2>

            <h1><?= $formTitle ?></h1>

            <form id="catalog-add" action="/studio/api/update/catalog" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
            <?= $id_field ?>
            <input type="hidden" id="created" name="created" value="<?= $created ?>" />
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <input class="half-size" maxlength="255" type="text" id="title" name="title" placeholder="TITLE" value="<?= $title ?>" required>
                <input class="half-size" maxlength="255" type="text" id="edition_style" name="edition_style" placeholder="EDITION STYLE (eg. Gallery, Studio, Open)" value="<?= $file_name ?>" required>
            </div>

            <div>
                <input class="half-size"  type="text" id="artist_proof" name="artist_proof" placeholder="ARTIST PROOF (eg, AP1)" value="<?= $loc_place ?>" required>
                <input class="half-size" type="text" id="series_num" name="series_num" placeholder="SERIES NUMBER (eg 1, 2019)" value="<?= $loc_waypoint ?>">
            </div>
            <div>
                <input class="half-size" type="text" id="edition_num" name="edition_num" placeholder="EDITION NO." value="<?= $loc_city ?>" required>
                <input class="half-size" type="text" id="edition_num_max" name="edition_num_max" placeholder="EDITION NO. MAX" value="<?= $loc_state ?>" required>
            </div>

            <div>
                <h6>About The Art</h6>

                <div>
                    <input class="half-size" type="text" id="print_size" name="print_size" placeholder="PRINT SIZE (eg, 16x24, 24x36)" value="<?= $loc_city ?>" required>
                    <input class="half-size" type="text" id="print_media" name="print_media" placeholder="PRINT MEDIA (eg, Paper, Acrylic)" value="<?= $loc_city ?>" required>
                </div>

                <div>
                    <input class="half-size" type="text" id="frame_size" name="frame_size" placeholder="FRAME SIZE (eg, 18x26, 28x40)" value="<?= $loc_city ?>" required>
                    <input class="half-size" type="text" id="frame_material" name="frame_material" placeholder="FRAME MATERIAL (eg, Bass 530, Inset Wood/Metal)" value="<?= $loc_city ?>" required>
                </div>

                <div>
                    <input type="text" id="frame_desc" name="frame_desc" placeholder="FRAME DESC (eg, PAINTED ASH, STAINED NATURAL)" value="<?= $loc_city ?>" required>
                </div>

                <div>
                    <input class="half-size" type="text" id="listed" name="listed" placeholder="LIST PRICE (eg, $240)" value="<?= $loc_city ?>" required>
                    <input class="half-size" type="text" id="value" name="value" placeholder="VALUE or SOLD PRICE (eg, $220)" value="<?= $loc_city ?>" required>
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
                <input class="half-size" type="text" id="serial_num" name="serial_num" placeholder="SERIAL NO. (eg, 251387)" value="<?= $loc_city ?>" required>
                <input class="half-size" type="text" id="reg_num" name="reg_num" placeholder="Artwork Reg No. (eg, 1569069144)" value="<?= $loc_city ?>" required>
            </div>
            
            <div>
                 <input class="half-size" type="text" id="negative_file" name="negative_file" placeholder="NEGATIVE FILE (eg, PRETTY_PHOTO.jpg)" value="<?= $loc_city ?>" required>
                 <input class="half-size" type="text" id="born_date" name="born_date" placeholder="BORN ON DATE (eg, 2019-12-14 02:23:10)" value="<?= $loc_city ?>" required>
            </div>

            <div>
                <p class="coa_list">No COAs fround for this artwork, perhaps it hasn't been sold yet.</p>
            </div>
            
            <div id="supplier_materials_wrapper" class="mt-32">
                
                <div>
                    <h6>Material Expenses <span class="material-add"><i class="fas fa-plus-circle"></i></span> </h6>
                </div>

                <div id="supplier_materials">

                    <div class="manual-entry material_expense_supplier-0-manual-entry half-size">
                        <input type="text" class="" id="material_expense_supplier-0-manual-entry" name="material_expense_supplier-0-manual-entry" placeholder="MANUAL ENTRY" value="<?= $loc_city ?>">
                        <span class="cancel-link" data-field="material_expense_supplier-0">X</span>
                    </div>
                    <div class="material_expense_supplier-0-container material_expense_supplier_container select-wrapper half-size">
                        <select id="material_expense_supplier-0" name="material_expense_supplier-0" data-num="0">
                            <option value="-">SELECT A MATERIAL EXPENSE</option>
                            <option value="manual">--- manual entry</option>
                            <option value="22">**LOW - paper - Polar Gloss Metallic 255, 13x19 (Red River)</option>
                            <option value="322">moulding - PoBass 530, 3/4" (Foster Mill & Planing)</option>
                            <option value="124">matboard - White matboard" (Hobby Lobby)</option>
                            <?= $category_html ?>
                        </select> 
                    </div>
                    <input class="width-auto" type="text" id="material_quantity-0" name="material_quantity-0" placeholder="QUANTITY" value="" >
                    <input class="width-auto" type="text" id="material_cost-0" name="material_cost-0" placeholder="$" value="">
                        <!-- <span class="remove-add"><i class="fas fa-times"></i></span> -->

                </div>
            
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

    $(document).on('change', 'select', function() {
        
        var container_class = '.' + $(this).prop('id') + '-container';
        var ele_id = 'select#' + $(this).prop('id');
        var input_ele_id = '.' + $(this).prop('id') + '-manual-entry';
        
        // console.log('container_class: ' + $(this).prop('id') + '-container' );
        // console.log('ele_id: ' + $(this).prop('id') );
        // console.log('input_ele_id: ' + $(this).prop('id') + '-manual-entry');

         if( $(ele_id).prop('selectedIndex') == 1) {
             $(container_class).hide();
             console.log('index1');
             $(input_ele_id).addClass('show');
         }
    });

    $(document).on('click', '.cancel-link', function() {

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

    var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $("#supplier_materials_wrapper"); //Fields wrapper
	var add_button      = $(".material-add"); //Add button ID
	
    var x = 0; //initlal text box count
	$(wrapper).on("click",'.material-add', function(e){  
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div id="supplier_materials ' + x + '"><div class="manual-entry material_expense_supplier-' + x + '-manual-entry half-size"><input type="text" id="material_expense_supplier-' + x + '-manual-entry" name="material_expense_supplier-' + x + '-manual-entry" placeholder="MANUAL ENTRY" value="<?= $loc_city ?>"><span class="cancel-link" data-field="material_expense_supplier-' + x + '">X</span></div><div class="material_expense_supplier-' + x + '-container material_expense_supplier_container select-wrapper half-size"><select id="material_expense_supplier-' + x + '" name="material_expense_supplier-' + x + '"><option value="-">SELECT A MATERIAL EXPENSE</option><option value="manual">--- manual entry</option><option value="22">**LOW - paper - Polar Gloss Metallic 255, 13x19 (Red River)</option><option value="322">moulding - PoBass 530, 3/4" (Foster Mill & Planing)</option><option value="124">matboard - White matboard" (Hobby Lobby)</option><?= $category_html ?></select></div> <input class="width-auto" type="text" id="material_quantity-' + x + '" name="material_quantity-' + x + '" placeholder="QUANTITY" value="<?= $loc_city ?>" > <input class="width-auto" type="text" id="material_cost-' + x + '" name="material_cost-' + x + '" placeholder="$" value="<?= $loc_city ?>" ><span class="remove-add"><i class="fas fa-times"></i></span></div>'); //add input box
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

/*
SELECT
	A.art_id,
	A.title as art_title,
	S.supplier_id,
	S.company as supplier,
	ACS.supplier_materials_id,
	SM.material_type,
	SM.cost,
	SM.quantity as quantity_bought,
	ACS.usage as material_used,
	SM.unit_type,
	SM.material as material_desc,
	(CASE 
		WHEN SM.unit_type = 'hourly' THEN ACS.usage
		ELSE (SM.quantity - ACS.usage)
	END) AS calcd_inventory,
	(CASE 
        WHEN SM.unit_type = 'each' THEN SM.cost
        WHEN SM.unit_type = 'hourly' THEN SM.cost * ACS.usage
        ELSE (SM.cost/SM.quantity)
    END) AS calcd_cost
FROM
	art AS A
	INNER JOIN art_costs_supplier AS ACS ON A.art_id = ACS.art_id
	INNER JOIN supplier_materials AS SM ON ACS.supplier_materials_id = SM.supplier_materials_id
	INNER JOIN supplier AS S ON SM.supplier_id = S.supplier_id
WHERE
	A.art_id = 110
	
-- Update SM.inventory with calcd_inventory
*/

</script>