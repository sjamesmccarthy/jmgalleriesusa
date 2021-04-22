<?php


    if($_SESSION['error'] == 'auth_0') {
        $showError = 'showError';
    } 

    // if($this->routes->URI->queryvals[1] == 'signout') {
    //     $showSignOut = ' showSignOut';
    //     session_destroy();
    // }

    if(isSet($_COOKIE['username'])) {
        $username = $_COOKIE['username'];
    }
    
    /* Reset session error */
    // $_SESSION['error'] = 'null';

?>