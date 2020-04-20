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
        $catalog_photos = $this->api_Catalog_Category_Filmstrip($catalog_meta[0]['catalog_collections_id'], 'ALL');
    }

        if( !$catalog_photos['error']) {
            foreach($catalog_photos as $k => $v) {
                
                if($v['as_gallery'] == 1) { $data_filter_G = 'f-gallery'; $desc_editions = "<p>Edition of " . $this->config->limited_edition_max  . " plus 2 Artist Proofs</p>"; $available_sizes = "16x24, 20x30 24x36, 30x45, 40x60"; } else { $data_filter_G = null;  }
                // if($v['as_studio'] == 1) {$data_filter_S = 'f-studio'; $desc_editions = "<p>tinyViews&trade; Edition only</p>"; $available_sizes = "16x24, 20x30 24x36, 30x45, 40x60"; } else { $data_filter_S = null; }
                // if($v['as_open'] == 1) { $data_filter_O = 'f-open'; $desc_editions = "<p>tinyViews&trade; Edition only</p>"; $available_sizes = "4x6, 8x8, 8x10"; } else { $data_filter_O = null; }
                if($v['as_studio'] == 1) {$desc_editions = "<p>Giclée, tinyViews&trade; Edition</p>"; $available_sizes = "16x24, 20x30 24x36, 30x45, 40x60"; } else { $data_filter_S = null; }
                if($v['as_open'] == 1) { $desc_editions = "<p>Giclée, tinyViews&trade; Edition</p>"; $available_sizes = "4x6, 8x8, 8x12, 12x12, 12x18"; } else { $data_filter_O = null; }
           
                
                $data_filters = "$data_filter_G $data_filter_S $data_filter_O $data_filter_T";

                if($v['available_sizes'] != "in_code") { $available_sizes = $v['available_sizes']; }

                if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
                $img_file = $v['file_name'];
                } else {
                    $img_file = 'image_not_found';
                }

                // if($catalog == "new-releases") {
                    // $v['catalog_path'] = 'photo';
                // } else {
                    // $v['catalog_path'] = $catalog;
                // }

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
                $thumb_html .= '<div style="padding: 0 10px; overflow: hidden; margin-bottom: 32px" class="' . $grid_css .  ' pb-16 filter-thumb-gallery '. $data_filters . '"><a href="/' . $v['catalog_path'] . '/' . $img_file . '"><img style="width: 100%;" src="/catalog/__thumbnail/' . $img_file . '.jpg" /></a></p><h4 class="pt-8 blue"><a href="/' . $v['catalog_path'] . '/' . $img_file . '">' . $v['title'] . '</a></h4><p>' . $v['loc_place'] . '</p><p>Sizes: ' . $available_sizes . '</p>' . $desc_editions . '</div>';

                /* <!-- <p><a href="/' . $v['catalog_path'] . '/' . $img_file . '">' . $v['title'] . '</a>--><!-- <br />Exhibiting at Joe Maxx Coffee, Las Vegas --> */
                
                if($count == 3) { $count = 0; } else { $count++; }
            }
        } else {
            $thumb_html = "<p>Somebody notify Captain Marvel, our photos have disappeared.</p><p style='margin-top: 20px; padding-top: 20px; border-top: 1px solid #CCC'>" . $catalog_photos['sql'] . "</p>";
        }
    
?>