<section class="admin--products-add">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col prdoucts-add--container">

            <div class="notification success <?= $notification_state ?>"><?= $_SESSION['notification_msg'] ?></div>

            <div class="admin-header">
                    <h2><?= $this->page->title ?></h2>
                    <p class="close-x"><i class="fas fa-times-circle"></i></p>
            </div>

            <div>

                <form id="productsadd" action="/studio/api/update/products" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
                <?= $id_field ?>
                <?= $file_1_hidden ?>
                <input type="hidden" id="artist_id" name="artist_id" value="1" />
                <input type="hidden" id="art_id" name="art_id" value="0" />

                <div>
                    <label>title</label>
                    <input class="two-thirds" maxlength="100" type="text" id="title" name="title" placeholder="TITLE (eg, Bonsai Zen Matted Print)" value="<?= $res_title ?>" required>
                   
                    <div class="one-thirds select-wrapper">
                    <label>status</label>   
                    <select id="status" name="status">
                        <option value="ACTIVE" <?= ($res_status == "ACTIVE" ? "SELECTED" : ""); ?>>STATUS (ACTIVE)</option>
                        <option value="DISABLED" <?= ($res_status == "DISABLED" ? "SELECTED" : ""); ?>>STATUS (DISABLED)</option>
                    </select> 
                    </div>
                </div>

                <div>
                    <p class="one-thirds right small">https://jmgalleries.com/product/</p>
                    <label>SHORT URI PATH</label>
                    <input class="two-thirds" maxlength="40" class="half-size ml-16" type="text" id="uri_path" name="uri_path" placeholder="SHORT-URL-PATH (eg, bonzai-zen-matted-print)" value="<?= $res_uri_path ?>" required>
                </div>

                <div class="add-imgs"><i class="fas fa-camera-retro"></i></div>
                 <div class="file mt-16">
                    <ul class="files_nav">
                        <li data-file="file_1" class="files_nav--invert"><i class="far fa-images"> 1</i></li> <!-- files_nav--invert -->
                        <li data-file="file_2" class="files_nav--filmstrip hidden"><i class="far fa-images"> 2</i></li>
                        <li data-file="file_3" class="files_nav--filmstrip hidden"><i class="far fa-images"> 3</i></li>
                        <li data-file="file_4" class="files_nav--filmstrip hidden"><i class="far fa-images"> 4</i></li>
                        <li data-file="file_5" class="files_nav--filmstrip hidden"><i class="far fa-images"> 5</i></li>
                        <li data-file="file_6" class="files_nav--filmstrip hidden"><i class="far fa-images"> THUMBNAIL</i></li>
                    </ul>
                    <div class="skip-imgs"><i class="far fa-eye-slash"></i></div>

                    <!-- File_1 -->
                    <div class="file_block--input file_1">
                        <div>
                            <?= $show_image1_html ?>
                            <div class="file__upload-container">
                            <i class="fas fa-file-upload file__upload-icon"> 1</i>
                            <input class="input-upload" type="file" id="file_1" name="file_1" aria-label="Choose Main Photo" onchange="document.getElementById('file_1_prev').src = window.URL.createObjectURL(this.files[0])" /><br /><?= $image_info_1 ?>
                            <input type="hidden" id="file_1_path" name="file_1_path" value="<?= $res_image_1 ?>">
                            <!-- only show if file exists -->
                            <br /><a style="color: #a9a9a9" href="">DELETE</a>
                        </div>
                        </div>
                    </div>

                   <!-- File_2 -->
                   <div class="file_block--input file_2">
                        <div>
                            <?= $show_image2_html ?>
                            <div class="file__upload-container">
                            <i class="fas fa-file-upload file__upload-icon"> 2</i>
                            <input class="input-upload" type="file" id="file_2" name="file_2" aria-label="Choose Main Photo" onchange="document.getElementById('file_2_prev').src = window.URL.createObjectURL(this.files[0])"><br /><?= $image_info_2 ?>
                            <input type="hidden" id="file_2_path" name="file_2_path" value="<?= $res_image_2 ?>">
                        </div>
                        </div>
                    </div>

                    <!-- File_3 -->
                    <div class="file_block--input file_3">
                        <div>
                            <?= $show_image3_html ?>
                            <div class="file__upload-container">
                            <i class="fas fa-file-upload file__upload-icon"> 3</i>
                            <input class="input-upload" type="file" id="file_3" name="file_3" aria-label="Choose Main Photo" onchange="document.getElementById('file_3_prev').src = window.URL.createObjectURL(this.files[0])"><br /><?= $image_info_3 ?>
                            <input type="hidden" id="file_3_path" name="file_3_path" value="<?= $res_image_3 ?>">
                            </div>
                        </div>
                    </div>

                    <!-- File_4 -->
                    <div class="file_block--input file_4">
                        <div>
                            <?= $show_image4_html ?>
                            <div class="file__upload-container">
                            <i class="fas fa-file-upload file__upload-icon"> 4</i>
                            <input class="input-upload" type="file" id="file_4" name="file_4" aria-label="Choose Main Photo" onchange="document.getElementById('file_4_prev').src = window.URL.createObjectURL(this.files[0])"><br /><?= $image_info_4 ?>
                            <input type="hidden" id="file_4_path" name="file_4_path" value="<?= $res_image_4 ?>">
                        </div>
                        </div>
                    </div>

                    <!-- File_5 -->
                    <div class="file_block--input file_5">
                        <div>
                            <?= $show_image5_html ?>
                            <div class="file__upload-container">
                            <i class="fas fa-file-upload file__upload-icon"> 5</i>
                            <input class="input-upload" type="file" id="file_5" name="file_5" aria-label="Choose Main Photo" onchange="document.getElementById('file_5_prev').src = window.URL.createObjectURL(this.files[0])"><br /><?= $image_info_5 ?>
                            <input type="hidden" id="file_5_path" name="file_5_path" value="<?= $res_image_5 ?>">
                        </div>
                        </div>
                    </div>
                    
                    <!-- File_6 -->
                    <div class="file_block--input file_6">
                        <div>
                            <?= $show_image6_html ?>
                            <div class="file__upload-container">
                            <i class="fas fa-file-upload file__upload-icon"> 6</i>
                            <input class="input-upload" type="file" id="file_6" name="file_6" aria-label="Choose Main Photo" onchange="document.getElementById('file_6_prev').src = window.URL.createObjectURL(this.files[0])"><br /><?= $image_info_6 ?>
                            <input type="hidden" id="file_6_path" name="file_6_path" value="<?= $res_image_6 ?>">
                        </div>
                        </div>
                    </div>

                </div>
                
                <div class="mt-16">
                    <label>price</label>
                    <input class="half-size" type="text" id="price" name="price" placeholder="PRICE (eg. $49.95)" value="<?= $res_price ?>">
                    <label>on_sale</label>
                    <input class="half-size" type="text" id="on_sale" name="on_sale" placeholder="SALE (eg. 0.75 = 75%) / NULL" value="<?= $res_on_sale ?>">
                </div>
                
                <div class="mt-16">
                    <label>quantity</label>
                    <input class="half-size" type="text" id="quantity" name="quantity" placeholder="QUANTITY (eg. 2)" value="<?= $res_quantity ?>">
                    
                    <label>taxable</label>
                    <input class="half-size" type="text" id="taxable" name="taxable" placeholder="TAXABLE (eg. true/false)" value="<?= $res_taxable ?>" <?= $read_only ?>>
                </div>
                
                <div class="mt-16">
                    <label>in_stock</label>
                    <input class="half-size" type="text" id="in_stock" name="in_stock" placeholder="in_stock (eg. true/false)" value="<?= $res_in_stock ?>" />
                    
                    <label>shipping tiers</label>
                    <input class="half-size" type="text" id="ship_tier" name="ship_tier" placeholder="SHIPPING (eg. {'USPS': {'name': 'USPS Shipping (no tracking)','abrv': 'usps','tracking': 'false','amount': '10'})" value="<?= $res_ship_tier ?>">                  
                </div>
                
                <div class="mt-16">
                    
                    <div class="half-size">
                        <label>desc-short</label>
                        <input class="" type="text" id="desc_short" name="desc_short" placeholder="SHORT DESC (eg. Matted Print, Artist/Studi0 Proof)" value="<?= $res_desc_short ?>">
                    </div>
                    
                    <?= $inventory_ids_html ?>
                </div>
                
                <div id="content_area" class="mt-16">
                    <label>content</label>
                    <textarea name="desc" id="desc" class="prod_desc_html"><?= $res_desc ?></textarea>
                </div>
                <div id="content_area" class="mt-16">
                    <label>details</label>
                    <textarea name="details" id="details" class="prod_details_html"><?= $res_details ?></textarea>
                </div>
            
                <div class="mt-16">
                    <label>tags</label>
                    <input class="half-size" type="text" id="tags" name="tags" placeholder="TAGS (eg. adventure, tutorial, opinion, historical-profile)" value="<?= $res_tags ?>">
                    <label>created on</label>
                    <input class="half-size <?= $date_field_hidden ?>" type="text" id="created" name="created" placeholder="CREATED ON (eg. 2020-07-01 08:32:08)" value="<?= $res_created ?>">
                </div>

                <button class="mt-32 half-size" id="sendform" value="SEND"><?= $button_label ?></button> <?= $button_archive_cancel ?>
                </form>

                <p id="form_response"> </p>
                </div>
            </div>

    </div>
