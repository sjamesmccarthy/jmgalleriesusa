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
    // print $title_formatted;

?>