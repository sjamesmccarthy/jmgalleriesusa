<section class="admin--catalog-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog-add--container">

            <h2 class="pb-32"><?= $page_title ?></h2>

            <h1><?= $formTitle ?></h1>

            <form id="catalog-add" action="/studio/api/update/catalog" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
            <?= $id_field ?>
            <input type="hidden" id="in_shop" name="in_shop" value="0" />
            <input type="hidden" id="created" name="created" value="<?= $created ?>" />

            <div>
                <div class="select-wrapper half-size">
                <select id="catalog_category_id" name="catalog_category_id">
                    <option value="CATEGORY">CATEGORY</option>
                    <option value="---">---</option>
                    <?= $category_html ?>
                </select> 
                </div>
                <div class="select-wrapper half-size">
                <select id="status" name="status">
                <!-- $var > 2 ? true : false -->
                    <option value="ACTIVE" <?= ($status == "ACTIVE" ? "SELECTED" : ""); ?>>STATUS (ACTIVE)</option>
                    <option value="DISABLED" <?= ($status != "ACTIVE" ? "SELECTED" : ""); ?>>STATUS (DISABLED)</option>
                </select> 
                </div>
            </div>

            <div>
                <input class="half-size" maxlength="255" type="text" id="title" name="title" placeholder="TITLE" value="<?= $title ?>" required>
                <input class="half-size" maxlength="255" type="text" id="file_name" name="file_name" placeholder="file_name" value="<?= $file_name ?>" required>
            </div>

            <div style="margin-bottom: 10px;">
                <label class="half-size file">
                <input class="input-upload" type="file" id="file_1" name="file_1" aria-label="Choose Main Photo">
                <input type="hidden" id="file_1_path" name="file_1_path" value="/catalog/__image/">
                <span class="file-custom file-custom-main"></span>
                <img class="photopreview <?= $display_show ?>" src="/catalog/__image/<?= $file_name ?>.jpg?<?= date(); ?>" />
                </label>

                <label class="half-size file file-thumb">
                <input class="input-upload"  type="file" id="file_2" name="file_2" aria-label="Choose Main Photo">
                <input type="hidden" id="file_2_path" name="file_2_path" value="/catalog/__thumbnail/">
                <span class="file-custom file-custom-thumbnail"></span>
                <img class="photopreview photopreviewthumb <?= $display_show ?>" src="/catalog/__thumbnail/<?= $file_name ?>.jpg?<?= date(); ?>" />
                </label>
            </div>

            <div>
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
                <select id="as_gallery" name="as_gallery">
                    <option value="1" <?= ($as_gallery == "1" ? "SELECTED" : ""); ?>>as GALLERY EDITION</option>
                    <option value="0" <?= ($as_gallery == "0" ? "SELECTED" : ""); ?>>no (GALLERY EDITION)</option>
                </select> 
                </div>

                <div class="select-wrapper half-size">
                <select id="as_studio" name="as_studio">
                    <option value="1" <?= ($as_studio == "1" ? "SELECTED" : ""); ?>>as STUDIO EDITION</option>
                    <option value="0" <?= ($as_studio == "0" ? "SELECTED" : ""); ?>>no (STUDIO EDITION)</option>
                </select> 
                </div>

            </div>
            <div>
                <div class="select-wrapper half-size">
                <select id="as_tinyviews" name="as_tinyview">
                    <option value="1" <?= ($as_tinyview == "1" ? "SELECTED" : ""); ?>>as TINYVIEWS EDITION</option>
                    <option value="0" <?= ($as_tinyview == "0" ? "SELECTED" : ""); ?>>no (TINYVIEWS EDITION)</option>
                </select> 
                </div>

                <div class="select-wrapper half-size">
                <select id="as_open" name="as_open">
                    <option value="1" <?= ($as_open == "1" ? "SELECTED" : ""); ?>>as OPEN EDITION</option>
                    <option value="0" <?= ($as_open == "0" ? "SELECTED" : ""); ?>>no (OPEN EDITION)</option>
                </select> 
                </div>

            <div>
                <div class="half-size">
                    <input  type="text" id="print_media" name="print_media" placeholder="PRINT MEDIA: PAPER, ACRYLIC" value="<?= $print_media ?>">
                </div>
                <div class="select-wrapper half-size">
                <select id="on_display" name="on_display">
                    <option value="0">on Display (Select Location)</option>
                    <?= $location_html ?>
                </select> 
                </div>
            </div>
            
            <div>
                <h6>Photo Meta Data</h6>
                <div class="select-wrapper half-size">
                <select id="orientation" name="orientation">
                    <option value="landscape" <?= ($orientation == "landscape" ? "SELECTED" : ""); ?>>Landscape</option>
                    <option value="portrait" <?= ($orentation == "portrait" ? "SELECTED" : ""); ?>>Portrait</option>
                </select> 
                </div>
                <div class="half-size">
                <input type="text" id="date_taken" name="date_taken" placeholder="DATE TAKEN" value="<?= $date_taken ?>">
                </div>
            <div>

            <div>
                <div class="select-wrapper half-size">
                <select id="camera" name="camera">
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
                    <option value="Tamron SP 85mm F/1.8 Di VC USD" <?= ($lens_model == "Tamron SP 85mm F/1.8 Di VC USD" ? "SELECTED" : ""); ?>>Tamron SP 85mm F/1.8 Di VC USD</option>
                    <option value="Tamron SP 15-30mm f/2.8 Di VC USD G2" <?= ($lens_model == "Tamron SP 15-30mm f/2.8 Di VC USD G2" ? "SELECTED" : ""); ?>>Tamron SP 15-30mm f/2.8 Di VC USD G2</option>
                    <option value="Tamron SP 24-70mm f/2.8 Di VC USD G2" <?= ($lens_model == "Tamron SP 24-70mm f/2.8 Di VC USD G2" ? "SELECTED" : ""); ?>>Tamron SP 24-70mm f/2.8 Di VC USD G2</option>
                    <option value="Tamron SP 70-200mm f/2.8 Di VC USD G2" <?= ($lens_model == "Tamron SP 70-200mm f/2.8 Di VC USD G2" ? "SELECTED" : ""); ?>>Tamron SP 70-200mm f/2.8 Di VC USD G2</option>
                    <option value="Tamron SP 70-300mm f/4-5.6 Di VC USD" <?= ($lens_model == "Tamron SP 70-300mm f/4-5.6 Di VC USD" ? "SELECTED" : ""); ?>>Tamron SP 70-300mm f/4-5.6 Di VC USD</option>
                    <option value="Nikon 24-85mm f/3.5-4.5G ED VR" <?= ($lens_model == "Nikon 24-85mm f/3.5-4.5G ED VR" ? "SELECTED" : ""); ?>>Nikon 24-85mm f/3.5-4.5G ED VR</option>
                    <option value="Nikon 50mm ED VR" <?= ($lens_model == "Nikon 50mm ED VR" ? "SELECTED" : ""); ?>>Nikon 50mm ED VR</option>
                    <option value="Rokinon 14mm f/2.8 MF" <?= ($lens_model == "Rokinon 14mm f/2.8 MF" ? "SELECTED" : ""); ?>>Rokinon 14mm f/2.8 MF</option>
                </select>
                </div>
            <div>

            <div>
                <input class="half-size" type="text" id="aperture" name="aperture" placeholder="APERTURE" value="<?= $aperture ?>">
                <input class="half-size" type="text" id="shutter" name="shutter" placeholder="SHUTTER" value="<?= $shutter ?>">
            </div>
            <div>
                <input class="half-size" type="text" id="focal_length" name="focal_length" placeholder="FOCAL LENGTH" value="<?= $focal_length ?>">
                <input class="half-size" type="text" id="iso" name="iso" placeholder="ISO" value="<?= $iso ?>">
            </div>

            <button id="sendform" value="SEND"><?= $button_label ?></button>
            <?= $button_archive_cancel ?>
            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){
    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#sendform');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#catalog-add').submit();             
          } 
        });
    });

    $('#title').on('keyup', function() {
        $('#file_name').val($('#title').val().toLowerCase().replace(/\s+/g, "-"));
    });
});
</script>