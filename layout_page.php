<html>

    <?php $this->insert('header'); ?>
    
    <p style='text-align: center; padding: 40px; background-color: rgba(0,0,0,1); color: #FFF'>layout_PAGE for <?= $this->content->layout ?></p>

        <div style="background-color: rgba(0,0,0,.3); padding: 100px;">
            <?php $this->getPageContent() ?>
        </div>

    <?php $this->insert('footer'); ?>
    <?php $this->insert('ga-code'); ?>