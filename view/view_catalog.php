<ul style="width: 95%; margin: auto;">

    <?php
        
        // $this->printp_r($this->content);

        $this->loadNegativeFile($this->content->catalog);

        for ($i = 0; $i < count($this->content->meta); $i++) {
            echo "<li style='display: inline; text-align: left;'>";
            echo '<a href="' . $this->content->catalog . '/' . $this->content->meta[$i]['file_name'] . '">';
            echo '<img src="/catalog' . $this->content->catalog . '/thumbnails/' . $this->content->meta[$i]['file_name'] . '.jpg" /></a>';
            echo "</li>";
        }

    ?>

</ul>

<p style="padding: 20px;"><a href="/">Back To Home</a></p>