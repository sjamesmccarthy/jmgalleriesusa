<?php 

    /* FILMSTRIP: GALLERY THUMBS */
    $you_may_also_like_html = $this->component('most_popular');
    
    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    
    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo('0',$this->photo_path);
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
    // {"5x7":"20","8x8":"40","8x12":"60","12x12":"80","12x18":"120","5x7NC": "30"}

    $le_price_array = json_decode($this->config->le_pricing, true);
    // {"16x24": "1350","20x30": "1800","24x36": "2500","30x45": "3850","40x60": "6450"}

    /* Determine if the "TinyViews photo exists */
     if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-tinyviews.jpg') && $photo_meta['as_gallery'] == "0" ) {

        $tinyviewImage = '<div class="col"><img class="in-room-img"  src="/catalog/__image/' . $photo_meta['file_name'] . '-tinyviews.jpg" /><!-- <div class="bx-buyart-btn"><a target="_shop" href="/shop">tinyViews&trade; Edition &mdash; Shop Now</a></div>--></div>';
        $tinyviewSquareOption = '<option data-price="' . $tv_price_array['8x8'] . '" value="8x8">SIZE: SQUARE 8x8</option>';
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

        if($tv == 1) {
             $tinyViewFinePrint = '<div class="col-12"><p class="tiny">*Frames, envelopes, stamps, are not included with a tinyViews&trade; Edition. Sizes may vary from 4x6 to 12x18. Printed on high quality photo paper with a white border unless optionally framed.</p></div>';
        }

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room.jpg') && $photo_meta['as_gallery'] == "0" ) {
        
        $in_roomImg = '<div class="col"><img class="in-room-img" src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /></div>';
    
    } 

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room-alt.jpg') && $photo_meta['as_gallery'] == "0" ) {
        $in_roomImgAlt = '<div class="col"><img class="in-room-img" src="/catalog/__image/' . $photo_meta['file_name'] . '-room-alt.jpg" /></div>';
    } 

    $super_photo = ' 
    <div class="img-container col-12 mb-32 ' . $photo_meta['orientation'] . '">
        <p style="text-align: center">
        <img src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" />
        </p>
    </div>';

 

    $as_editions =  null;
    $as_editions_tmp = null;

    /* If as_GALLERY is set */
    if( $photo_meta['as_gallery'] == 1) {
        $ed_G = true;
        $edition = "limited";
        $catalog_no = $catalog_code . $photo_meta['catalog_photo_id'] . "LE";
        
        // $as_editions_tmp .= "Edition of " . $this->config->limited_edition_max  . " plus 2 Artist Proofs";
        // $edition_desc = $as_editions_tmp . " / $1,000 USD / Handmade and signed with Certificate of Authenticity ";

        $edition_desc = 'LIMITED EDITION';

        $btn = "BUY THIS LIMITED EDITION";
        $btn_link = '<a href="/contact?photo=' . $photo_meta['file_name'] . '">';
        $gallery_details = '<p class="mt-32">Limited Editions are either printed on Hahnemühle Photo Rag® Metallic Fine Art paper mounted in a Premium Designer frame protected with Tru Vue&reg; Museum Glass, or Lumachrome HD Acrylic. If you have any questions about our <a href="/styles">styles, frames and editions</a>, or would like to talk with an art consultant, please <a href="/contact">contact us</a>.</p>';

        $default_price = $le_price_array['16x24'];

        $sizes_frames = '<div class="col select-wrapper" style="width: 300px;  margin-right: 20px;">
            <label for="buysize"></label>
            <select id="buysize" name="buysize">
                <option data-price="' . $le_price_array['16x24'] . '" value="60CM/16x24">SIZE: 60CM (approx. 16x24 inches)</option>
                <option data-price="' . $le_price_array['20x30'] . '" value="76CM/20x30">SIZE: 76CM (approx. 20x30 inches)</option>
                <option data-price="' . $le_price_array['24x36'] . '"value="91CM/24x36">SIZE: 91CM (approx. 24x36 inches)</option>
                <option data-price="' . $le_price_array['30x45'] . '"value="144CM/30x45">SIZE: 144CM (approx. 30x45 inches)</option>
                <option data-price="' . $le_price_array['40x60'] . '"value="152CM/40x60">SIZE: 152CM (approx. 40x60 inches)</option>
            </select>
        </div>
        
        <div class="col select-wrapper" style="width: 300px; margin-right: 20px;">
            <label for="frame"></label>
            <select id="frame" name="frame">
                <option value="Black Vodka">FRAME: Premium Designer Black Vodka (similar to a Dark Black stain)</option>
                <option value="Whiskey">FRAME: Premium Designer Whiskey (similar to a Medium Brown stain)</option>
                <option value="Bourbon">FRAME: Premium Designer Bourbon (similar to a Light Brown stain)</option>
                <option value="Matte Charcoal">FRAME: Premium Designer Matte Charcoal (similar to Matte Black)</option>
            </select>
            <span class="tiny ml-16"><a href="/styles">More information about frame styles</a></span>
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
        $btn = "Add To Cart +Checkout";
        $btn_link = '<a href="/contact?photo=' . $photo_meta['file_name'] . '&open=true">';

        $default_price = $tv_price_array['12x18'];

        $sizes_frames = '<div class="col select-wrapper" style="width: 300px;  margin-right: 20px;">
            <label for="buysize"></label>
            <select id="buysize" name="buysize">
                <option data-price="' . $tv_price_array['5x7'] . '"value="5x7">SIZE: 5x7</option>
                ' . $tinyviewNotesOption . '
                <option data-price="' . $tv_price_array['8x12'] . '"value="8x12">SIZE: 8x12</option>
                <option SELECTED data-price="' . $tv_price_array['12x18'] . '"value="12x18">SIZE: 12x18 </option>
                ' . $tinyviewSquareOption . '
            </select>
        </div>
        
        <div class="col select-wrapper" style="width: 300px; margin-right: 20px;">
            <label for="frame"></label>
            <select id="frame" name="frame">
                <option data-price="0" value="PRINT-ONLY">PRINT (or Giclée) ONLY - NO FRAME</option>
                <option data-price="40" value="ASH-GRAY(+$40)">FRAME: Studio Ash Gray (+$40 USD)</option>
                <option data-price="40" value="SNOW-WHITE(+$40)">FRAME: Studio Snow White (+$40 USD)</option>
            </select>
            <span class="tiny ml-16"><a href="/styles">More information about frame styles and pricing</span>
        </div>
         <input type="hidden" name="edition" value="open" />';

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
    var title = document.title;
    var dbTitle = "<?= $photo_meta['title'] ?>";
    if (document.title != dbTitle) {
        document.title = dbTitle;
    }
</script>
