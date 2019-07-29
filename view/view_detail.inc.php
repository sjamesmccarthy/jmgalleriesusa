<?php 

    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    $this->catalog_title = ucwords( str_replace("-"," " ,$catalog_path_cleaned) );

    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo($this->photo_path);
    // $this->printp_r($photo_meta);

    /* Load filmstrip for popular */
    $you_may_like = $this->api_Catalog_YouMayLike_Filmstrip();
    // $this->printp_r($you_may_like);
     foreach($you_may_like as $k => $v) {
            
            if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
               $img_file = $v['file_name'];
            } else {
                $img_file = 'image_not_found';
            }

            $thumb_html .= '<div class="col"><img src="/catalog/__thumbnail/' . $img_file . '.jpg" /></div>';
            
            /* For Mobile */
            // $thumb_html .= '<div class="col sm-hidden"><img src="/view/image/demo-thumb.jpg" /></div>';
            // $thumb_html .= '<div class="col sm-hidden md-hidden"><img src="/view/image/demo-thumb.jpg" /></div>';
            if($count == 3) { $count = 0; } else { $count++; }
        }


?>