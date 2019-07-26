<?php
    $this->loadCategoryNames();

    foreach($this->data as $key=>$value) {
        $c_list .= "<li><a href=\"" . $value['path'] . "\">";
        $c_list .= "c_" . $value['title'];
        $c_list .= "</a></li>";
    }

?>