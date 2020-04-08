<?php 

    /* FILMSTRIP: GALLERY THUMBS */
    $you_may_also_like_html = $this->component('most_popular');
    
    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    
    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo('0',$this->photo_path);
    // $this->printp_r($photo_meta);

    if(isSet($photo_meta['catalog_photo_id'])) {
        $this->api_Update_Photo_Viewed($photo_meta['catalog_photo_id']);
    }

    $this->catalog_title = ucwords( $photo_meta['catalog_title'] );
    $this->page->title = $photo_meta['title'];
    
    // $available_sizes = preg_replace("/tinyViews Edition/i", "<a href='/shop'>tinyViews&trade; Edition</a>", $photo_meta['available_sizes']);
    $available_sizes = $photo_meta['available_sizes'];

    /* Determine if the "TinyViews photo exists */
     if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-tinyviews.jpg') ) {

        $tinyviewImage = '<div class="col"><img class="in-room-img"  src="/catalog/__image/' . $photo_meta['file_name'] . '-tinyviews.jpg" /><!-- <div class="bx-buyart-btn"><a target="_shop" href="/shop">tinyViews&trade; Edition &mdash; Shop Now</a></div>--></div>';
     } else {
         $tinyviewImage = null;
     }

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room.jpg') ) {
        
        $in_roomImg = '<div class="col"><img class="in-room-img" src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /></div>';
    
    }

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room-alt.jpg') ) {
        $in_roomImgAlt = '<div class="col"><img class="in-room-img" src="/catalog/__image/' . $photo_meta['file_name'] . '-room-alt.jpg" /></div>';
    } else {
        // print "image: " . $_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room-alt.jpg' . "--NOT FOUND";
    }

    // } else {

    $super_photo = ' 
    <div class="col-12 mb-32 ' . $photo_meta['orientation'] . '">
        <p style="text-align: center">
        <img src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" />
        </p>
    </div>';
    // }    

    /* If there is no custom DESC available */
    if( is_null($photo_meta['desc']) ) {
        $desc = "The <a href=\"/styles\">Gallery Edition</a> is printed on Acrylic and includes an inset frame. The <a href=\"/styles\">Studio Edition</a> is a print-only. The <a href=\"/styles\">tinyViews&trade; Edition</a> are square cropped versions of select Gallery and Studio Editions. Not all photographs are available in every edition. <!-- <br /><br />Read more about <a href=\"/styles\">our styles, editions, pricing and framing options.<a/> -->";
    }

    $as_editions =  null;
    $as_editions_tmp = null;

    /* If as_GALLERY is set */
    if( $photo_meta['as_gallery'] == 1) {
        $ed_G = true;
        // $as_editions_tmp .= "Gallery{print_media}";
        $as_editions_tmp .= "Edition of " . $this->config->limited_edition_max  . " plus 2 Artist Proofs";
        $edition_desc = $as_editions_tmp . " / $1,000 USD / Handmade and signed with Certificate of Authenticity ";
        $btn = "BUY THIS LIMITED EDITION";
        $btn_link = '<a href="/contact?photo=' . $photo_meta['file_name'] . '">';
        $gallery_details = '<p class="mt-16">Each piece of artwork comes ready-to-hang, framed in a handmade dark walnut frame with Tru Vue Museum Glass protecting the print. The price displayed under the art title reflects a 16x24 image size, framed piece of art. For additional information read more about our <a href="/styles">pricing and edition sizes</a> or <a href="/contact">contact us.</a></p>';
    }
    
    /* If as_OPEN is set */
    if( $photo_meta['as_open'] == 1) {
        $ed_O = true;
        if($ed_G === true || $ed_S === true) { $as_editions_tmp .= ", "; }
        $as_editions_tmp .= "";
        $edition_desc = 'tinyViews&trade; Edition &mdash; Available in 4x6, 8x8 and 8x10 Print Only.<br />Not part of a numbered edition. Frame not included, but available at an additional cost.';
        $btn = "BUY tinyViews&trade; NOW";
        $btn_link = '<a href="/contact?photo=' . $photo_meta['file_name'] . '&open=true">';
    }

    $as_editions = $as_editions_tmp;

    /* If ON_DISPLAY is set */
    if( $photo_meta['on_display'] != 0) {

        /* Make API query to get location */
        $photo_meta_location = $this->api_Catalog_Photo_Meta_Location($photo_meta['on_display']);

        $on_display = '
        <div class="flexfix">&nbsp;</div>
            <!-- <div class="edition-extra">
                <a href="/exhibits"><img src="/view/image/icon_geo.svg" /></a>
            </div> -->
            <div class="edition-extra-subline">
                <p>
                <!-- <a href="/contact">See It</a><br /> -->
                <span>This art is available to view<br />at <a href="/exhibits">' . $photo_meta_location['location'] . '</a> in ' . $photo_meta_location['city'] . ', ' . $photo_meta_location['state'] . '</span>
                </p>
            </div>';
    } else {
        $on_display = null;
    }

 
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
