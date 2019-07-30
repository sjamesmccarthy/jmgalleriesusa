<!DOCTYPE html>
    
    <?php $this->getPartial('header'); ?>
    
    <body>
        <div style="padding-top: 40px" class="container">
        
                <?php $this->getPartial('nav'); ?>
                
                        <?php $this->view() ?>

                <?php $this->getPartial('footer'); ?>
        
        </div>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>