<?php


    if ($this->routes->URI->page != "home") {

        /* If this is a polarized fieldnote load a different image path */
        if ($this->routes->URI->page == "polarized_post") {
            $og_image = "/view/image/fieldnotes/" . $this->page->image_path;
        } else {
            $og_image = "/catalog/__image/" . $this->page->photo_path . ".jpg";
        }
    } else {
        $og_image = "/view/image/logo_fullsize.png";
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