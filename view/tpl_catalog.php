<!DOCTYPE html>
    
    <?php $this->getPartial('header'); ?>
    
    <body>
        <div class="container">
        
                <?php $this->getPartial('nav'); ?>
                
                        <?php $this->view() ?>

                <?php $this->getPartial('footer'); ?>
        
        </div>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>