<?php

    /* Determine if we are logged in */
    if($_REQUEST['state'] == 'valid') {
        // echo "state.auth(" . $_REQUEST['auth'] . ")<br />";
        /* Set Cookie info */
        $_SESSION['first'] = $_REQUEST['username'];
        header('location:/studio/manage');
    } else {
        print "Auth.Failed()";
        exit;
    }


    /* Dev Password hash a63ac3fca2cdfff0a3ef843213af33cb */

?>