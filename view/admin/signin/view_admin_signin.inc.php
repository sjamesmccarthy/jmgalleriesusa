<?php

if($this->page->catalog_path == '/d/collector/signin') {
    $title = 'jM Galleries';
    $action_URI = '/d/collector/auth';
    $redirect_BADLOGIN = '/d/collector/signin';
} else {
    $title = "the studio";
    $action_URI = '/studio/auth';
    $redirect_BADLOGIN = '/studio/signin';
}

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