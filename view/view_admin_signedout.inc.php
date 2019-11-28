<?php

    $this->log(array("key" => "admin", "value" => "session " . session_id() . " destroyed", "type" => "system"));
    session_destroy();
    $this->log(array("key" => "admin", "value" => "signed out successfully from " . $_SESSION['ip'], "type" => "system"));

?>