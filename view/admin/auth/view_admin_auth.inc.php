<?php

    $auth = $this->api_Auth_User($_REQUEST['username'], $_REQUEST['password']);

    if($auth['result'] == '200') {

        /* Log the visit */
        $this->api_Admin_Auth_Log_Signin($auth['user_id']);
        
        // print $auth['result'] . "<br />";
        // print $_SESSION['dashboard'];
        
        switch($_SESSION['dashboard']) {
            
            case "ARTIST":
            $_SESSION['data'] = $session_data = json_encode($auth);
            // $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
            header('location:/studio/manage');
            break;

            case "COLLECTOR":
            $_SESSION['data'] = $session_data = json_encode($auth);
            // $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
            header('location:/d/collector');
            break;

            default:
            header('location:/404');
        } 

    } else {
        $_SESSION['error'] = 'auth_0';
        $_SESSION['login_attempt'] = $_SESSION['login_attempt'] + 1;
        header('location:' . $_POST['redirect_BADLOGIN']);
    }

?>