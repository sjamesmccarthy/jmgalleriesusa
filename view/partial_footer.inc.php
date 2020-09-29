<?php

$catalog_names = $this->api_Catalog_Category_List();
$version = $this->config->package_version;

if($this->env == "local") {
    $env = "<p style='background-color: yellow; color: black; padding: 10px;'>env:" . $this->env . "</p>";
}

foreach($catalog_names as $k => $v) {
    $collections_html .= '<li><a href="/' . $v['path'] . '">' . $v['title'] . '</a></li>';
}

if($this->routes->URI->page == 'detail') {
    $bc_catalog = '<img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="/galleries"/>Galleries</a> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="' . $this->page->catalog_path . '"/>' . $this->catalog_title . '</a>';
} else if ($this->routes->URI->page == 'catalog' ) {
    $bc_catalog = '<img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <a href="/galleries"/>Galleries</a> ' . $bc_catalog;
} else {
    $bc_catalog = null;
}

if(!isSet($_COOKIE['cookie_consent'])) {
    $cookie_consent = '<div class="cookie_banner">
    <p><i class="fas fa-cookie-bite"></i></p>
    <p class="pt-8">jM Galleries uses <a href="/privacy#p3">Strictly Necessary, Functional and Performance Cookies</a> as described in our Privacy Policy.<br /><a href="//duckduckgo.com">if you do not agree, click here.</a></p>
    <p class="pull-right"><button id="cookie_consent" class="button-inv">ACCEPT COOKIES</button>
    </div>';
} 

?>