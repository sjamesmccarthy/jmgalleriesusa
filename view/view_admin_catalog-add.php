<section class="admin--catalog-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog-add--container">

            <h2 class="pb-32">Add New Photo To Catalog</h2>

            <h1><?= $formTitle ?></h1>
            <p class="blue pb-16 "><?= strtoupper($subTitle); ?></p>

            <form id="catalog-add" action="/view/ajax_admin_catalog-add.php" method="POST">
            <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />

            <div>
                <div class="select-wrapper half-size">
                <select id="photocategory" name="photocategory">
                    <option value="CATEGORY">CATEGORY</option>
                    <option value="---">---</option>
                    <?= $category_html ?>
                </select> 
                </div>
                <div class="select-wrapper half-size">
                <select id="photostatus" name="photostatus">
                    <option value="1" SELECTED>STATUS (ACTIVE)</option>
                    <option value="0">STATUS (DISABLED)</option>
                </select> 
                </div>
            </div>

            <div>
                <input class="half-size" maxlength="255" type="text" id="phototitle" name="phototitle" placeholder="TITLE" value="" required>
                <input class="half-size" maxlength="255" type="text" id="photofilename" name="photofilename" placeholder="file_name" value="" required>
            </div>

            <div style="margin-bottom: 10px;">
                <label class="half-size file">
                <input class="input-upload" type="file" id="file_main" aria-label="Choose Main Photo">
                <span class="file-custom file-custom-main"></span>
                <img class="photopreviewmain" src="/catalog/__image/happy-hour-club.jpg" />
                </label>

                <label class="half-size file file-thumb">
                <input class="input-upload"  type="file" id="file_thumbnail" aria-label="Choose Main Photo">
                <span class="file-custom file-custom-thumbnail"></span>
                <img class="photopreviewmain" src="/catalog/__thumbnail/happy-hour-club.jpg" />
                </label>
            </div>

            <div>
                <input class="half-size"  type="text" id="photolocationplace" name="photolocationplace" placeholder="LOCATION PLACE" value="" required>
                <input class="half-size" type="text" id="photolocationwaypoint" name="photolocationwaypoint" placeholder="LOCATION WAYPOINT" value="">
            </div>
            <div>
                <input class="half-size" type="text" id="photolocationcity" name="photolocationcity" placeholder="LOCATION CITY" value="" required>
                <input class="half-size" type="text" id="photolocationstate" name="photolocationstate" placeholder="LOCATION STATE" value="" required>
            </div>
            <div>
                <h6>And, so the story goes ...</h6>
                <textarea required></textarea>
                <input type="text" id="phototags" name="phototags" placeholder="#TAGS" value="" required>
            </div>

            <div>
                <h6>Available Editions</h6>

                <div class="select-wrapper half-size">
                <select id="photoasgallery" name="photoasgallery">
                    <option value="1">as GALLERY EDITION</option>
                    <option value="0">no (GALLERY EDITION)</option>
                </select> 
                </div>

                <div class="select-wrapper half-size">
                <select id="photosasstudio" name="photosasstudio">
                    <option value="1">as STUDIO EDITION</option>
                    <option value="0">no (STUDIO EDITION)</option>
                </select> 
                </div>

            </div>
            <div>
                <div class="select-wrapper half-size">
                <select id="photoastinyviews" name="photoastinyviews">
                    <option value="1">as TINYVIEWS EDITION</option>
                    <option value="0" SELECTED>no (TINYVIEWS EDITION)</option>
                </select> 
                </div>

                <div class="select-wrapper half-size">
                <select id="photoasopen" name="photoasopen">
                    <option value="1">as OPEN EDITION</option>
                    <option value="0" SELECTED>no (OPEN EDITION)</option>
                </select> 
                </div>

            <div>
                <!-- <input type="text" id="photoavailablesizes" name="photoavailablesizes" placeholder="AVAILABLE SIZES DETERMINED BY EDITIONS"> -->
                <input type="text" id="photoprintmedia" name="photoprintmedia" placeholder="PRINT MEDIA: PAPER, ACRYLIC">
            </div>

            <div>
                <h6>On Display</h6>
                <div class="select-wrapper half-size">
                <select id="photoondisplay" name="photoondisplay">
                    <option value="1">yes (on Display)</option>
                    <option value="0" SELECTED>no (on Display)</option>
                </select> 
                </div>
                <div class="select-wrapper half-size">
                <select id="photoondisplaylocation" name="photoondisplaylocation">
                    <option value="-">SELECT LOCATION</option>
                    <?= $location_html ?>
                </select> 
                </div>
            <div>
            
            <div>
                <h6>Photo Meta Data</h6>
                <div class="select-wrapper half-size">
                <select id="photometaorientation" name="photometaorientation">
                    <option value="landscape" SELECTED>Landscape</option>
                    <option value="portrait">Portrait</option>
                </select> 
                </div>
                <div class="half-size">
                <input type="text" id="photometadatetaken" name="photometadatetaken" placeholder="DATE TAKEN" value="" required>
                </div>
            <div>

            <div>
                <div class="select-wrapper half-size">
                <select id="photometacamera" name="photometacamera">
                    <option value="Nikon D810" SELECTED>Nikon D810</option>
                    <option value="Nikon D600">Nikon D600</option>
                    <option value="Nikon D5200">Nikon D5200</option>
                    <option value="Nikon 1 V1">Nikon 1 V1</option>
                    <option value="Ricoh GR II">Ricoh GR II</option>
                </select> 
                </div>
                <div class="select-wrapper half-size">
                <select id="photometalens" name="photometalens">
                    <option value="-">LENS</option>
                    <option value="1">Tamron SP 85mm F/1.8 Di VC USD</option>
                    <option value="1">Tamron SP 15-30mm f/2.8 Di VC USD G2</option>
                    <option value="1">Tamron SP 24-70mm f/2.8 Di VC USD G2</option>
                    <option value="1">Tamron SP 70-200mm f/2.8 Di VC USD G2</option>
                    <option value="1">Tamron SP 70-300mm f/4-5.6 Di VC USD</option>
                    <option value="0">Nikon 24-85mm f/3.5-4.5G ED VR</option>
                    <option value="0">Nikon 50mm ED VR</option>
                    <option value="0">Rokinon 14mm f/2.8 MF</option>
                </select>
                </div>
            <div>

            <div>
                <input class="half-size" type="text" id="photometaaperture" name="phototitlphotometaaperturee" placeholder="APERTURE" value="" required>
                <input class="half-size" type="text" id="photometashutter" name="photometashutter" placeholder="SHUTTER" value="" required>
            </div>
            <div>
                <input class="half-size" type="text" id="photometafocallength" name="photometafocallength" placeholder="FOCAL LENGTH" value="" required>
                <input class="half-size" type="text" id="photometaiso" name="photometaiso" placeholder="ISO" value="">
            </div>

            <button id="sendform" value="SEND"><?= $button_label ?></button>
            <button class="btn-delete" id="deletePhoto" value="ARCHIVE">ARCHIVE</button>
            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>