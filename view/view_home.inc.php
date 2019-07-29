<?php

    $count =0;

    /* Load all category meta data */
    $catalog_names = $this->api_Catalog_Category_List();

    foreach($catalog_names as $key=>$value) {

        $thumb_html .= '<div class="grid-4_sm-2 grid-4_md-3 filmstrip">';
        $thumb_html .= '<div class="col-9">';
        $thumb_html .= '    <p><a href="/' . $value['path'] . '">' . strtoupper($value['title']) . '</a></p>';
        $thumb_html .= '    <p>' . $value['desc'] .  '</p>';
        $thumb_html .= '</div>';
        $thumb_html .= '<div class="col-3"><p style="text-align: right;">view all</p></div>';

        /* Get FilmStrip of photos by Category */
        $catalog_photos = $this->api_Catalog_Category_Filmstrip($value['catalog_category_id'], 4);

        foreach($catalog_photos as $k => $v) {
            
            if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
               $img_file = $v['file_name'];
            } else {
                $img_file = 'image_not_found';
            }

            $thumb_html .= '<div style="overflow: hidden; height: 220px;" class="col"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></div>';
            
            /* For Mobile */
            // $thumb_html .= '<div class="col sm-hidden"><img src="/view/image/demo-thumb.jpg" /></div>';
            // $thumb_html .= '<div class="col sm-hidden md-hidden"><img src="/view/image/demo-thumb.jpg" /></div>';
            if($count == 3) { $count = 0; } else { $count++; }
        }

        $thumb_html .= "</div>";
    }

?>