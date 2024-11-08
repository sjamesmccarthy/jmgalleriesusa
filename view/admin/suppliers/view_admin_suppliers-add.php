<section class="admin--suppliers-add">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col suppliers-add--container">

            <div class="admin-header">
                <h2><?= $this->page->title ?></h2>
                <p class="close-x"><i class="fas fa-times-circle"></i></p>
            </div>

            <!-- <h1><?= $formTitle ?></h1> -->

            <form id="suppliers-add" action="/studio/api/update/suppliers" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <label>company</label>
                <input class="half-size" maxlength="255" type="text" id="company" name="company" placeholder="COMPANY" value="<?= $res_company ?>" required>
                <label>website</label>
                <input class="half-size" maxlength="255" type="text" id="website" name="website" placeholder="WEBSITE (eg, https://adorama.com)" value="<?= $res_website ?>">
            </div>

            <div>
                <label>first name (contact)</label>
                <input class="half-size"  type="text" id="first_name" name="first_name" placeholder="FIRST NAME (eg, John)" value="<?= $res_first_name ?>">
                <label>last name (contact)</label>
                <input class="half-size" type="text" id="last_name" name="last_name" placeholder="LAST NAME (eg, White)" value="<?= $res_last_name ?>">
            </div>
            <div>
                <label>email</label>
                <input class="half-size" type="text" id="email" name="email" placeholder="EMAIL (eg, alfred@jmgalleries.com)" value="<?= $res_email ?>">
                <label>phone number</label>
                <input class="half-size" type="text" id="phone" name="phone" placeholder="PHONE (rg, 951-708-1831)" value="<?= $res_phone ?>">
            </div>

                <div class="half-size">
                    <label>account number (if applicable)</label>
                    <input  type="text" id="account" name="account" placeholder="ACCOUNT NUMBER (eg, 123456)" value="<?= $res_account_no ?>">
                </div>

               
            <div class="clear">
                <button class="mt-32 w-50" id="sendform" value="SEND"><?= $button_label ?></button>
                <?= $button_archive_cancel ?>
            </div>

            </form>

            <section id="related-materials">
            
            <div class="grid">
                <div class="col">
                <h4>Inventory of Materials (<?= $active_materials_count ?>)</h4>
                </div>
                <div class="col-1 add-icon">
                    <a href="/studio/materials-add?ref=<?= $supplier_id ?>"><i class="fas fa-plus-circle"></i></a>
                </div>
            </div>

            <table id="dataTable" class="display">
            <thead>
                <tr>
                    <th>material</th>
                    <th>material type</th>
                    <th>purchased on</th>
                    <th>quantity</th>
                    <th>cost</th>
                    <th>unit type</th>
                </tr>
            </thead>
                <tbody></tbody>
            </table>

            </section>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){
    
    $('.close-x').on("click", function() {
        window.location.href = '/studio/suppliers';
    });

    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#sendform');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#suppliers-add').submit();               
          } 
        });
    });

    $('#archive').on("click", function(e) {
        e.preventDefault();
        alert('This Feature Not Available At This Time');
    });
    
    $('#dataTable').DataTable( {
            processing: true,
            paging: false,
            pagingType: "numbers",
            searching: true,
            // oSearch: {"sSearch": "<?= $filter ?>"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'material', 
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data =  '<a href="/studio/materials-add?id=' + row.supplier_materials_id + '&ref=<?= $supplier_id ?>">' + data + '</a>';
                        }  
                        return data;
                    }
                },
                { data: 'material_type'},
                { data: 'purchased_on'},
                { data: 'quantity' },
                { data: 'cost',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data =  '$' + data;
                        }  
                        return data;
                    }
                },
                { data: 'unit_type'},
            ]
        } );
        

});

</script>