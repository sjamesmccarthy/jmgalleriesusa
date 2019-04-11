<div style="width: 20%; padding: 60px; margin: auto">
    <P>WELCOME TO THE HOME PAGE</P>

    <?php
        
        $this->loadCategoryNames();

        /* Loop through "collection_photo". If $photo = $file_name" */
        $catalog_categories = (array) $this->data;


        for ($i = 0; $i < count($catalog_categories); $i++) {
            echo "<li>";
            echo '<a href="/' . $catalog_categories[$i]['path'] . '">';
            echo $catalog_categories[$i]['title'] . '</a>';
            echo "</li>";
        }

    ?>

        <p><a href='/about'>About</a></p>
</div>