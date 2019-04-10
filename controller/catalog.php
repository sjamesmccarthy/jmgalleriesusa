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

        /* Load the json object containing all the meta data for photos in the specific catalog */
        // $this->getJSON('/catalog' . $catalog . '/' . $this->config->prefix['negatives'] . '.json','negatives');

        /* Fetch records from database and return data array */
        $this->getCatalog_Category_Index($catalog,'negatives');

        /* Loop through "collection_photo". If $photo = $file_name" */
        $photo_list = (array) $this->negatives;

        // $this->printp_r($photo_list);

        for ($i = 0; $i < count($photo_list); $i++) {
            /* Get meta data of this photo */
            $this->page->meta[$i]['file_name'] = $photo_list[$i]['file_name'];
            $this->page->meta[$i]['title'] = $photo_list[$i]['title'];
            $this->page->meta[$i]['loc_place'] = $photo_list[$i]['loc_place'];
            $this->page->meta[$i]['loc_state'] = $photo_list[$i]['loc_state'];
        }

    }

    public function loadPhotoDetails($catalog, $photo) {

        /* Fetch records from database and return data array */
        $this->getCatalog_Photo($photo,'page');

        /* Convert the JSON object to an array */
        // $this->page = (array) $this->photo_data;
        // $this->printp_r($photo_meta);


         /* Search JSON data of the catalog data source file for the specific photo */
        // for ($i = 0; $i < count($photo_meta); $i++) {
            // $this->page->meta = $photo_meta[$i];
        // }
    }

    public function loadCategoryNames() {
        
        /* Fetch records from database and return data array */
        $this->getCatalog_CategoryList('data');

        /* Convert the JSON object to an array */
        $catalog_category_list = (array) $this->data;

         /* Search JSON data of the catalog data source file for the specific photo */
        for ($i = 0; $i < count($photo_list); $i++) {
            if($catalog_category_list[$i]['file_name'] == $catalogs) {
                /* Get meta data of this photo */
                $this->page->meta = $catalog_category_list[$i];
            } else {
                /* ERROR */
            }
        }
    }
}
?>