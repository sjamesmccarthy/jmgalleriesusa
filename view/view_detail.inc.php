<?php 

    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    $this->catalog_title = ucwords( str_replace("-"," " ,$catalog_path_cleaned) );

    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo($this->photo_path);
    // $this->printp_r($photo_meta);

    if($photo_meta['orientation'] == "portrait") {
        $img_w = '75%';
        $grid = '10';
        $col_left = 'col-5';
        $col_right = 'col-5';
    } else {
        $img_w = '100%';
        $grid='11';
        $col_left = 'col-7';
        $col_right = 'col-4';
    }

    /* Load filmstrip for popular */
    $you_may_like = $this->api_Catalog_YouMayLike_Filmstrip();
     foreach($you_may_like as $k => $v) {
            
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

            $thumb_html .= '<div class="' . $grid_css . '"><a href="' . $this->page->catalog_path .'/' . $img_file . '"><img src="/catalog/__thumbnail/' . $img_file . '.jpg" /></a></div>';
            
            /* For Mobile */
            // $thumb_html .= '<div class="col sm-hidden"><img src="/view/image/demo-thumb.jpg" /></div>';
            // $thumb_html .= '<div class="col sm-hidden md-hidden"><img src="/view/image/demo-thumb.jpg" /></div>';
            if($count == 3) { $count = 0; } else { $count++; }
        }


?>