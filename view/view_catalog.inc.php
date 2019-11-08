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
    if( $catalog_meta[0]['path'] == 'new-releases') {
         $catalog_photos = $catalog_photos = $this->api_Catalog_Get_New_Releases(100, 4);
    } else if( $catalog_meta[0]['path'] == 'all') {
         $catalog_photos = $this->api_Catalog_Category_Thumbs_All();
    } else {
         $catalog_photos = $this->api_Catalog_Category_Thumbs($catalog_meta[0]['path']);
    }

        if( !$catalog_photos['error']) {
            foreach($catalog_photos as $k => $v) {
                
                if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
                $img_file = $v['file_name'];
                } else {
                    $img_file = 'image_not_found';
                }

                if($catalog != "new-releases") {
                    $v['catalog_path'] = $catalog;
                }

                /* For Mobile */
                /* On last two thumbnails add some css */
                if($count == 2) {
                    $grid_css = 'col';
                } else if ($count == 3) {
                    $grid_css = 'col';
                } else {
                    $grid_css = 'col';
                }
                
                // <div style="overflow: hidden; height: 203px;" class="' . $grid_css . '">
                $thumb_html .= '<div style="overflow: hidden;" class="' . $grid_css .  ' pb-8 filter-thumb-gallery"><a href="/' . $v['catalog_path'] . '/' . $img_file . '"><img style="width: 100%;" src="/catalog/__thumbnail/' . $img_file . '.jpg" /></a></p><p>' . $v['title'] . '</div>';

                /* <!-- <p><a href="/' . $v['catalog_path'] . '/' . $img_file . '">' . $v['title'] . '</a>--><!-- <br />Exhibiting at Joe Maxx Coffee, Las Vegas --> */
                
                if($count == 3) { $count = 0; } else { $count++; }
            }
        } else {
            $thumb_html = "<p>Somebody notify Captain Marvel, our photos have disappeared.</p><p style='margin-top: 20px; padding-top: 20px; border-top: 1px solid #CCC'>" . $catalog_photos['sql'] . "</p>";
        }
    
?>