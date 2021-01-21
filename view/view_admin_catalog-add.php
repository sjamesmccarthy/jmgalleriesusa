<section class="admin--catalog-add">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col catalog-add--container">

            <div class="admin-header">
                <h2><?= $page_title ?></h2>
                <p class="close-x"><i class="fas fa-times-circle"></i></p>
            </div>

            <form id="catalog-add" action="/studio/api/update/catalog" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
            <?= $id_field ?>
            <?= $file_1_hidden ?>
            <?= $file_2_hidden ?>
            <input type="hidden" id="in_shop" name="in_shop" value="0" />
            <input type="hidden" id="created" name="created" value="<?= $created ?>" />
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <div class="select-wrapper half-size">
                <select id="parent_collections_id" name="parent_collections_id" style="margin-bottom: 0">
                    <option value="PARENT COLLECTION">PARENT COLLECTION</option>
                    <option value="---">---</option>
                    <?= $category_html ?>
                </select> 

                <p id="add-collection" class="small mb-16 ml-16 mt-16">
                    <?= $collections_html ?>
                </p>
                <!-- <p  class="small pb-8">edit collections</i></p> -->
                   
                <select id="collections-tag" name="collections_tags[]" multiple>
                    <?= $collections_tag_options ?>
                </select>

                </div>

                <div class="select-wrapper half-size" style="vertical-align: top">
                <select id="status" name="status">
                <!-- $var > 2 ? true : false -->
                    <option value="ACTIVE" <?= ($status == "ACTIVE" ? "SELECTED" : ""); ?>>STATUS (ACTIVE)</option>
                    <option value="DISABLED" <?= ($status != "ACTIVE" ? "SELECTED" : ""); ?>>STATUS (DISABLED)</option>
                </select> 
                 <p id="make-featured" class="small mb-16 mt-16">
                     <input <?= ($featured == "1" ? "CHECKED" : ""); ?> type="checkbox" id="featured" name="featured" value="1" /> 
                     <label for="featured" style="color: #000"> Featured Homepage Cover (note: must be landscape)</label>
                </p>
                </div>

            </div>

            <div>
                <input class="half-size" maxlength="255" type="text" id="title" name="title" placeholder="TITLE" value="<?= $title ?>" required>
                <input class="half-size" maxlength="255" type="text" id="file_name" name="file_name" placeholder="file_name (also sets URL)" value="<?= $file_name ?>" required>
            </div>

            <div style="margin-bottom: 10px;">
                <div class="file half-size">
                <p>Image: __image/<?= $file_name ?></p>
                <img class="photopreview <?= $display_show ?>" src="/catalog/__image/<?= $file_name ?>.jpg?<?= date(); ?>" />
                <input class="input-upload" type="file" id="file_1" name="file_1" aria-label="Choose Main Photo">
                <input type="hidden" id="file_1_path" name="file_1_path" value="/catalog/__image/">
                <!-- <span class="file-custom file-custom-main"></span> -->
                </div>

                <div class="half-size file file-thumb">
                <p>Thumbnail: __thumbnail/<?= $file_name ?></p>
                <img class="photopreview photopreviewthumb <?= $display_show ?>" src="/catalog/__thumbnail/<?= $file_name ?>.jpg?<?= date(); ?>" />
                <input class="input-upload"  type="file" id="file_2" name="file_2" aria-label="Choose Main Photo">
                <input type="hidden" id="file_2_path" name="file_2_path" value="/catalog/__thumbnail/">
                <!-- <span class="file-custom file-custom-thumbnail"></span> -->
                </div>
            </div>

            <div class="mt-24">
                <input class="half-size"  type="text" id="loc_place" name="loc_place" placeholder="LOCATION PLACE" value="<?= $loc_place ?>" required>
                <input class="half-size" type="text" id="loc_waypoint" name="loc_waypoint" placeholder="LOCATION WAYPOINT" value="<?= $loc_waypoint ?>">
            </div>
            <div>
                <input class="half-size" type="text" id="loc_city" name="loc_city" placeholder="LOCATION CITY" value="<?= $loc_city ?>" required>
                <input class="half-size" type="text" id="loc_state" name="loc_state" placeholder="LOCATION STATE" value="<?= $loc_state ?>" required>
            </div>
            <div>
                <h6>And, so the story goes ...</h6>
                <textarea id="story" name="story" required><?= $story ?></textarea>
                <input type="text" id="tags" name="tags" placeholder="#TAGS" value="<?= $tags ?>" required>
            </div>

            <div>
                <h6>Available Editions</h6>

                <div class="select-wrapper half-size">
                <select id="as_edition" name="as_edition">
                    <option value="as_gallery" <?= ($as_gallery == "1" ? "SELECTED" : ""); ?>>as LIMITED EDITION</option>
                    <!-- <option value="0" <?= ($as_gallery == "0" ? "SELECTED" : ""); ?>>no (LIMITED EDITION)</option> -->
                    <option value="as_open" <?= ($as_open == "1" ? "SELECTED" : ""); ?>>as OPEN/tinyViews&trade; EDITION</option>
                    <!-- <option value="0" <?= ($as_open == "0" ? "SELECTED" : ""); ?>>no (OPEN/tinyViews&trade; EDITION)</option> -->
                </select>
                </div>
                <input type="hidden" name="previous_edition" value="<?= $previous_edition ?>" />

                <div class="select-wrapper half-size">
                <select id="on_display" name="on_display">
                    <option value="0">on Display (Select Location)</option>
                    <?= $location_html ?>
                </select> 
                </div>

                <!-- <div class="select-wrapper half-size">
                <select id="as_studio" name="as_studio">
                    <option value="1" <?= ($as_studio == "1" ? "SELECTED" : ""); ?>>as STUDIO EDITION</option>
                    <option value="0" <?= ($as_studio == "0" ? "SELECTED" : ""); ?>>no (STUDIO EDITION)</option>
                </select> 
                </div> -->

            </div>

            <div>
                <input class="half-size" type="text" id="desc" name="desc" placeholder="DESCRIPTION OF MATERIAL (eg, paper or acrylic)" value="<?= $desc ?>" required>
                <input class="half-size" type="text" id="available_sizes" name="available_sizes" placeholder="AVAILABLE SIZES (in_code = default, otherwise use JSON)" value="<?= $available_sizes ?>" required>
            </div>

            <div>
                <!-- <div class="select-wrapper half-size">
                <select id="as_tinyviews" name="as_tinyview">
                    <option value="1" <?= ($as_tinyview == "1" ? "SELECTED" : ""); ?>>as TINYVIEWS EDITION</option>
                    <option value="0" <?= ($as_tinyview == "0" ? "SELECTED" : ""); ?>>no (TINYVIEWS EDITION)</option>
                </select> 
                </div> -->

                <!-- <div class="select-wrapper half-size">
                <select id="as_open" name="as_open">
                    <option value="1" <?= ($as_open == "1" ? "SELECTED" : ""); ?>>as OPEN/tinyViews&trade; EDITION</option>
                    <option value="0" <?= ($as_open == "0" ? "SELECTED" : ""); ?>>no (OPEN/tinyViews&trade; EDITION)</option>
                </select> 
                </div> -->

            <div>
                <!-- <div class="half-size">
                    <input  type="text" id="print_media" name="print_media" placeholder="PRINT MEDIA: PAPER, ACRYLIC" value="<?= $print_media ?>">
                </div> -->
                <!-- <div class="select-wrapper half-size">
                <select id="on_display" name="on_display">
                    <option value="0">on Display (Select Location)</option>
                    <?= $location_html ?>
                </select> 
                </div> -->
            </div>
            
            <div>
                <h6>Photo Meta Data</h6>
                <div class="select-wrapper half-size">
                <select id="orientation" name="orientation">
                    <option value="landscape" <?= ($orientation == "landscape" ? "SELECTED" : ""); ?>>Landscape</option>
                    <option value="portrait" <?= ($orientation == "portrait" ? "SELECTED" : ""); ?>>Portrait</option>
                    <option value="square" <?= ($orientation == "square" ? "SELECTED" : ""); ?>>Square</option>
                </select> 
                </div>
                <div class="half-size">
                <input type="text" id="date_taken" name="date_taken" placeholder="DATE TAKEN (e.g. <?= $created ?>)" value="<?= $date_taken ?>">
                </div>
            <div>

            <div>
                <div class="select-wrapper half-size">
                <select id="camera" name="camera">
                    <option value="Nikon Z5" <?= ($camera == "Nikon Z5" ? "SELECTED" : ""); ?>>Nikon Z5</option>
                    <option value="Nikon D810" <?= ($camera == "Nikon D810" ? "SELECTED" : ""); ?>>Nikon D810</option>
                    <option value="Nikon D600" <?= ($camera == "Nikon D600" ? "SELECTED" : ""); ?>>Nikon D600</option>
                    <option value="Nikon D5200" <?= ($camera == "Nikon D5200" ? "SELECTED" : ""); ?>>Nikon D5200</option>
                    <option value="Nikon 1 V1" <?= ($camera == "Nikon 1 V1" ? "SELECTED" : ""); ?>>Nikon 1 V1</option>
                    <option value="Ricoh GR II" <?= ($camera == "Ricoh GR II" ? "SELECTED" : ""); ?>>Ricoh GR II</option>
                </select> 
                </div>
                <div class="select-wrapper half-size">
                <select id="lens_model" name="lens_model">
                    <option value="">LENS</option>
                    <option value="Nikkor Z 24-200" <?= ($lens_model == "Nikkor Z 24-200" ? "SELECTED" : ""); ?>>Nikkor Z 24-200</option>
                    <option value="Nikkor Z 24-50" <?= ($lens_model == "Nikkor Z 24-50" ? "SELECTED" : ""); ?>>Nikkor Z 24-50</option>
                    <option value="Tamron SP 85mm F/1.8 Di VC USD" <?= ($lens_model == "Tamron SP 85mm F/1.8 Di VC USD" ? "SELECTED" : ""); ?>>Tamron SP 85mm F/1.8 Di VC USD</option>
                    <option value="Tamron SP 15-30mm f/2.8 Di VC USD G2" <?= ($lens_model == "Tamron SP 15-30mm f/2.8 Di VC USD G2" ? "SELECTED" : ""); ?>>Tamron SP 15-30mm f/2.8 Di VC USD G2</option>
                    <option value="Tamron SP 24-70mm f/2.8 Di VC USD G2" <?= ($lens_model == "Tamron SP 24-70mm f/2.8 Di VC USD G2" ? "SELECTED" : ""); ?>>Tamron SP 24-70mm f/2.8 Di VC USD G2</option>
                    <option value="Tamron SP 70-200mm f/2.8 Di VC USD G2" <?= ($lens_model == "Tamron SP 70-200mm f/2.8 Di VC USD G2" ? "SELECTED" : ""); ?>>Tamron SP 70-200mm f/2.8 Di VC USD G2</option>
                    <option value="Tamron SP 70-300mm f/4-5.6 Di LD Macro" <?= ($lens_model == "Tamron SP 70-300mm f/4-5.6 Di LD Macro" ? "SELECTED" : ""); ?>>Tamron SP 70-300mm f/4-5.6 Di LD Macro</option>
                    <option value="Nikon AF-S VR 24-120mm f.3.5-5.56G IF-ED" <?= ($lens_model == "Nikon AF-S VR 24-120mm f.3.5-5.56G IF-ED" ? "SELECTED" : ""); ?>>Nikon AF-S VR 24-120mm f.3.5-5.56G IF-ED</option>
                    <option value="Nikon AF-S DX Nikkor 18-55mm f/3.5-5.6G VR" <?= ($lens_model == "Nikon AF-S DX Nikkor 18-55mm f/3.5-5.6G VR" ? "SELECTED" : ""); ?>>Nikon AF-S DX Nikkor 18-55mm f/3.5-5.6G VR</option>
                    <option value="Nikon AF-S Nikkor 24-85mm f/3.5-4.5GG ED VR" <?= ($lens_model == "Nikon AF-S Nikkor 24-85mm f/3.5-4.5GG ED VR" ? "SELECTED" : ""); ?>>Nikon AF-S Nikkor 24-85mm f/3.5-4.5GG ED VR</option>
                    <option value="Nikon AF-S Nikkor 55-300 f/4.5-5.6 ED VR" <?= ($lens_model == "Nikon AF-S Nikkor 55-300 f/4.5-5.6 ED VR" ? "SELECTED" : ""); ?>>Nikon AF-S Nikkor 55-300 f/4.5-5.6 ED VR</option>
                    <option value="Nikon AF-S Nikkor 50mm 1.8G" <?= ($lens_model == "Nikon AF-S Nikkor 50mm 1.8G" ? "SELECTED" : ""); ?>>Nikon AF-S Nikkor 50mm 1.8G</option>
                    <option value="Rokinon 14mm f/2.8 ED UMC" <?= ($lens_model == "Rokinon 14mm f/2.8 ED UMC" ? "SELECTED" : ""); ?>>Rokinon 14mm f/2.8 ED UMC</option>
                </select>
                </div>
            <div>

            <div>
                <input class="half-size" type="text" id="aperture" name="aperture" placeholder="APERTURE (eg, 6)" value="<?= $aperture ?>">
                <input class="half-size" type="text" id="shutter" name="shutter" placeholder="SHUTTER (eg, 1/125)" value="<?= $shutter ?>">
            </div>
            <div>
                <input class="half-size" type="text" id="focal_length" name="focal_length" placeholder="FOCAL LENGTH (eg, 70)" value="<?= $focal_length ?>">
                <input class="half-size" type="text" id="iso" name="iso" placeholder="ISO" value="<?= $iso ?>">
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

    $('.close-x').on("click", function() {
        window.location.href = '/studio/catalog';
    });


    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#catalog-add');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#catalog-add').submit();             
          } 
        });
    });

    $('#title').on('keyup', function() {
        $('#file_name').val($('#title').val().toLowerCase().replace(/\s+/g, "-"));
    });

    $('#archive').on("click", function(e) {
        e.preventDefault();
        alert('This Feature Not Available At This Time');
    });

    $('#add-collection').on("click", function(e) {
        e.preventDefault();
        $('#collections-tag').toggle();
    });
    
});
</script>