<ul style="width: 95%; margin: auto;">

    <?php
        
        $this->loadNegativeFile($this->content->catalog);

        for ($i = 0; $i < count($this->content->meta); $i++) {
            echo "<li style='display: inline; text-align: left;'>";
            echo '<a href="' . $this->content->catalog . '/' . 'once-afloat">';
            echo '<img src="/catalog' . $this->content->catalog . '/thumbnails/' . $this->content->meta[$i]['file_name'] . '" /></a>';
            echo "</li>";
        }

        // $this->printp_r($this->content->meta); 

    ?>

</ul>