<?php
    /* Copyright 2020, j.McCarthy */

    /* Error reporting levels being outputted to screen and logged */
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

    /* Require the Core */
    require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
    require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
    require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
     
    /* Start */
    $core = new Core_Site();

    /* Build the layout of the page and render */
    $core->render();

    /* Debug Info */
    $core->debugInfo();

    /* Exit, End App */
    exit();	

?>