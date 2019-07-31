<?php

    $count =0;

    /* Create an API call to get the Polarized listings */
    $polarized_json = $this->api_Polarized_Get_Latest();
    
    $i=0;
    foreach($polarized_json as $key=>$value) {
        
        if($i === 3) { $content_border = null; } else { $content_border = 'content-border'; }

        $polarized_html .= '<div class="col ' . $content_border . '">';
        $polarized_html .= '<h5>' . $value['title'] . '</h5>';
        $polarized_html .= '<p>' . $value['description'] . '</p>';
        $polarized_html .= '<p style="padding-top: 10px;text-align: left; position:absolute; bottom: 0;"><a target="_new" href="' . $value['link'] . '">Read More</a>';
        $polarized_html .= '</div>';

        $i++;
    }

    /* Load all category meta data */
    $catalog_names = $this->api_Catalog_Category_List();

    foreach($catalog_names as $key=>$value) {

        $thumb_html .= "<article>";
        $thumb_html .= '<div class="grid-4_sm-2 grid-4_md-3 filmstrip">';
        $thumb_html .= '<div class="col-9">';
        $thumb_html .= '    <h2><a href="/' . $value['path'] . '">' . strtoupper($value['title']) . '</a></h2>';
        $thumb_html .= '    <p>' . $value['desc'] .  '</p>';
        $thumb_html .= '</div>';
        $thumb_html .= '<div class="col-3-bottom"><p style="text-align: right;">view all</p></div>';

        /* Get FilmStrip of photos by Category */
        $catalog_photos = $this->api_Catalog_Category_Filmstrip($value['catalog_category_id'], 4);

        foreach($catalog_photos as $k => $v) {
            
            if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
               $img_file = $v['file_name'];
            } else {
                $img_file = 'image_not_found';
            }

            $thumb_html .= '<div style="overflow: hidden; height: 220px;" class="col">';
            $thumb_html .= '<a href="' . $value['path'] . "/" . $img_file . '"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a></div>';
            
            /* For Mobile */
            /* On last two thumbnails add some css */
            
            // $thumb_html .= '<div class="col sm-hidden"><img src="/view/image/demo-thumb.jpg" /></div>';
            // $thumb_html .= '<div class="col sm-hidden md-hidden"><img src="/view/image/demo-thumb.jpg" /></div>';
            if($count == 3) { $count = 0; } else { $count++; }
        }

        $thumb_html .= "</div>";
        $thumb_html .= "</article>";
    }

?>