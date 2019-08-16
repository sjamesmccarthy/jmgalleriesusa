<?php 

    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    
    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo($this->photo_path);

    $this->catalog_title = ucwords( $photo_meta['category_title'] );
    $this->page->title = $photo_meta['title'];
    
    $available_sizes = preg_replace("/tinyViews Edition/i", "<a href='/shop'>tinyViews&trade; Edition</a>", $photo_meta['available_sizes']);

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room.jpg') ) {
        $super_photo = ' 
            <div class="slider">
                <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" /></div>
                <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /><div style="margin-top: -64px; text-align: right; margin-right: 32px"><a href="/contact"><button>BUY THIS ART</button></a></div></div>
            </div>';
    } else {
        $super_photo = ' 
            <div class="grid">
                <div class="col">
                    <img style="width: 100%;" src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" />
                </div>
            </div>';
    }

    /* If there is no custom DESC available */
    if( is_null($photo_meta['desc']) ) {
        $desc = "This art is printed on Acrylic and includes a float mount hanger. Read more about <a href=\"/styles\">our pricing and other available options.<a/>";
    }

    /* If ON_DISPLAY is set */
    if( $photo_meta['on_display'] != 0) {

        /* Make API query to get location */
        $photo_meta_location = $this->api_Catalog_Photo_Meta_Location($photo_meta['on_display']);

        $on_display = '
        <div style="display:block">&nbsp;</div>
        <div style="display: inline-block;">
                <a style="color: #4D4D4D;" href="/exhibits"><img src="/view/image/icon_geo.svg" style="width: 16px; opacity: .6; margin-right: 10px;" /></a>
            </div>
            <div style="display: inline-block; vertical-align: top; color: #4D4D4D; font-size: 1em; position: relative; margin-top: -2px;">
                <a style="color: #4D4D4D; font-weight: 300" href="/contact"><b>See It</b></a><br />
                <span style="font-size: .8em; font-weight: 300">This art is available to view at <a href="/exhibits">' . $photo_meta_location['location'] . '</a></span>
            </div>';
    } else {
        $on_display = null;
    }

    if($photo_meta['orientation'] == "portrait") {
        $img_w = '90%';
        $grid = '10';
        $col_left = 'col-5';
        $col_right = 'col-5';
    } else {
        $img_w = '100%';
        $grid='11-center';
        $col_left = 'col-7';
        $col_right = 'col-4';
    }

    /* Load filmstrip for popular */
    $catalog_photos = $this->api_Catalog_YouMayLike_Filmstrip();
     foreach($catalog_photos as $k => $v) {

                if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
                    $img_file = $v['file_name'];
                } else {
                    $img_file = 'image_not_found';
                }

                /* For Mobile */
                /* On last two thumbnails add some css */
                if($count == 2) {
                    $grid_css = 'col sm-hidden';
                } else if ($count == 3) {
                    $grid_css = 'col sm-hidden md-hidden';
                } else {
                    $grid_css = 'col';
                }

                // $thumb_html .= '<div style="overflow: hidden; height: 130px;" class="' . $grid_css . '">';
                // $thumb_html .= '<a href="' . $this->page->catalog_path .'/' . $img_file . '"><img style="margin-top: -35%;" src="/catalog                $thumb_html .= '<div style="overflow: hidden;" class="' . $grid_css . '">';/__thumbnail/' .$img_file . '.jpg" /></a></div>';

                $thumb_html .= '<div style="overflow: hidden;" class="' . $grid_css . '">';
                $thumb_html .= '<a href="' . $this->page->catalog_path . $v['path'] . "/" . $img_file . '"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a></div>';

                if($count == 3) { $count = 0; } else { $count++; }
            }


?>

<script>
    var title = document.title;
    var dbTitle = "<?= $photo_meta['title'] ?>";
    if (document.title != dbTitle) {
        document.title = dbTitle;
    }
</script>
