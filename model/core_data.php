<?php

class Core_Data extends Core
{
    public $outputVar;

    public function getJSON($file, $outputVar) {

    /* Loads JSON filer and then assigns object to passed var */
    $dataJSON = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/"  . $file);
    $data = json_decode($dataJSON, true);
    $this->$outputVar = (object) $data;
    }

}
?>