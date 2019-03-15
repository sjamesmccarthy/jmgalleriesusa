<?php

    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    $sr = $_SERVER["DOCUMENT_ROOT"];

    /* Require the Core */
    require_once( $sr . '/controller/core.php');
    require_once( $sr . '/model/core_data.php');
    require_once( $sr . '/controller/catalog.php');
     
    /* Start the micro-framework */
    $core = new Catalog();

    /* Import the config file */
    $core->getJSON('config.json','config');

    /* Import the routing paths */
    $core->getJSON('routes.json','routes');

    /* Initialize the Session */
    $core->initSession();

    /* Check URI against routes json file */
    $core->getRoute();

    /* Build the layout of the page and render */
    $core->render();

    /* Debug Info */
    $core->debugInfo();

    /* Exit the micro-framework */
    exit();

?>