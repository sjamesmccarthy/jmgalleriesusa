<?php 

    /* FILMSTRIP: GALLERY THUMBS */
    $you_may_also_like_html = $this->component('most_popular');
    
    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    
    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo($this->photo_path);
    $this->api_Update_Photo_Viewed($photo_meta['catalog_photo_id']);

    // $this->printp_r($photo_meta);

    $this->catalog_title = ucwords( $photo_meta['category_title'] );
    $this->page->title = $photo_meta['title'];
    
    // $available_sizes = preg_replace("/tinyViews Edition/i", "<a href='/shop'>tinyViews&trade; Edition</a>", $photo_meta['available_sizes']);
    $available_sizes = $photo_meta['available_sizes'];

    /* Determine if the "TinyViews photo exists */
     if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-tinyviews.jpg') ) {

        $tinyviewImage = '<div><img src="/catalog/__image/' . $photo_meta['file_name'] . '-tinyviews.jpg" /><div class="bx-buyart-btn"><a target="_shop" href="/shop"><button>Shop  tinyViews&trade;</button></a></div></div>';
     } else {
         $tinyviewImage = null;
     }

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room.jpg') ) {
           
            if($photo_meta['orientation'] == "landscape") {
                 $super_photo = ' 
                <div class="slider">
                <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /><div class="bx-buyart-btn"><a href="/contact?photo=' . $photo_meta['file_name'] . '"><button>Buy Now</button></a></div></div>
                <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" /></div>' . $tinyviewImage . '</div>';
            } else {
                $super_photo = ' 
                <div class="slider">
                    <div class="col"> 
                    <img class="bx-img-portrait" src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /><div class="bx-buyart-btn"><a href="/contact?photo='. $photo_meta['file_name'] . '"><button>Buy Now</button></a></div></div>
                ' . $tinyviewImage . '</div>';
            }

    } else {
        $super_photo = ' 
            <div class="slider">
                <div class="col lg-img">
                    <img src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" />
                </div>
            ' . $tinyviewImage . '
            </div>';
    }

    /* If there is no custom DESC available */
    if( is_null($photo_meta['desc']) ) {
        $desc = "The <a href=\"/styles\">Gallery Edition</a> is printed on Acrylic and includes an inset frame. The <a href=\"/styles\">Studio Edition</a> is a print-only. The <a href=\"/styles\">tinyViews&trade; Edition</a> are square cropped versions of select Gallery and Studio Editions. Not all photographs are available in every edition. <!-- <br /><br />Read more about <a href=\"/styles\">our styles, editions, pricing and framing options.<a/> -->";
    }

    $as_editions =  null;
    $as_editions_tmp = null;

    /* If as_GALLERY is set */
    if( $photo_meta['as_gallery'] == 1) {
        $ed_G = true;
        $as_editions_tmp .= "<a href='/styles'>Gallery Edition</a>{print_media}";
    }
    
    /* If as_STUDIO is set */
    if( $photo_meta['as_studio'] == 1) {
        $ed_S = true;
        if($ed_G === true) { $as_editions_tmp .= ", "; }
        $as_editions_tmp .= "<a href='/styles'>Studio Edition</a>";
    }

    /* If as_OPEN is set */
    if( $photo_meta['as_open'] == 1) {
        $ed_O = true;
        if($ed_G === true || $ed_S === true) { $as_editions_tmp .= ", "; }
        $as_editions_tmp .= "<a href='/styles'>Open Edition";
    }

    /* If as_TINYVIEWS is set */
    if( $photo_meta['as_tinyview'] == 1) {
        $ed_T = true;
        if($ed_G === true || $ed_S === true || $ed_O === true) { $as_editions_tmp .= " , "; }
        $as_editions_tmp .= " <a target='_shop' href='/shop'>tinyViews&trade; Edition</a><!-- &mdash; <a target='_shop'  href='shop'>shop now</a>. -->";
    }

    // $as_editions_tmp .= "</a>";

    /* String replace {print_media} with material */
    switch ($photo_meta['print_media']) {
        case "paper":
            $print_media = " printed on museum grade archival paper and mounted in a premium frame protected with ArtGlass&reg; ";
            break;

        case "acrylic":
            $print_media = " printed on museum grade Acrylic with a 6mm Komatex backing with inset frame ";
            break;

        default:
            $print_media = null;
            break;
    }

     $as_editions_tmp = preg_replace("/{print_media}/i", $print_media, $as_editions_tmp);

    $as_editions = preg_replace("/,([^,]+)$/", " as well as available in a $1", $as_editions_tmp);

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

    /* If IN_SHOP is set 
    if( $photo_meta['in_shop'] != 0) {

        /* Make API query to get location
        $photo_meta_location = $this->api_Catalog_Photo_Meta_Location($photo_meta['on_display']);

        $in_shop = '
        <div class="flexfix">&nbsp;</div>
        <div class="edition-extra">
                <a target="_shop" href="/shop"><img src="/view/image/icon_cart.svg" /></a>
            </div>
            <div class="edition-extra-subline">
                <p>
                <a target="_shop" href="/shop">Buy Open Edition Print</a><br />
                <span>This art is available as an unsigned <a href="/styles">open-edition print</a>.</span>
                </p>
            </div>';
    } else {
        $in_shop = null;
    }
    */

    /* If AS_TINYVIEW is set */
    if( $photo_meta['as_tinyview'] != 0) {
        $as_tinyview = ' as well as <a target="_shop" href="/shop">tinyViews&trade;</a>';
    } else {
        $as_tinyview = null;
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
