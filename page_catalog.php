<!-- <p>This is the <?= $this->data->title ?> catalog page type</p> -->
<!-- <p>We need to load the negative file for the collection of photos.</p> -->

    <!-- Load the _negatives catalog -->
    <!-- Do I use a separate class or keep it in Core -->

    <?php
        
        $this->loadNegativeFile($this->content->path);

        for ($i = 0; $i < count($this->content->meta); $i++) {

            // echo $this->content->meta[$i]['file_name'] . "<br />";
            echo '<img src="/collections' . $this->content->path . '/thumbnails/' . $this->content->meta[$i]['file_name'] . '" />';
        }

        // $this->printp_r($this->content->meta); 

    ?>
