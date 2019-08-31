<?php

    if ($this->routes->URI->page != "home") {
        $addSiteName = $this->config->site_name . ' | ';
    } else {
        $addSiteName = null;
    }
    
?>