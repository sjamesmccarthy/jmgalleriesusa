<?php
/* Dependency To */
/* view_galleries.inc.php, The Homepage */

/* Load all category meta data */
    $catalog_names = $this->api_Catalog_Category_List();

    foreach($catalog_names as $key=>$value) {

            $thumb_html .= "<article>";
            $thumb_html .= '<div class="grid-4_sm-2 grid-4_md-3">';

        if(strtolower($value['title']) != 'new releases') {

            $thumb_html .= '<div class="mb-16 col-10">';
            $thumb_html .= '<h2><a href="/' . $value['path'] . '">' . strtoupper($value['title']) . '</a></h2>';
            $thumb_html .= '<p>' . $value['desc'] .  '</p>';
            $thumb_html .= '</div>';
            $thumb_html .= '<div class="view-all col-2-middle">';
            $thumb_html .= '<a href="/' . $value['path'] . '">view all</a>';
            $thumb_html .= "</div>";

            /* Get FilmStrip of photos by Category */
            $catalog_photos = $this->api_Catalog_Category_Filmstrip($value['catalog_collections_id'], 4);

            if(isSet($catalog_photos)) {

            foreach($catalog_photos as $k => $v) {
                
                if($v['as_gallery'] == 1) {$desc_editions = "<p>Edition of " . $this->config->limited_edition_max  . " plus 2 Artist Proofs</p>"; $available_sizes = "16x24, 20x30 24x36, 30x45, 40x60"; } else { $data_filter_G = null;  }
                if($v['as_studio'] == 1) {$desc_editions = "<p>tinyViews&trade; Edition only</p>"; $available_sizes = "16x24, 20x30 24x36, 30x45, 40x60"; } else { $data_filter_S = null; }
                if($v['as_open'] == 1) { $desc_editions = "<p>tinyViews&trade; Edition only</p>"; $available_sizes = "4x6, 8x8, 8x10"; } else { $data_filter_O = null; }

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
                
                $thumb_html .= '<div style="padding: 0 10px;" class="thumb overflow-hidden ' . $grid_css . '">';
                // $thumb_html .= '<a href="' . $value['path'] . "/" . $img_file . '"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a><p class="blue larger">' . $v['title'] . '</p></div>';
                
                $thumb_html .= '<a href="/' . $v['catalog_path'] . '/' . $img_file . '"><img style="width: 100%;" src="/catalog/__thumbnail/' . $img_file . '.jpg" /></a></p><h4 class="pt-8 blue"><a href="' . $value['path'] . "/" . $img_file . '">' . $v['title'] . '</a></h4><p>' . $v['loc_place'] . '</p><p>Sizes: ' . $available_sizes . '</p>' . $desc_editions . '</div>';

                if($count == 3) { $count = 0; } else { $count++; }
            }

        } 
        else { 
            $thumb_html .= "<p>This collectionis currently being processed and currated for your enjoyment. Please come back in a day or so to enjoy it.</p>"; }
        }

        $thumb_html .= "</div>";
        $thumb_html .= "</article>";
    }


$html = <<< END
    $thumb_html
END;
        return($html);

?>
    