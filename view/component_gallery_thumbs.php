<?php

/* Load all category meta data */
    $catalog_names = $this->api_Catalog_Category_List();

    foreach($catalog_names as $key=>$value) {

        if(strtolower($value['title']) != 'new releases') {
        
            $thumb_html .= "<article>";
            $thumb_html .= '<div class="grid-4_sm-2 grid-4_md-3">';
            $thumb_html .= '<div class="col-11" style="margin-bottom: 16px;">';
            $thumb_html .= '    <h2><a href="/' . $value['path'] . '">' . strtoupper($value['title']) . '</a></h2>';
            $thumb_html .= '    <p>' . $value['desc'] .  '</p>';
            $thumb_html .= '</div>';
            $thumb_html .= '<div class="col-1-bottom" style="margin-bottom: 16px; text-align: right; padding-right: 8px;">';
            $thumb_html .= '<a href="/' . $value['path'] . '">view all</a>';
            $thumb_html .= "</div>";

            /* Get FilmStrip of photos by Category */
            $catalog_photos = $this->api_Catalog_Category_Filmstrip($value['catalog_category_id'], 4);

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
                //  height: 203px;
                $thumb_html .= '<div style="overflow: hidden;" class="' . $grid_css . '">';
                $thumb_html .= '<a href="' . $value['path'] . "/" . $img_file . '"><img style="width: 100%" src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a></div>';
                
                if($count == 3) { $count = 0; } else { $count++; }
            }
        }

        $thumb_html .= "</div>";
        $thumb_html .= "</article>";
    }

        return($thumb_html);

?>
    