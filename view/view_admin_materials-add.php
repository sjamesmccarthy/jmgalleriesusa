<section class="admin-materialss-add">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col materials-add--container">

            <div class="admin-header">
                <h2><?= $this->page->title ?></h2>
                <p class="close-x"><i class="fas fa-times-circle"></i></p>
            </div>

            <!-- <h1><?= $formTitle ?></h1> -->

            <form id="materials-add" action="/studio/api/update/materials" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <?= $redirect_url ?>
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <div class="select-wrapper half-size">
                <label for="supplier">SUPPLIER</label>
                <select id="supplier_id" name="supplier_id">
                    <option value="---">---</option>
                    <?= $suppliers_html ?>
                </select> 
                </div>
                <div class="half-size">
                <label for="sku">SKU</label>
                <input type="text" id="sku" name="sku" placeholder="SKU (eg, 010343832343)" value="<?= $res_sku ?>">
                </div>
            </div>

            <div>
                <label for="edition_num">MATERIAL</label>
                <input class="half-size" type="text" id="material" name="material" placeholder="MATERIAL (eg, Epson Premium Photo Paper Luster)" value="<?= $res_material ?>">
                <label for="artist_proof">MATERIAL TYPE</label>
                <input class="half-size"  type="text" id="material_type" name="material_type" placeholder="MATERIAL TYPE (eg, Paper, Printing, Wood)" value="<?= $res_material_type ?>">
            </div>
            
            <div>
                <label for="edition_nures_max">QUANTITY</label>
                <input class="half-size" type="text" id="quantity" name="quantity" placeholder="QUANTITY (eg, 36)" value="<?= $res_quantity ?>">
                
                <div class="select-wrapper half-size">
                    <label for="unit_type">UNIT TYPE</label>
                    <select id="unit_type" name="unit_type">
                        <option value="---">---</option>
                        <option value="each" <?= ($res_unit_type == "each" ? "SELECTED" : ""); ?>>EACH</option>
                        <option value="hourly" <?= ($res_unit_type == "hourly" ? "SELECTED" : ""); ?>>HOURLY</option>
                        <option value="feet" <?= ($res_unit_type == "feet" ? "SELECTED" : ""); ?>>FEET</option>
                        <option value="sheet" <?= ($res_unit_type == "sheet" ? "SELECTED" : ""); ?>>SHEET</option>
                    </select> 
                </div>
            </div>

            <div>
                <label for="edition_num">MATERIAL COST</label>
                <input class="half-size" type="text" id="cost" name="cost" placeholder="MATERIAL COST (eg, $29.95)" value="<?= $res_cost ?>">
                <label for="artist_proof">MATERIAL SHIPPING COST</label>
                <input class="half-size"  type="text" id="shipping_cost" name="shipping_cost" placeholder="MATERIAL COST SHIPPING (eg, $7.99)" value="<?= $res_shipping_cost ?>">
            </div>

            <div class="half-size">
                <label for="edition_num">PURCHASED ON</label>
                <input class="" type="text" id="purchased_on" name="purchased_on" placeholder="PURCHASED ON (eg, 2020-04-01 10:52:49)" value="<?= $res_purchased_on ?>">
            </div>

            <div class="clear">
                <button class="mt-32" id="sendform" value="SEND"><?= $button_label ?></button>
                <?= $button_archive_cancel ?>
            </div>

            </form>

            <p id="forres_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){

    $('.close-x').on("click", function() {
        window.location.href = '/studio/materials';
    });

    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#sendform');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#materials-add').submit();               
          } 
        });
    });

});

</script>