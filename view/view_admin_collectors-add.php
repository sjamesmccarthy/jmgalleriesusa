<section class="admin--collectors-add">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col collectors-add--container">

            <div class="admin-header">
                <h2><?= $this->page->title ?></h2>
                <p class="close-x"><i class="fas fa-times-circle"></i></p>
            </div>

            <!-- <h1><?= $formTitle ?></h1> -->

            <form id="collectors-add" action="/studio/api/update/collectors" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <?= $redirect_url ?>
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <label for="title">FIRST NAME</label>
                <input class="half-size" maxlength="255" type="text" id="first_name" name="first_name" placeholder="FIRST NAME" value="<?= $res_first_name ?>" required>
                <label for="edition-style">LAST NAME</label>
                <input class="half-size" maxlength="255" type="text" id="last_name" name="last_name" placeholder="LAST NAME" value="<?= $res_last_name ?>" required>
            </div>

            <div>
                <label for="artist_proof">EMAIL</label>
                <input class="half-size"  type="text" id="email" name="email" placeholder="EMAIL (eg, alfred@jmgalleries.com)" value="<?= $res_email ?>">
                <label for="series_num">PHONE</label>
                <input class="half-size" type="text" id="phone" name="phone" placeholder="PHONE (eg, 951-708-1831)" value="<?= $res_phone ?>">
            </div>
            <div>
                <label for="edition_num">COMPANY (if applicable)</label> 
                <input type="text" id="company" name="company" placeholder="COMPANY (eg, Ocean Business Park)" value="<?= $res_company ?>">
                <!-- <label for="edition_num_max">PHONE NUMBER</label> -->
                <!-- <input class="half-size" type="text" id="phone" name="phone" placeholder="PHONE (rg, 951-708-1831)" value="<?= $s_phone ?>"> -->
            </div>

            <div>
                <label for="artist_proof">ADDRESS</label>
                <input class="half-size"  type="text" id="address" name="address" placeholder="ADDRESS (eg, 123 Main St.)" value="<?= $res_address ?>">
                <label for="series_num">SUITE, APT, ETC.</label>
                <input class="half-size" type="text" id="address_extra" name="address_extra" placeholder="ADDRESS EXTRA (eg, Suite A4)" value="<?= $res_address_extra ?>">
            </div>

            <div>
                <label for="edition_num_max">CITY</label>
                <input class="half-size" type="text" id="city" name="city" placeholder="CITY (eg, LAS VEGAS)" value="<?= $res_city ?>">
                <label for="series_num">STATE</label>
                <input class="half-size" type="text" id="state" name="state" placeholder="STATE (eg, NEVADA)" value="<?= $res_state ?>">
            </div>

            <div>
                <label for="edition_num_max">POSTAL CODE</label>
                <input class="half-size" type="text" id="postalcode" name="postalcode" placeholder="POSTAL CODE (eg, 89123)" value="<?= $res_postalcode ?>">
                <label for="series_num">COUNTRY</label>
                <input class="half-size" type="text" id="country" name="country" placeholder="COUNTRY (eg, US)" value="<?= $res_country ?>">
            </div>

            <div>
                <p class="c_act_status"><?= $user_account_html ?></p> 
            </div>

            <?= $purchases ?>
            
            <!-- <section id="pending">
                    <h4>Pending Orders (<?= $active_materials_count ?>)</h4>
                    <p>No Pending Orders Found</p>
            </section>

            <section id="messages">
                    <h4>Account Notes (<?= $active_materials_count ?>)</h4>
                    <p>No Account Notes Found</p>
            </section> -->


            <div class="clear half-size">
                <button class="mt-32" id="sendform" value="SEND"><?= $button_label ?></button>
            </div>
            <div class="half-size">
                <?= $button_archive_cancel ?>
            </div>

            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){

    $('.close-x').on("click", function() {
        window.location.href = '/studio/collectors';
    });

    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#sendform');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#collectors-add').submit();               
          } 
        });
    });


    $('#dataTableArtwork').DataTable( {
            processing: true,
            paging: false,
            pagingType: "numbers",
            searching: false,
            autoWidth: true,
            // oSearch: {"sSearch": "<?= $filter ?>"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/inventory-add?id=' + row.art_id + '">' + row.title + ' (CERT-' + row.certificate_id + ')</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'frame_size'},
                { data: 'serial_num'},
                { data: 'reg_num'},
                // { data: 'certificate_id' },
                { data: 'purchase_date'},
                { data: 'value' },
            ]
        } );

});

</script>