<?php

    $count =0;
    
    /* Load all category meta data */
    $catalog_names = $this->api_Catalog_Category_List();

    /* Fetch Just the New Releases filmstrip */
    $new_releases = $this->api_Catalog_Get_New_Releases(4,4);

        $thumb_new_releases_html .= "<article>";
        $thumb_new_releases_html .= '<div class="grid-4_sm-2 grid-4_md-3">';
        $thumb_new_releases_html .= '<div class="col-11" style="margin-bottom: 16px;">';
        // $thumb_new_releases_html .= '    <h2><a href="/' . $catalog_names[3]['path'] . '">' . strtoupper($catalog_names[3]['title']) . '</a></h2>';
        // $thumb_new_releases_html .= '    <p>' . $catalog_names[3]['desc'] .  '</p>';
        $thumb_new_releases_html .= '    <h2><a href="/new-releases/">NEW RELEASES</a></h2>';
        $thumb_new_releases_html .= '    <p>a collection of photography featuring James\' newest work in all categories.</p>';

        $thumb_new_releases_html .= '</div>';
        $thumb_new_releases_html .= '<div class="col-1-bottom" style="margin-bottom: 16px; text-align: right;">';
        $thumb_new_releases_html .= '<a href="/' . $catalog_names[3]['path'] . '">view all</a>';
        $thumb_new_releases_html .= "</div>";


    foreach($new_releases as $k => $value) {
                
        if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $value['file_name'] . '.jpg')) {
        $img_file = $value['file_name'];
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
        $thumb_new_releases_html .= '<div style="overflow: hidden;" class="' . $grid_css . '">';
        $thumb_new_releases_html .= '<a href="/' . $value['catalog_path']  . $value['path'] . "/" . $img_file . '"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a></div>';
        
        if($count == 3) { $count = 0; } else { $count++; }
    }
        $thumb_new_releases_html .= "</div>";
        $thumb_new_releases_html .= "</article>";

    // /* Load all category meta data */
    // $catalog_names = $this->api_Catalog_Category_List();

    foreach($catalog_names as $key=>$value) {

        if(strtolower($value['title']) != 'new releases') {
        
            $thumb_html .= "<article>";
            $thumb_html .= '<div class="grid-4_sm-2 grid-4_md-3">';
            $thumb_html .= '<div class="col-11" style="margin-bottom: 16px;">';
            $thumb_html .= '    <h2><a href="/' . $value['path'] . '">' . strtoupper($value['title']) . '</a></h2>';
            $thumb_html .= '    <p>' . $value['desc'] .  '</p>';
            $thumb_html .= '</div>';
            // $thumb_html .= '<div class="col-1-bottom"><p style="text-align: right;">view all</p></div>';
            $thumb_html .= '<div class="col-1-bottom" style="margin-bottom: 16px; text-align: right;">';
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
                $thumb_html .= '<a href="' . $value['path'] . "/" . $img_file . '"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a></div>';
                
                if($count == 3) { $count = 0; } else { $count++; }
            }
        }

        $thumb_html .= "</div>";
        $thumb_html .= "</article>";
    }

?>