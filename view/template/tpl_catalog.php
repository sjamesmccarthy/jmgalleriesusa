<!DOCTYPE html>
    
    <?php $this->partial('header'); ?>
    
    <body>
        <div style="padding-top: 40px" class="container">
        
                <?php $this->getPartial('nav'); ?>
                
                        <?php $this->view() ?>

                <?php $this->partial('footer'); ?>
        
        </div>
    </body>
    
    <?php $this->partial('analytics'); ?>

</html>