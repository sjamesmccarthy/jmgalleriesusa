<?php

class Core_Api extends Core_Data
{
    public $outputVar;

    public function getCatalogIndex($outputVar) {
        /* Executes SQL and then assigns object to passed var */

        $this->checkDBConnection(__FUNCTION__);

        $data = array('catalog' => 'Oceans, Lakes and Waterfalls (fake)');

        $this->$outputVar = (object) $data;
    }

}
?>