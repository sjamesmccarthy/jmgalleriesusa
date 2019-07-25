<?php 
    $this->loadPhotoDetails($this->page->catalog, $this->page->photo);
    $file_name = "/catalog/__image/" . $this->page->file_name . ".jpg";
?>

<div style="display: block; margin: auto; text-align: center;">
    
    <img style="width: 100%" src="<?= $file_name ?>" alt="<?= $this->page-title ?>" />

    <p style="text-align: center; font-size: 2.0em;">
        <?= $this->page->title ?></p>
    <p style="margin-bottom: 80px"><?= $this->page->desc ?></p>
    <hr />
</div>

<p><a href="/<?= $this->page->catalog ?>">Back To <?= $this->page->category_title ?></a></p>
<p><a href="/">Back To Home</a></p>