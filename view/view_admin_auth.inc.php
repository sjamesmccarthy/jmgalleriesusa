<?php

    $auth = $this->api_Auth_User($_REQUEST['username'], $_REQUEST['password']);

    /* Determine if we are logged in */
    if($auth['result'] == '200') {
        /* Set Cookie info */
        $_SESSION['first'] = $auth[0]['frist_name'];
        $_SESSION['data'] = $session_data = json_encode($auth[0]);

        header('location:/studio/manage');
    } else {
        $_SESSION['error'] = 'auth_0';
        $_SESSION['login_attempt'] = $_SESSION['login_attempt'] + 1;
        header('location:/studio/signin');
    }


    /* Dev Password hash a924b62a3130d7c040d46338d21b2f86 */

?>