<?php


    if($_SESSION['error'] == 'auth_0') {
        $showError = 'showError';
    } 

    if($this->routes->URI->queryvals[1] == 'signout') {
        $showSignOut = ' showSignOut';
        session_destroy();
    }

    /* Reset session error */
    $_SESSION['error'] = 'ready';

?>