<ul style="width: 95%; margin: auto;">

    <?php
        
        $this->loadNegativeFile($this->page->catalog);

        for ($i = 0; $i < count($this->page->meta); $i++) {

            $file_name = '/catalog' . $this->page->catalog . '/thumbnails/' . $this->page->meta[$i]['file_name'] . '.jpg';

            // Check to see if file exists
            echo "<li style='display: inline; text-align: left;'>";
            echo '<a href="' . $this->page->catalog . '/' . $this->page->meta[$i]['file_name'] . '">';
           
            if(file_exists( $_SERVER['DOCUMENT_ROOT'] . $file_name )) {
            echo '<img src="' . $file_name . '" />';
            } else {
                echo $this->page->meta[$i]['file_name'] . '.jpg Not Found<br />';
            }
           
            echo '</a>';
            echo "</li>";
        }

    ?>

</ul>

<p style="padding: 20px;"><a href="/">Back To Home</a></p>