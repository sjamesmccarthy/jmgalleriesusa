<?php

/* Load all category meta data */
    $catalog_names = $this->api_Catalog_Category_List();

    foreach($catalog_names as $key=>$value) {

            $thumb_html .= "<article>";
            $thumb_html .= '<div class="grid-4_sm-2 grid-4_md-3">';

        if(strtolower($value['title']) != 'new releases') {

            $thumb_html .= '<div class="mb-16 col-10">';
            $thumb_html .= '    <h2><a href="/' . $value['path'] . '">' . strtoupper($value['title']) . '</a></h2>';
            $thumb_html .= '    <p>' . $value['desc'] .  '</p>';
            $thumb_html .= '</div>';
            $thumb_html .= '<div class="view-all col-2-bottom">';
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
                
                $thumb_html .= '<div class="thumb overflow-hidden ' . $grid_css . '">';
                $thumb_html .= '<a href="' . $value['path'] . "/" . $img_file . '"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a><p>' . $v['title'] . '</p></div>';
                
                if($count == 3) { $count = 0; } else { $count++; }
            }
        }

        $thumb_html .= "</div>";
        $thumb_html .= "</article>";
    }


$html = <<< END
    $thumb_html
END;
        return($html);

?>
    