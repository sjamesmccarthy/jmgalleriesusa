<?php
/* Dependency To */
/* view_galleries.inc.php, The Homepage */
/* component_gallery_thumbs.php, component_new_releases.php, view_catalog.inc.php */

/* Load all category meta data */
    $catalog_names = $this->api_Catalog_Category_List();
    // $this->console($catalog_names);

    foreach($catalog_names as $key=>$value) {

            // $thumb_html .= "<article id='filmstrip'>";
            // id='*- strtoupper($value['path']) . ''
            $thumb_html .= '<section id="filmstrips">';
            $thumb_html .= '<div class="grid-4_sm-2 grid-4_md-3"><!-- mt-32  mt-64-->';

        if(strtolower($value['title']) != 'new releases') {

            $thumb_html .= '<div class="col-12_sm-12 text-center mb-16"><!-- col-10_sm-12 -->';
            $thumb_html .= '<h2><a href="/' . $value['path'] . '">' . strtoupper($value['title']) . '</a></h2>';
            $thumb_html .= '<p class="light --subhead sm-hidden">' . $value['desc'] .  '</p>';
            $thumb_html .= '</div>';
            $thumb_html .= '<div class="view-all col-2-middle sm-hidden hidden">';
            $thumb_html .= '<a href="/' . $value['path'] . '">view all</a>';
            $thumb_html .= "</div>";

            /* Get FilmStrip of photos by Category */
            $catalog_photos = $this->api_Catalog_Category_Filmstrip($value['catalog_collections_id'], 8, "LE"); // LE

            if(isSet($catalog_photos)) {

            foreach($catalog_photos as $k => $v) {

                if($v['as_limited'] == 1) {
                    $edition_desc = str_replace("{limited_edition_max}", $this->config->limited_edition_max, $this->config->edition_description_limited);
                    $desc_editions = "<p>" . $edition_desc  . "</p>";
                    $available_sizes = $this->config->available_sizes_limited; }
                    else { $data_filter_G = null;  }

                if($v['as_studio'] == 1) {
                    $desc_editions = "<p>" . $this->config->edition_description_open . "</p>";
                    $available_sizes = $this->config->available_sizes_open; }
                    else { $data_filter_S = null; }

                if($v['as_open'] == 1) {
                    $desc_editions = "<p>" . $this->config->edition_description_open . "</p>";
                    $available_sizes = $this->config->available_sizes_open; }
                    else { $data_filter_O = null; }

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
                $thumb_html .= '<a href="/' . $v['catalog_path'] . '/' . $img_file . '"><img style="width: 100%;" src="/catalog/__thumbnail/' . $img_file . '.jpg" alt="' . $img_file . '" /></a></p><!--<p class="pt-8 blue text-center"><a href="' . $value['path'] . "/" . $img_file . '">' . $v['title'] . '</a></p>--><!--<p>' . $v['loc_place'] . '</p>--><!-- <p>Sizes: ' . $available_sizes . '</p>--><!--' . $desc_editions . '--></div>';

                if($count == 3) { $count = 0; } else { $count++; }
            }

        }
        else {
            $thumb_html .= "<p>This collectionis currently being processed and currated for your enjoyment. Please come back in a day or so to enjoy it.</p>"; }
        }

        $thumb_html .= "</div>";
        $thumb_html .= "<div class='col'><p class='text-center'><a href='/" . $value['path'] . "'>view more</p></p><p class='text-center' style='margin-top: -10px;'><i class='fas fa-angle-down'></i></a></p></div>";
        $thumb_html .= "</section>";
        // $thumb_html .= "</article>";
    }


$html = <<< END
    $thumb_html
END;
        return($html);

?>
