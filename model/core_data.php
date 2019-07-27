<?php

class Core_Data extends Core
{

    public function getJSON($file, $output_var) {

        /* Loads JSON filer and then assigns object to passed var */
        $dataJSON = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/"  . $file);
        $data = json_decode($dataJSON, true);
        $this->$output_var = (object) $data;
    }

    public function getPartial($partial) {

        /* Check to see if the partial file has an Include Component with it */
        $file = $_SERVER['DOCUMENT_ROOT'] . '/view/partial/partial_' . $partial;
        if( file_exists($file . ".inc.php") ) {
            include_once($file . "inc.php");
        } 
        
        /* Include the partial file if exists */
        if( file_exists($file . '.php')) {
            include_once($file . '.php');
        } else {
            echo "Requested Object Not Available: " . $partial;
        }
    }

}
?>