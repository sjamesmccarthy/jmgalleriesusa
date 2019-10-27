<?php 

    /* FILMSTRIP: GALLERY THUMBS */
    $you_may_also_like_html = $this->component('most_popular');
    
    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    
    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo($this->photo_path);
    $this->api_Update_Photo_Viewed($photo_meta['catalog_photo_id']);

    $this->catalog_title = ucwords( $photo_meta['category_title'] );
    $this->page->title = $photo_meta['title'];
    
    $available_sizes = preg_replace("/tinyViews Edition/i", "<a href='/shop'>tinyViews&trade; Edition</a>", $photo_meta['available_sizes']);

    /* Determine if the "TinyViews photo exists */
     if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-tinyviews.jpg') ) {

        $tinyviewImage = '<div><img src="/catalog/__image/' . $photo_meta['file_name'] . '-tinyviews.jpg" /><div class="bx-buyart-btn"><a target="_shop" href="/shop"><button>BUY  TINYVIEWS&trade; EDITION</button></a></div></div>';
     } else {
         $tinyviewImage = null;
     }

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room.jpg') ) {
           
            if($photo_meta['orientation'] == "landscape") {
                 $super_photo = ' 
                <div class="slider">
                <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /><div class="bx-buyart-btn"><a href="/contact?photo=' . $photo_meta['file_name'] . '"><button>BUY FINE-ART EDITION</button></a></div></div>
                <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" /></div>' . $tinyviewImage . '</div>';
            } else {
                $super_photo = ' 
                <div class="slider">
                    <div class="col"> 
                    <img class="bx-img-portrait" src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /><div class="bx-buyart-btn"><a href="/contact?photo='. $photo_meta['file_name'] . '"><button>BUY FINE-ART EDITION</button></a></div></div>
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
        $desc = "This Fine-Art Edition is printed on Acrylic and includes an inset frame. Read more about <a href=\"/styles\">our pricing, editions and other framing options.<a/>";
    }

    /* If ON_DISPLAY is set */
    if( $photo_meta['on_display'] != 0) {

        /* Make API query to get location */
        $photo_meta_location = $this->api_Catalog_Photo_Meta_Location($photo_meta['on_display']);

        $on_display = '
        <div class="flexfix">&nbsp;</div>
        <div class="edition-extra">
                <a href="/exhibits"><img src="/view/image/icon_geo.svg" /></a>
            </div>
            <div class="edition-extra-subline">
                <a href="/contact"><b>See It</b></a><br />
                <span>This art is available to view<br />at <a href="/exhibits">' . $photo_meta_location['location'] . '</a> in ' . $photo_meta_location['city'] . ', ' . $photo_meta_location['state'] . '</span>
            </div>';
    } else {
        $on_display = null;
    }

    /* If IN_SHOP is set */
    if( $photo_meta['in_shop'] != 0) {

        /* Make API query to get location */
        $photo_meta_location = $this->api_Catalog_Photo_Meta_Location($photo_meta['on_display']);

        $in_shop = '
        <div class="flexfix">&nbsp;</div>
        <div class="edition-extra">
                <a target="_shop" href="/shop"><img src="/view/image/icon_cart.svg" /></a>
            </div>
            <div class="edition-extra-subline">
                <a target="_shop" href="/shop"><b>Buy Open Edition Print</b></a><br />
                <span>This art is available as an unsigned <a href="/styles">open-edition print</a>.</span>
            </div>';
    } else {
        $in_shop = null;
    }

    /* If AS_TINYVIEW is set */
    if( $photo_meta['as_tinyview'] != 0) {
        $as_tinyview = ' and as <a target="_shop" href="/shop">TinyViews&trade;</a>';
    } else {
        $as_tinyview = null;
    }

    if($photo_meta['orientation'] == "portrait") {
        $img_w = '90%';
        $grid = '10-center';
        $col_left = 'col-5';
        $col_right = 'col-5';
    } else {
        $img_w = '100%';
        $grid='11-center';
        $col_left = 'col-7';
        $col_right = 'col-4';
    }

    /* FORMAT EXIF DATA */
    if($photo_meta['aperture'] != '' && $photo_meta['lens_model'] != '') {
        $exif_data = "Field Notes: "
            . $photo_meta['camera'] . ", "
            . $photo_meta['lens_model'] . ", "
            . $photo_meta['aperture'] . ", "
            . $photo_meta['shutter'];
    }

    if($photo_meta['loc_waypoint'] != '') {
        $exif_data .= " @ " . $photo_meta['loc_waypoint'];
    }
?>

<script>
    var title = document.title;
    var dbTitle = "<?= $photo_meta['title'] ?>";
    if (document.title != dbTitle) {
        document.title = dbTitle;
    }
</script>
