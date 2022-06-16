<?php

/* Dependency To */
/* component_gallery_thumbs.php, component_new_releases.php, view_catalog.inc.php */

    $count=0;
    $catalog = ltrim($this->page->catalog_path, '/');
    $new_release_data = array(24,12);  /* $limit=24, $duration=null[months], $rand=null, Also found in component_new_releases.php */

    /* Load all category meta data */
    // $this->console($catalog);
    $catalog_meta = $this->api_Catalog_Category_List($catalog);

    /* Need to assign it locally since none of the API calls assign to global data store */
    /* OPTION, create a &callback prop for all API methods */
    $catalog_title = $catalog_meta[0]['title'];
    $catalog_desc = $catalog_meta[0]['desc'];

    /* Get Thumbnails of photos for Category */
    if( $catalog_meta[0]['path'] == 'new-releases') {
         $catalog_photos = $catalog_photos = $this->api_Catalog_Get_New_Releases($new_release_data[0], $new_release_data[1]);
         $catalog_tabs_hidden = true;
         $catalog_le_desc = '&mdash; limited edition';
    } else if( $catalog_meta[0]['path'] == 'thework') {

        $param_ed = "as_limited";

        if($this->routes->URI->queryvals[1] == 'tinyviews') {
            $param_ed = 'as_open';
            $catalog_title = 'OPEN EDITIONS';
            $catalog_desc = 'Beautiful <b>Open Edition</b> Matted Prints';
            $catalog_tabs_hidden = true;
            $tv_le_link = '<!-- <p class="shop-tv-link"><a href="/shop">Shop The jM Gallery Store</a></p> -->';
        }

        if($this->routes->URI->queryvals[1] == 'limited') {
            $param_ed = 'as_limited';
            $catalog_title = 'LIMITED EDITIONS';
            // $catalog_desc = 'the <b>complete fine-art collection</b> by jMcCarthy';
            $catalog_tabs_hidden = true;
            $tv_le_link = '<!-- <p class="shop-tv-link"><a href="/collections">Browse By Collections</a></p> -->';
        }

        $catalog_photos = $this->api_Catalog_Category_Thumbs_All($param_ed);

    } else {
        $catalog_tabs_hidden = false;
        $catalog_le_desc = '&mdash; limited edition';
        // $catalog_photos = $this->api_Catalog_Category_Filmstrip($catalog_meta[0]['catalog_collections_id'], 'ALL');
        $catalog_photos = $this->api_Catalog_Category_Filmstrip($catalog_meta[0]['catalog_collections_id'], 'ALL','LE');
        // $tv_le_link = '<p class="shop-tv-link"><a href="/thework?filter=limited">Back To THE WORK &mdash; LIMITED EDITIONS</a></p>';
        $tv_le_link = '<!-- <p class="shop-tv-link"><a href="/collections">VIEW ALL COLLECTIONS</a></p> -->';
    }

        if( !$catalog_photos['error']) {
            foreach($catalog_photos as $k => $v) {

                if($v['as_limited'] == 1) {
                $data_filter_G = 'f-gallery';
                $edition_desc = str_replace("{limited_edition_max}", $this->config->limited_edition_max, $this->config->edition_description_limited);
                $desc_editions = "<p>" . $edition_desc  . "</p>";
                $available_sizes = $this->config->available_sizes_limited;

                }
                else { $data_filter_G = null;  }

                if($v['as_studio'] == 1) {
                 $data_filter_S = 'f-studio';
                $desc_editions = "<p>" . $this->config->edition_description_open . "</p>";

                if($v['available_sizes'] != "in_code") {
                    $available_sizes = json_decode($v['available_sizes'], true);
                } else {
                    $available_sizes = $this->config->available_sizes_open;
                }

            }
            else { $data_filter_S = null; }

                if($v['as_open'] == 1) {
                $data_filter_O = 'f-open';

                if($v['available_sizes'] != "in_code") {
                    $open_pricing_array = json_decode($v['available_sizes'], true);
                    $r_seed = count($open_pricing_array) -1;
                    // echo "FOUND @" . $v['title'] . "<br />";
                    // echo $v['available_sizes'] . "<br />";
                } else {
                    $open_pricing_array = json_decode($this->config->tv_pricing, true);
                    $r_seed = count($open_pricing_array) -1;
                }

                $i=0;
                $iRand = rand(0,$r_seed);
                // $this->console($open_pricing_array);
                foreach ($open_pricing_array as $opK => $opV) {

                    if($i == $iRand) {
                        $rPrice = $opV;
                        $tvS = explode('|', $opK);
                        if($tvS[1] == '0') { $tvS[1] = $tvS[0]; }
                        $rSize = $tvS[1];
                    }

                    $i++;
                }

                // $desc_editions = "<p>" . $this->config->edition_description_open . "</p>";
                $desc_editions = "<p style='font-weight: 700; padding-right: 1rem;'>$" . $rPrice . " (" . $rSize . ")</p>";
                $available_sizes = $this->config->available_sizes_open;
                $rSize = null;
                $rPrice = null;
                }
                else { $data_filter_O = null; }

                // if($v['as_limited'] == 1) {
                //     $data_filter_G = 'f-gallery';
                //     $desc_editions = "<p>Limited Edition of " . $this->config->limited_edition_max  . " plus 2 Artist Proofs</p>";
                //     $available_sizes = "16x24, 20x30 24x36"; }
                //     else { $data_filter_G = null;  }

                // if($v['as_studio'] == 1) {
                //     $data_filter_S = 'f-studio';
                //     $desc_editions = "<p>Giclée, tinyViews&trade; Edition</p>";
                //     $available_sizes = "16x24, 20x30 24x36"; }
                //     else { $data_filter_S = null; }

                // if($v['as_open'] == 1) {
                //     $data_filter_O = 'f-open';
                //     $desc_editions = "<p>Giclée, tinyViews&trade; Edition</p>";
                //     $available_sizes = "5x7, 8x8, 8x12, 12x18"; }
                //     else { $data_filter_O = null; }

                $data_filters = "$data_filter_G $data_filter_S $data_filter_O $data_filter_T";

                // if($v['available_sizes'] != "in_code") { $available_sizes = $v['available_sizes']; }

                if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/__catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
                $img_file = $v['file_name'];
                } else {
                    $img_file = 'image_not_found';
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
                $thumb_html .= '<div style="position: relative; padding: 0 10px; overflow: hidden;" class="thumb ' . $grid_css .  ' pb-16 filter-thumb-gallery '. $data_filters . '"><a href="/' . $v['catalog_path'] . '/' . $img_file . '"><img style="width: 100%;" src="/view/__catalog/__thumbnail/' . $img_file . '.jpg" alt="' . $img_file . '" /></a></p><!--<h4 class="pt-8 blue"><a href="/' . $v['catalog_path'] . '/' . $img_file . '">' . $v['title'] . '</a></h4>--><!-- <p>' . $v['loc_place'] . '</p> --><!--<p>Sizes: ' . $available_sizes . '</p>--> <!-- ' . $desc_editions . ' --></div>';

                /* <!-- <p><a href="/' . $v['catalog_path'] . '/' . $img_file . '">' . $v['title'] . '</a>--><!-- <br />Exhibiting at Joe Maxx Coffee, Las Vegas --> */

                if($count == 3) { $count = 0; } else { $count++; }
            }

        } else {
            $thumb_html = "<div id='error' class='col-12'><p class='text-center tiny'>stark:+19008720101:begin_transmission</p><p class='text-center'>Somebody notify Captain Marvel. Thanos has turned our results to dust.</p>
            <p class='text-center'>view_catalog.inc__" . __LINE__ . ".db(" . $catalog_photos['error'] . ")</p><p class='text-center tiny'>stark:+19008720101:end_transmission</p></div>";
        }

?>
