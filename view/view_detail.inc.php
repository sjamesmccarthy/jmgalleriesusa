<?php 

    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    $this->catalog_title = ucwords( str_replace("-"," " ,$catalog_path_cleaned) );

    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo($this->photo_path);
    $this->printp_r($photo_meta);

?>