<?php

$time = time();
$file = $_SERVER['DOCUMENT_ROOT'] . '/config.json';
$newfile = $_SERVER['DOCUMENT_ROOT'] . '/backup/config-' . $time  . '.json';

$file_notices = $_SERVER['DOCUMENT_ROOT'] . '/view/__data/data_notices.json';
$newfile_notices = $_SERVER['DOCUMENT_ROOT'] . '/backup/data-notices-' . $time  . '.json';


if (!copy($file, $newfile)) {
    $time = "failed to copy config";
}

if (!copy($file_notices, $newfile_notices)) {
    $time = "failed to copy notices";
}

$html = <<<END
syncd($time)
END;

if( $_SERVER['REQUEST_URI'] != "/studio/api/update/settings") {
    echo $html;
}

?>
