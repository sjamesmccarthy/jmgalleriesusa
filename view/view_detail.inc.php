<?php 

    /* FILMSTRIP: GALLERY THUMBS */
    $you_may_also_like_html = $this->component('most_popular');
    
    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    
    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo('0',$this->page->photo_path);
    // $this->printp_r($photo_meta);

    switch($photo_meta['parent_collections_id']) {

        case "1":
        $catalog_code = 'OLW';
        break;

        case "2":
        $catalog_code = 'MDT';
        break; 

        case "3":
        $catalog_code = 'AAP';
        break; 

        case "5":
        $catalog_code = 'FFC';
        break; 

        default:
        $catalog_code = 'UNKNOWN_VALUE';

    }

    if(isSet($photo_meta['catalog_photo_id'])) {
        $this->api_Update_Photo_Viewed($photo_meta['catalog_photo_id']);
    }

    $this->catalog_title = ucwords( $photo_meta['catalog_title'] );
    $this->page->title = $photo_meta['title'];
    
    $available_sizes = $photo_meta['available_sizes'];

    $tv_price_array = json_decode($this->config->tv_pricing, true);
    $studio_frames_pricing = json_decode($this->config->studio_frames_pricing, true);

    $le_price_array = json_decode($this->config->le_pricing, true);
    $le_frames_pricing = json_decode($this->config->le_frames_pricing, true);

    /* Determine if the "TinyViews photo exists */
     if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-tinyviews.jpg') && $photo_meta['as_gallery'] == "0" ) {

        $tinyviewImage = '<div class="col"><img class="in-room-img"  src="/catalog/__image/' . $photo_meta['file_name'] . '-tinyviews.jpg" /><!-- <div class="bx-buyart-btn"><a target="_shop" href="/shop">tinyViews&trade; Edition &mdash; Shop Now</a></div>--></div>';
        $tinyviewSquareOption = '<option data-price="' . $tv_price_array['8x8'] . '" ' . 'data-frameprice="' . $studio_frames_pricing['8x8'] . '" value="8x8">SIZE: SQUARE 8x8</option>';
        $tinyviewSquareOption .= '<!-- <option data-price="' . $tv_price_array['12x12'] . '" value="12x12">SIZE: SQUARE 12x12</option> -->';
        $tv=1;
       
     } else {
         $tinyviewImage = null;
         $tv=0;
         $tinyviewSquareOption = null;
     }

     if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-tinyviews-notes.jpg') && $photo_meta['as_gallery'] == "0" ) {

        $tinyviewNotesImage = '<div class="col"><img class="in-room-img"  src="/catalog/__image/' . $photo_meta['file_name'] . '-tinyviews-notes.jpg" /><!-- <div class="bx-buyart-btn"><a target="_shop" href="/shop">tinyViews&trade; Edition &mdash; Shop Now</a></div>--></div>';
        $tinyviewNotesOption = '<option data-price="' . $tv_price_array['5x7NC'] . '" value="NOTECARDS">SIZE: 5x7 NOTECARD/POSTCARD (Set of 3)</option>'; 
        $tv=1;
     } else {
         $tinyviewNotesImage = null;
         $tinyviewNotesOption = null;
         $tv=0;
     }

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room.jpg') && $photo_meta['as_gallery'] == "0" ) {
        $in_roomImg = '<div class="col"><img class="in-room-img" src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /></div>';
        $tv=1;
    } else {
        $in_roomImg = null;
        $tv=0;
    }

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room-alt.jpg') && $photo_meta['as_gallery'] == "0" ) {
        $in_roomImgAlt = '<div class="col"><img class="in-room-img" src="/catalog/__image/' . $photo_meta['file_name'] . '-room-alt.jpg" /></div>';
        $tv=1;
    } else {
        $in_roomImgAlt = null;
        $tv=0;
    }

    if($tv == 1) {
         $tv_img_disclaimer = '*Frames, envelopes, stamps, plants and pens are not included with any tinyViews&trade; Edition.';
    } else {
        $tv_img_disclaimer = null;
    }

    $super_photo = ' 
    <div class="img-container col-12 mb-32 ' . $photo_meta['orientation'] . '">
        <p style="text-align: center">
        <img src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" />
        </p>
    </div>';

    $as_editions =  null;
    $as_editions_tmp = null;

    
    if ($photo_meta['desc'] != null) {

        if ($photo_meta['desc'] == 'paper') {
            $edition_desc_material = 'Hahnemühle Photo Rag® Metallic Fine Art Paper';
            $frame_disabled_option = '<option value="FRAMEINCLUDED">Select a Frame (Included In Price)</option>';
        } 

        if ($photo_meta['desc'] == 'acrylic') {
            $edition_desc_material = 'Lumachrome HD Acrylic';
            $frame_disabled = 'disabled';
            $frame_disabled_option = '<option value="FRAMELESS">No Frame Included With Acrylic</option><option value="ADDWITHACRYLIC">+ Add Additional Frame (Please Specify Color In Order Form)</option>';
            $frame_info_link = 'Premium Designer Frames pricing';
        } 

        $edition_desc_material_slash = '/ ' . $edition_desc_material;
    } else {

        if ($photo_meta['as_open'] != 1) {
            $edition_desc_material_slash = '/ ' . 'Collectors Choice of Fine Art Paper or Acrylic';
            $edition_desc_material = 'Hahnemühle Photo Rag® Metallic Fine Art Paper (including frame) or Lumachrome HD Acrylic (frame additional)';
            $frame_info_link = 'the Premium Designer Frames';
        } else {
            $edition_desc_material_slash = null;
            $frame_info_link = 'the Premium Designer Frames';
        }
    }


    /* If as_GALLERY is set */
    if( $photo_meta['as_gallery'] == 1) {
        $ed_G = true;
        $edition = "limited";
        $catalog_no = $catalog_code . $photo_meta['catalog_photo_id'] . "LE";
        
        $edition_desc = 'LIMITED EDITION';
        $edition_max  = ' OF ' . $this->config->limited_edition_max;

        $btn = "BUY ARTWORK";
        $btn_link = '<a class="btn-nudge";" href="/contact?photo=' . $photo_meta['file_name'] . '">';
        $gallery_details = '<p class="col-12"><!-- Limited Editions are either printed on ' . $edition_desc_material . ' mounted in a Premium Designer frame and protected with Tru Vue&reg; Museum Glass, or Lumachrome HD Acrylic without framing. -->If you have any questions about our Lumachrome HD Acrylic, Hahnemühle Photo Rag® Metallic Archival Paper, or <a href="/styles">styles, frames and editions</a>, please <a href="/contact">contact our art consultants</a>.</p>';

        $default_price = $le_price_array['16x24'];

        $sizes_frames = '<div class="col-4_sm-12 select-wrapper"> <!-- style="width: 300px;  margin-right: 20px;" -->
            <label for="buysize"></label>
            <select id="buysize" name="buysize">
                <option data-price="' . $le_price_array['16x24'] . '" value="60CM/16x24">SIZE: 60CM (approx. 16x24 inches)</option>
                <option data-price="' . $le_price_array['20x30'] . '" value="76CM/20x30">SIZE: 76CM (approx. 20x30 inches)</option>
                <option data-price="' . $le_price_array['24x36'] . '"value="91CM/24x36">SIZE: 91CM (approx. 24x36 inches)</option>
                <option data-price="' . $le_price_array['30x45'] . '"value="144CM/30x45">SIZE: 144CM (approx. 30x45 inches)</option>
                <option data-price="' . $le_price_array['40x60'] . '"value="152CM/40x60">SIZE: 152CM (approx. 40x60 inches)</option>
            </select>
        </div>
        
        <div class="col-4_sm-12 select-wrapper"> <!-- style="width: 300px; margin-right: 20px;" -->
            <label for="frame"></label>
            <select id="frame" name="frame">
                ' . $frame_disabled_option . '
                <option value="Black Vodka"' . $frame_disabled . '>FRAME: Premium Designer Black Vodka (similar to a Dark Black stain)</option>
                <option value="Whiskey"' . $frame_disabled . '>FRAME: Premium Designer Whiskey (similar to a Medium Brown stain)</option>
                <option value="Bourbon"' . $frame_disabled . '>FRAME: Premium Designer Bourbon (similar to a Light Brown stain)</option>
            </select>
            <!-- <span class="tiny ml-16"><a href="/styles">More information about ' . $frame_info_link . '</a></span> -->
        </div>
        <input type="hidden" name="edition" value="limited" />';

    }
    
    /* If as_OPEN is set */
    if( $photo_meta['as_open'] == 1) {
        $ed_O = true;
        $edition = "tinyviews";
        $catalog_no = $catalog_code . $photo_meta['catalog_photo_id'] . "OT";

        // if($ed_G === true || $ed_S === true) { $as_editions_tmp .= ", "; }
        // $as_editions_tmp .= "";

        $edition_desc = $this->config->edition_description_open;
        $edition_desc_material_slash = null;
        $edition_max = null;

        $btn = "BUY ARTWORK";
        $btn_link = '<a class="btn-nudge" href="/contact?photo=' . $photo_meta['file_name'] . '&open=true">';

        $default_price = $tv_price_array['11x14'];

        $sizes_frames = '<div class="col-4_sm-12 select-wrapper"> <!-- style="max-width: 300px;  margin-right: 20px;" --> 
            <label for="buysize"></label>
            <select id="buysize" name="buysize">
                <option data-price="' . $tv_price_array['5x7'] . '" ' . 'data-frameprice="0" value="5x7">SIZE: 5x7</option>
                ' . $tinyviewNotesOption . '
                <option data-price="' . $tv_price_array['8x10'] . '" ' . 'data-frameprice="' . $studio_frames_pricing['8x10'] . '" value="8x10">SIZE: 8x10</option>
                <option SELECTED data-price="' . $tv_price_array['11x14'] . '" data-frameprice="' . $studio_frames_pricing['11x14'] . '" value="11x14">SIZE: 11x14 </option>
                ' . $tinyviewSquareOption . '
            </select>
        </div>
        
        <!-- style="width: 300px; margin-right: 20px; -->
        <div class="col-4_sm-12 select-wrapper">
            <label for="frame"></label>
            <select id="frame" name="frame">
                <option value="PRINT-ONLY">PRINT (or Giclée) ONLY - NO FRAME</option>
                <option value="Studio-Ash-Gray">FRAME: Studio Ash Gray</option>
                <option value="Studio-Snow-White">FRAME: Studio Snow White</option>
            </select>
            <span class="tiny ml-16"><a href="/styles">More information about frame styles and pricing</span>
        </div>
         <input type="hidden" name="edition" value="open" />';

         $tinyViewFinePrint = '<div class="col-12 mb-64 ml-8"><p>tinyViews&trade; Giclée Prints are available in standard framing sizes 5x7, 8x10 and 11x14 with a 1/2" white border ready for framing. Please read our <a target="_info" href="/styles">Frames, Editions and Pricing</a> page for more information about our Studio Frames for tinyViews&trade; Giclée Prints.' . $tv_img_disclaimer . '</p></div>';

    }

    // $as_editions = $as_editions_tmp;
    $catalog_no_hidden = "<input type='hidden' name='catalog_no' value='" . $catalog_no . "' />";
 
    /* Photo orientation */
    if($photo_meta['orientation'] == "portrait") {
        $img_w = '64%';
        $grid = '-11';
        $col_left = 'col-6';
        $col_right = 'col-5';
    } else {
        $img_w = '100%';
        $grid='-11';
        $col_left = 'col-7';
        $col_right = 'col-4';
    }

    /* FORMAT EXIF DATA */
    if($photo_meta['aperture'] != '' && $photo_meta['lens_model'] != '') {

        $exif_data = '<div class="col-11 pb-8">';
        $exif_data .= '<p class="pt-16 field-notes">';

        $exif_data .= "Field Notes: "
            . $photo_meta['camera'] . ", "
            . $photo_meta['lens_model'] . ", "
            . $photo_meta['aperture'] . ", "
            . $photo_meta['shutter'];

            if($photo_meta['loc_waypoint'] != '') {
                $exif_data .= " @ " . $photo_meta['loc_waypoint'];
            }

        $exif_data .= '</p>';
        $exif_data .= '</div>';

    }

?>

<script>
    // var title = document.title;
    // var dbTitle = "<?= $photo_meta['title'] ?>";
    // if (document.title != dbTitle) {
    //     document.title = dbTitle;
    // }
</script>
