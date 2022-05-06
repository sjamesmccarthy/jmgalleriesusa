<?php

if($_SERVER['REMOTE_ADDR'] != "::1") {
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
} else {
    $_SESSION['ip'] = '127.0.0.1';
}

    session_destroy();
    unset($_SESSION);
    
    $this->log_watch(array("key" => "admin", "value" => "signed out successfully from " . $_SESSION['ip'], "type" => "system"));

    if($_REQUEST['ref'] == "collector") {
        $loc = "/d/collector/signin";
    } else {
        $loc = "/studio/signin";
    }

    header('location:' . $loc);
?>