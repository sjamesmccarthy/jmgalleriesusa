<?php
    
    $this->loadCategoryNames();

    foreach($this->data as $key=>$value) {
        $c_list .= "<li><a href=\"" . $value['path'] . "\">";
        $c_list .= "c_" . $value['title'];
        $c_list .= "</a></li>";
    }

?>

<div style="width: 20%; padding: 60px; margin: auto">
    <P>WELCOME TO THE HOME PAGE</P>

        <ul>
            <?= $c_list ?>
        </ul>

        <p><a href='/about'>About</a></p>
</div>