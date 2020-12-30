<?php 
/* Dependency To */
/* view_galleries.inc.php, The Homepage */
/* component_gallery_thumbs.php, component_new_releases.php, view_catalog.inc.php */

/* Fetch Just the New Releases filmstrip */
    $count =0;
    $new_release_data = array(4,12); /* Also found in view_catalog.inc.php */

    $new_releases = $this->api_Catalog_Get_New_Releases($new_release_data[0], $new_release_data[1]);

        // $thumb_new_releases_html .= "<article id='new-releases'>";
        $thumb_new_releases_html .= '<div class="grid-4_sm-2 grid-4_md-3">';
        $thumb_new_releases_html .= '<div class="col-10_sm-12">';
        $thumb_new_releases_html .= '<h2><a href="/new-releases/">NEW RELEASES</a></h2>';
        $thumb_new_releases_html .= '<p class="light sm-hidden">a collection of photography featuring newest work by photographer j.McCarthy.</p>';
        $thumb_new_releases_html .= '</div>';
        $thumb_new_releases_html .= '<div class="view-all col-2-middle sm-hidden">';
        $thumb_new_releases_html .= '<a href="/new-releases">view all</a>';
        $thumb_new_releases_html .= "</div>";

    
if( !$new_releases['error']) {
    foreach($new_releases as $k => $v) {
                
        if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
        $img_file = $v['file_name'];
        } else {
            $img_file = 'image_not_found';
        }

        if($v['as_gallery'] == 1) {
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

        // if($v['as_gallery'] == 1) {$desc_editions = "<p>Limited Edition of " . $this->config->limited_edition_max  . " plus 2 Artist Proofs</p>"; $available_sizes = "16x24, 20x30 24x36"; } else { $data_filter_G = null;  }
        // if($v['as_studio'] == 1) {$desc_editions = "<p>tinyViews&trade; Edition only</p>"; $available_sizes = "16x24, 20x30 24x36"; } else { $data_filter_S = null; }
        // if($v['as_open'] == 1) { $desc_editions = "<p>tinyViews&trade; Edition only</p>"; $available_sizes = "4x6, 8x8, 8x10"; } else { $data_filter_O = null; }
        // if($v['as_studio'] == 1) {$desc_editions = "<p>Giclée, tinyViews&trade; Edition</p>"; $available_sizes = "16x24, 20x30 24x36"; } else { $data_filter_S = null; }
        // if($v['as_open'] == 1) { $desc_editions = "<p>Giclée, tinyViews&trade; Edition</p>"; $available_sizes = "5x7, 8x8, 8x12, 12x18"; } else { $data_filter_O = null; }


        /* For Mobile */
        /* On last two thumbnails add some css */
        if($count == 2) {
            $grid_css = 'col sm-hidden';
        } else if ($count == 3) {
            $grid_css = 'col sm-hidden md-hidden';
        } else {
            $grid_css = 'col';
        }
        $thumb_new_releases_html .= '<div style="padding: 0 10px;" class="thumb overflow-hidden ' . $grid_css . '">';
        // $thumb_new_releases_html .= '<a href="/' . $value['catalog_path']  . $value['path'] . "/" . $img_file . '"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a><p>' . $value['title'] . '</p></div>';
        $thumb_new_releases_html .= '<a href="/' . $v['catalog_path'] . '/' . $img_file . '"><img style="width: 100%;" src="/catalog/__thumbnail/' . $img_file . '.jpg" /></a></p><h4 class="pt-8 blue"><a href="/' . $v['catalog_path'] . '/' . $img_file . '">' . $v['title'] . '</a></h4><p>' . $v['loc_place'] . '</p><!-- <p>Sizes: ' . $available_sizes . '</p>-->' . $desc_editions . '</div>';

        if($count == 3) { $count = 0; } else { $count++; }
    }
    
    $thumb_new_releases_html .= "</div>";
    // $thumb_new_releases_html .= "</article>";

    return($thumb_new_releases_html);

} else {
        $thumb_new_releases_html .= "<p>Somebody notify Captain Marvel, our photos have disappeared.</p>";
        return(false);
}

?>