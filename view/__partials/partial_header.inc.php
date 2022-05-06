<?php

    $headerExtrasHTML = $this->getHeaderExtras();

    if ($this->routes->URI->page != "home") {

        /* If this is a polarized fieldnote load a different image path */
        if ($this->routes->URI->page == "polarized_post") {
            if( file_exists($_SERVER["DOCUMENT_ROOT"] .  "/view/__image/fieldnotes/" . $this->page->image_path) ) {
                $og_image = "/view/__image/fieldnotes/" . $this->page->image_path . '?' . uniqid();
            } else {
                $og_image = '/view/__image/social_card_default.jpg?' . uniqid();
            }
        } else if ($this->routes->URI->page == "shop") {

            if( file_exists($_SERVER["DOCUMENT_ROOT"] .  "/view/__image/social_card_gallerystore.jpg") ) {
                $og_image = "/view/__image/social_card_gallerystore.jpg?" . uniqid();
            } else {
                $og_image = '/view/__image/social_card_default.jpg?' . uniqid();
            }

        } else {

            if( file_exists($_SERVER["DOCUMENT_ROOT"] .  "/view/__catalog/__image/" . $this->page->photo_path . ".jpg") ) {
                $og_image = "/view/__catalog/__thumbnail/" . $this->page->photo_path . ".jpg?" . uniqid();
            } else {
                $og_image = '/view/__image/social_card_default.jpg?' . uniqid();
            }
        }

    } else {
        $og_image = "/view/__image/social_card_default.jpg?" . uniqid();
    }

    $title_formatted = $this->config->site_name . ' | ' . $this->page->title;

?>