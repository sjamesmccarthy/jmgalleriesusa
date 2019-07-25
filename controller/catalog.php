<?php

class Catalog extends Core_Api
{

    public function hero(){ 

    }

    public function promoPolarized() {

    }

    public function catalogPreview($catalog='NewReleases') {

    }

    public function promoSubscribeForm() {

    }

    public function loadNegativeFile($catalog) {

        /* Fetch records from database and return data array */
       $data =  $this->api_Catalog_Category_Index($catalog,'thumbnails');
       $this->page->thumbnails = (object) $data;

    }

    public function loadPhotoDetails($catalog, $photo) {

        /* Fetch records from database and return data array */
        $data = $this->api_Catalog_Photo($photo,'page');
        $this->page = (object) $data;
        
    }

    public function loadCategoryNames() {
        
        /* Fetch records from database and return data array */
        $data = $this->api_Catalog_Category_List('data');
        $this->data = (object) $data;

    }
}
?>