<html>
    <?php $this->insert('header'); ?>

        <div style="background-color: rgba(0,0,0,.3); padding: 100px;">
            <?php $this->getPageContent() ?>
        </div>

    <?php $this->insert('footer'); ?>
    <?php $this->insert('analytics'); ?>