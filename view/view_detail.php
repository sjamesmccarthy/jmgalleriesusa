<p style="text-align: center; font-size: 2.0em;"><?= $this->content->title ?></p>

<?php 
    $this->loadPhotoDetails($this->content->catalog, $this->content->photo);
?>

<div style="display: block; margin: auto; text-align: center;">
    <img 
        src="/catalog<?= $this->content->catalog ?>/<?= $this->content->photo ?>.jpg" alt="<?= $this->content->title ?>" 
    />
    <p style="margin-top: 40px"><?= $this->content->meta['desc'] ?></p>
</div>



<p><a href="<?= $this->content->catalog ?>">Back To <?= $this->content->catalog ?></a></p>
<p><a href="/">Back To Home</a></p>