<?php

    /* Load all category meta data */
    $catalog_names = $this->api_Catalog_Category_List();

    foreach($catalog_names as $key=>$value) {

        echo "<hr />";
        echo "<p>" . $value['title'] . "</p>";
        echo "<p>" . $value['desc'] . "</p>";

        /* Get FilmStrip of photos by Category */
        $catalog_photos = $this->api_Catalog_Category_Filmstrip($value['catalog_category_id'], 4);

        echo "<ul>";
        foreach($catalog_photos as $k => $v) {
            echo "<li style='margin-left: 20px'>" . $v['title'] . ", " . $v['file_name'] . ".jpg </li>";
        }
        echo "</ul>";
    }


?>