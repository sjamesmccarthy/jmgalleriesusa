<!DOCTYPE html>
    
    <?php $this->partial('header'); ?>
    
    <body>
        <div class="container">
        
                <?php $this->getPartial('nav'); ?>
                
                        <?php $this->view() ?>

                <?php $this->partial('footer'); ?>
        
        </div>
    </body>
    
    <?php $this->partial('analytics'); ?>

</html>