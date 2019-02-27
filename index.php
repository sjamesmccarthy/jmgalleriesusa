<?php

    error_reporting(E_STRICT);

    /* Require the Core */
    require_once(__DIR__ . '/core.php');

    /* Start the micro-framework */
    $app = new Studio\Gallery\Core;

    /* Check URI against routes json file */
    $app->getRoute();

    /* Build the layout of the page */
    $app->buildLayout();

    /* Output the layout +page to screen */
    $app->renderPage();

    /* Debug Info */
    if($app->config->package_debug == "true" || $app->routes->URI->query == "debug=true") {
        echo "<div style='padding: 40px; background-color: rgba(255, 249, 222, 1);'><p>DEBUG</p>";
        echo "<hr /><p>Object(data)", $app->printp_r($app->data), "</p>";
        echo "<p>Object(routes->URI)", $app->printp_r($app->routes->URI), "</p>";
        echo "</div>";
    }

    /* Exit the micro-framework */
    exit();

?>