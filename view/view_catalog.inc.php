<?php

    $count=0;
    $catalog = ltrim($this->page->catalog_path, '/');

    /* Load all category meta data */
    $catalog_meta = $this->api_Catalog_Category_List($catalog);

    /* Need to assign it locally since none of the API calls assign to global data store */
    /* OPTION, create a &callback prop for all API methods */
    $catalog_title = $catalog_meta[0]['title'];
    $catalog_desc = $catalog_meta[0]['desc'];

    /* Get Thumbnails of photos for Category */
    $catalog_photos = $this->api_Catalog_Category_Thumbs($catalog);
    // $this->printp_r($catalog_photos);

        foreach($catalog_photos as $k => $v) {
            
            if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
               $img_file = $v['file_name'];
            } else {
                $img_file = 'image_not_found';
            }

            $thumb_html .= '<div style="overflow: hidden;" class="col gallery"><a href="' . $this->page->catalog_path . '/' . $img_file . '"><img src="/catalog/__thumbnail/' . $img_file . '.jpg" /></a><p><a href="' . $this->page->catalog_path . '/' . $img_file . '">' . $v['title'] . '</a><br />Exhibiting at Joe Maxx Coffee, Las Vegas</p></div>';
            
            if($count == 3) { $count = 0; } else { $count++; }
        }
?>