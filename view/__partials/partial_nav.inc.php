<?php


    $nav_pages = array('all', 'polarized', 'moments', 'about', 'galleries', 'product');
    $current_page = ltrim($this->page->catalog_path, '/');

    if($this->page->catalog_path == "/" || $this->page->catalog_path == "/fineart" || $this->page->catalog_path == "/index" ) {
        $addToClass = '-home';
    } else {
        $addToClass = null;

        foreach ($nav_pages as $k => $v) {

            if ( $current_page == $v) {
                ${$current_page} = "active-" . $current_page;
            } else if ( strpos($current_page, 'polarized') !== false ) {
                $polarized = "active-polarized";
            }

        }

    }

?>
