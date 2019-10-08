<?php

// $copyright = null;

if($this->routes->URI->page == 'detail') {
    $bc_catalog = '<img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="/galleries"/>Galleries</a> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="' . $this->catalog_path . '"/>' . $this->catalog_title . '</a>';
} else if ($this->routes->URI->page == 'catalog' ) {
    $bc_catalog = '<img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="/galleries"/>Galleries</a> ' . $bc_catalog;
} else {
    $bc_catalog = null;
}

?>