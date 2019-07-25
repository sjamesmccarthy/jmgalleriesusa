<?php
    
    $this->loadNegativeFile($this->page->catalog);

        foreach($this->page->thumbnails as $key=>$value) {
        $file_name = '/catalog' . '/__thumbnail/' . $value['file_name'] . '.jpg';

        if(file_exists( $_SERVER['DOCUMENT_ROOT'] . $file_name )) {
            $p_thumbs .= '<li style="box-sizing: border-box; display: inline-block; height: 240px; overflow: hidden; margin-bottom: -4px;">';
            $p_thumbs .= '<a href="' . $this->page->catalog . '/' . $value['file_name'] . '">';
            $p_thumbs .= '<img style="width: 100%" src="'. $file_name . '" />';
            $p_thumbs .= '</a></li>';
        } else {
            $p_thumbs .= "";
        }

    }

?>

<h1 style="text-align: center; padding-top: 40px"><?= $this->page->title ?></h1>

    <ul style="width: 95%;">
    <?= $p_thumbs ?>
    </ul>

<p style="padding: 20px; clear: both;"><a href="/">Back To Home</a></p>