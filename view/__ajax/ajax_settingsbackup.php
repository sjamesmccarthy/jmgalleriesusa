<?php

$time = time();
$file = $_SERVER['DOCUMENT_ROOT'] . '/config.json';
$newfile = $_SERVER['DOCUMENT_ROOT'] . '/config-' . $time  . '.json';


if (!copy($file, $newfile)) {
    $time = "failed to copy";
}

$html = <<<END
syncd.$time
END;

if( $_SERVER['REQUEST_URI'] != "/studio/api/update/settings") {
    echo $html;
}

?>
