<?php

// $copyright = null;

if($this->routes->URI->page == 'detail') {
    $bc_catalog = '<img style="vertical-align: middle; opacity: .6; width: 16px; height: 16px" src="/view/image/icon_navarrow-right.svg" /> <a href="/galleries"/>Galleries</a> <img style="vertical-align: middle; opacity: .6; width: 16px; height: 16px" src="/view/image/icon_navarrow-right.svg" /> <a href="' . $this->catalog_path . '"/>' . $this->catalog_title . '</a>';
} else if ($this->routes->URI->page == 'catalog' ) {
    $bc_catalog = '<img style="vertical-align: middle; opacity: .6; width: 16px; height: 16px" src="/view/image/icon_navarrow-right.svg" /> <a href="/galleries"/>Galleries</a> ' . $bc_catalog;
} else {
    $bc_catalog = null;
}

?>