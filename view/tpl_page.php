<!DOCTYPE html>
    
    <?php $this->getPartial('header'); ?>
    
    <body>
        <main>
        
                <?php $this->getPartial('nav'); ?>
                
                        <?php $this->view() ?>

                <?php $this->getPartial('footer'); ?>
        
        </main>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>