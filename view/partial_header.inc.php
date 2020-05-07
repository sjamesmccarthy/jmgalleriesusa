<?php

    if ($this->routes->URI->page != "home") {
        $addSiteName = $this->config->site_name . ' | ';
        $og_image = "/catalog/__image/" . $this->page->photo_path . ".jpg";
        
    } else {
        $addSiteName = null;
        $og_image = "/view/image/logo_fullsize.png";
    }


?>