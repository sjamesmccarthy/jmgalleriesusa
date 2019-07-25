<?php

class Core_Data extends Core
{

    public function getJSON($file, $output_var) {

    /* Loads JSON filer and then assigns object to passed var */
    $dataJSON = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/"  . $file);
    $data = json_decode($dataJSON, true);
    $this->$output_var = (object) $data;
    }

}
?>