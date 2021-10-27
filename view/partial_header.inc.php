<?php


    if ($this->routes->URI->page != "home") {

        /* If this is a polarized fieldnote load a different image path */
        if ($this->routes->URI->page == "polarized_post") {
            if( file_exists($_SERVER["DOCUMENT_ROOT"] .  "/view/image/fieldnotes/" . $this->page->image_path) ) {
                $og_image = "/view/image/fieldnotes/" . $this->page->image_path . '?' . uniqid();
            } else {
                $og_image = '/view/image/social_card_default.jpg?' . uniqid();
            }
        } else if ($this->routes->URI->page == "shop") {

            if( file_exists($_SERVER["DOCUMENT_ROOT"] .  "/view/image/social_card_gallerystore.jpg") ) {
                $og_image = "/view/image/social_card_gallerystore.jpg?" . uniqid();
            } else {
                $og_image = '/view/image/social_card_default.jpg?' . uniqid();
            }

        } else {

            if( file_exists($_SERVER["DOCUMENT_ROOT"] .  "/catalog/__image/" . $this->page->photo_path . ".jpg") ) {
                $og_image = "/catalog/__thumbnail/" . $this->page->photo_path . ".jpg?" . uniqid();
            } else {
                $og_image = '/view/image/social_card_default.jpg?' . uniqid();
            }
        }

    } else {
        $og_image = "/view/image/social_card_default.jpg?" . uniqid();
    }

    $title_formatted = $this->config->site_name . ' | ' . $this->page->title;

    /* Look for CSS and JS files to include */
    if(isSet($this->page->header)) {

        if(isSet($this->page->header['css'])) {
            $header_css = '<link rel="stylesheet" type="text/css" href="' . $this->page->header['css'] . '"/>';
        }
        if(isSet($this->page->header['js'])) {
            $header_js = '<script type="text/javascript" src="' . $this->page->header['js'] . '"></script>';
        }
        if(isSet($this->page->header['font'])) {
            $header_font = '<link href="' . $this->page->header['font'] . '" rel="stylesheet">';
        }

    }

?>