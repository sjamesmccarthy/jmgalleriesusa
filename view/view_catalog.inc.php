<?php

    $catalog = ltrim($this->page->catalog_path, '/');

    /* Load all category meta data */
    $catalog_meta = $this->api_Catalog_Category_List($catalog);
    $this->printp_r($catalog_meta);

    $result = $this->api_Catalog_Category_Thumbs($catalog);
    $this->printp_r($result);

    // $this->loadNegativeFile($this->page->catalog);
    
    //     foreach($this->page->thumbnails as $key=>$value) {
    //     $file_name = '/catalog' . '/__thumbnail/' . $value['file_name'] . '.jpg';
        
    //     $p_thumbs .= '<li style="box-sizing: border-box; display: inline-block; height: 240px; overflow: hidden; margin-bottom: -4px;">';
    //     if(file_exists( $_SERVER['DOCUMENT_ROOT'] . $file_name )) {
    //         $p_thumbs .= '<a href="' . $this->page->catalog . '/' . $value['file_name'] . '">';
    //         $p_thumbs .= '<img style="width: 100%" src="'. $file_name . '" />';
    //         $p_thumbs .= '</a>';
    //     } else {
    //         $p_thumbs .= '<img src="/view/image/noimage.png" />';
    //     }
    //     $p_thumbs .= "</li>";
    // }

    // $this->tNum = count((array)$this->page->thumbnails);

?>