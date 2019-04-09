<?php

    /* Error reporting levels being outputted to screen and logged */
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

    /* Require the Core */
    require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core.php');
    require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_data.php');
    require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
    require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/catalog.php');
     
    /* Start the micro-framework */
    $core = new Catalog();

    /* Import the config file */
    $core->getJSON('config.json','config');

    /* Import the auth_config file */
    $core->getJSON('config_env.json','config_env');

    /* Get and Set the environment: local or prod */
    $core->getEnv();

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