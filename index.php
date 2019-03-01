<?php

    error_reporting(E_STRICT);

    /* Require the Core */
    require_once(__DIR__ . '/core.php');

    /* Start the micro-framework */
    $app = new Studio\Gallery\Core;

    /* Check URI against routes json file */
    $app->getRoute();

    /* Build the layout of the page and render */
    $app->render();

    /* Debug Info */
    $app->debugInfo();

    /* Exit the micro-framework */
    exit();

?>