</section>

<script>

function preview() {
    frame.src=URL.createObjectURL(event.target.files[0]);
}

jQuery(document).ready(function($){

    console.log('type=filmstrip');
    $('.files_nav--filmstrip').removeClass('hidden');

    $('.close-x').on("click", function() {
        window.location.href = '/studio/products';
    });
    
    <?php if($imgsLoaded != 1) { ?>
        $('.file').show();
        $('.add-imgs').hide();
        /* reversed these two options to show file area on load */
    <?php } else  { ?>
        $('.file').show();
        $('.add-imgs').hide();
    <?php } ?>

    $('.skip-imgs').on("click", function(e) {
        console.log('skip-imgs.clicked');
        $('.file').toggle();
        $('.add-imgs').toggle();
    });

    $('.add-imgs').on("click", function(e) {
        console.log('add-imgs.clicked');
        $('.file').toggle();
        $('.add-imgs').toggle();
    });

    $('.files_nav li').on('click', function(e) {
        var tab = $(this).data('file');
        $('.files_nav li').removeClass("files_nav--invert");
        $('.file_block--input').hide();
        $(this).addClass('files_nav--invert');
        $('.' + tab).show();
    });


    <?php if($uri_path_disabled != "disabled") { ?>
        $('#title').on('keyup', function() {
            $('#uri_path').val($('#title').val().toLowerCase().replace(/\s+/g, "-"));
        });
    <?php } ?>

    $('#sendform').on("click", function(e) {
        
        console.log('sendform()');
        /* Export HTML from WYSIWYG editor DIV to textarea */
        // $('.content_raw').val( $('.content_html').html() );

        $(":input[required]").each(function () {                     
        
            var myForm = $('#fieldnotesadd');
            if (!myForm[0].checkValidity()) {                
                myForm.submit();     
            } else {
                console.log('sendform.failed()');
                return false;
            }

        });

    });

    $('#archive').on("click", function(e) {
        e.preventDefault();
        alert('This Feature Not Available At This Time');
    });

});

</script>
