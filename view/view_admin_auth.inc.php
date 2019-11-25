<?php

    $auth = $this->api_Auth_User($_REQUEST['username'], $_REQUEST['password']);

    /* Determine if we are logged in */
    if($auth['result'] == '200') {
        /* Set Cookie info */
        $_SESSION['data'] = $session_data = json_encode($auth[0]);
        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
        header('location:/studio/manage');
    } else {
        $_SESSION['error'] = 'auth_0';
        $_SESSION['login_attempt'] = $_SESSION['login_attempt'] + 1;
        header('location:/studio/signin');
    }

?>