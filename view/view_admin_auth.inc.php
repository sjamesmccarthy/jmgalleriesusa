<?php

    /* Determine if we are logged in */
    if($_REQUEST['state'] == 'auth') {
        // echo "state.auth(" . $_REQUEST['auth'] . ")<br />";
        /* Set Cookie info */
        $_SESSION['first'] = $_REQUEST['username'];
        header('location:/admin/console');
    }


?>