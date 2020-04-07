<?php

if($_SERVER['REMOTE_ADDR'] != "::1") {
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
} else {
    $_SESSION['ip'] = '127.0.0.1';
}

    // $this->log(array("key" => "admin", "value" => "session " . session_id() . " destroyed", "type" => "system"));
    session_destroy();
    $this->log(array("key" => "admin", "value" => "signed out successfully from " . $_SESSION['ip'], "type" => "system"));

    if($_REQUEST['ref'] == "collector") {
        $loc = "/d/collector/signin";
    } else {
        $loc = "/studio/signin";
    }

    header('location:' . $loc);
?>