<div style="display: block; margin: auto; text-align: center;">
    
    <?php 

        $this->loadPhotoDetails($this->page->catalog, $this->page->photo);
        
        // $this->printp_r($this);

        $file_name = "/catalog/" . $this->page->catalog . "/" . $this->page->file_name . ".jpg";

           if(file_exists( $_SERVER['DOCUMENT_ROOT'] . $file_name )) {
            echo '<img src="' . $file_name . '" />';
            } else {
                echo '<img src="/view/image/noimage.png" alt="' . $file_name . '" />';
            }
    ?>
    
    <p style="text-align: center; font-size: 2.0em;"><?= $this->page->title ?></p>
    <p style="margin-bottom: 80px"><?= $this->page->desc ?></p>
    <hr />
</div>



<p><a href="/<?= $this->page->catalog ?>">Back To <?= $this->page->category_title ?></a></p>
<p><a href="/">Back To Home</a></p>