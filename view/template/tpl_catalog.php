<!DOCTYPE html>

<?php $this->partial('header'); ?>

<body>
    
        <div style="background-color: #CCC">
                <?php 
                        $this->view(); 
                ?>
        </div>

    <?php $this->partial('footer'); ?>
    <?php $this->partial('analytics'); ?>

</body>
</html>