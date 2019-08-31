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

    /* Determine if the "VirtualRoom" photo exists */
    if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__image/" . $photo_meta['file_name'] . '-room.jpg') ) {
           
            if($photo_meta['orientation'] == "landscape") {
                 $super_photo = ' 
                <div class="slider">
                <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /><div style="margin-top: -64px; text-align: right; margin-right: 32px"><a href="/contact"><button>BUY THIS ART</button></a></div></div>
                <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '.jpg" /></div>
                </div>';
            } else {
                $super_photo = ' 
                <div class="grid">
                    <div class="col"> 
                    <img style="width: 99.5%" src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /><div style="margin-top: -64px; text-align: right; margin-right: 32px"><a href="/contact"><button>BUY THIS ART</button></a></div></div>
                    </div>
                </div>';
            }

        // $super_photo = ' 
        //     <div class="slider">
        //     <div><img src="/catalog/__image/' . $photo_meta['file_name'] . '-room.jpg" /><div style="margin-top: -64px; text-align: right; margin-right: 32px"><a href="/contact"><button>BUY THIS ART</button></a></div></div>'
        //     . $include_big . '</div>';
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
                <a style="color: #4D4D4D;" href="/exhibits"><img src="/view/image/icon_geo.svg" class="no-border" style="width: 16px; opacity: .6; margin-right: 10px;" /></a>
            </div>
            <div style="display: inline-block; vertical-align: top; color: #4D4D4D; font-size: 1em; position: relative; margin-top: -2px;">
                <a style="color: #4D4D4D; font-weight: 300" href="/contact"><b>See It</b></a><br />
                <span style="font-size: .8em; font-weight: 300">This art is available to view<br />at <a href="/exhibits">' . $photo_meta_location['location'] . '</a> in ' . $photo_meta_location['city'] . ', ' . $photo_meta_location['state'] . '</span>
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

?>

<script>
    var title = document.title;
    var dbTitle = "<?= $photo_meta['title'] ?>";
    if (document.title != dbTitle) {
        document.title = dbTitle;
    }
</script>
