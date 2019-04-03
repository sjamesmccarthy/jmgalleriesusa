<?php

class Catalog extends Core_Data
{

    public $data;
    public $meta;

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
        $this->getJSON('catalog/' . $catalog . '/' . $this->config->prefix['negatives'] . '.json','negatives');

        /* Loop through "collection_photo". If $photo = $file_name" */
        $photo_list = (array) $this->negatives->photo;
        for ($i = 0; $i < count($photo_list); $i++) {
            /* Get meta data of this photo */
            $this->data->page->meta[$i]['file_name'] = $photo_list[$i]['file_name'] . '.jpg';
            $this->data->page->meta[$i]['title'] = $photo_list[$i]['title'];
            $this->data->page->meta[$i]['loc_place'] = $photo_list[$i]['loc_place'];
            $this->data->page->meta[$i]['loc_state'] = $photo_list[$i]['loc_state'];
        }
    }

    public function getPhotoDetail($catalog, $photo) {

        /* Load JSON data of the catalog data source file  */
        $this->getJSON('catalog/' . $catalog .  '/_collection.json','cdata');

        /* Convert the JSON object to an array */
        $photo_list = (array) $this->cdata->photo;

         /* Search JSON data of the catalog data source file for the specific photo */
        for ($i = 0; $i < count($photo_list); $i++) {
            if($photo_list[$i]['file_name'] == $photo) {
                /* Get meta data of this photo */
                $this->data->page->meta = $photo_list[$i];
            } else {
                /* ERROR */
            }
        }
    }

}
?>