<?php

$catalog_names = $this->api_Catalog_Category_List();

foreach($catalog_names as $k => $v) {

    $collections_html .= '<li><a href="/' . $v['path'] . '">' . $v['title'] . '</a></li>';
}

if($this->routes->URI->page == 'detail') {
    $bc_catalog = '<img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="/galleries"/>Galleries</a> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="' . $this->catalog_path . '"/>' . $this->catalog_title . '</a>';
} else if ($this->routes->URI->page == 'catalog' ) {
    $bc_catalog = '<img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="/galleries"/>Galleries</a> ' . $bc_catalog;
} else {
    $bc_catalog = null;
}

?>