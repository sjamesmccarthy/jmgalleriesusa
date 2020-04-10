<!DOCTYPE html>
    
    <?php $this->getPartial('header'); ?>
    
    <body>
        <main>
        
                <?php $this->getPartial('nav'); ?>

                        <div style="min-height: 100vh;">
                            <?php $this->view() ?>
                        </div>
                        
                <?php $this->getPartial('footer'); ?>
        
        </main>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>