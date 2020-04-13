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

if(!isSet($_COOKIE['cookie_consent'])) {
    $cookie_consent = '<div class="cookie_banner">
    <p><i class="fas fa-cookie-bite"></i></p>
    <p class="pt-8">jM Galleries uses Strictly Necessary, Functional and Performance Cookies as described in our <a href="/privacy">Privacy Policy.</a><br /><a href="//duckduckgo.com">IF YOU DO NOT AGREE click here to leave.</a></p>
    <p class="right"><button id="cookie_consent" class="button-inv">I Agree</button>
    </div>';
} 

?>