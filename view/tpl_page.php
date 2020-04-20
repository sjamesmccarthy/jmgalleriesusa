<!DOCTYPE html>
    
    <?php $this->getPartial('header'); ?>
    
    <body>

        <?php $this->getPartial('notice'); ?>
        <?php print $this->component('hero'); ?>

            <main>
        
                <?php $this->getPartial('nav'); ?>

                    <div style="min-height: 100vh;">
                        <?php $this->view() ?>
                    </div>

            </main>

                <?php $this->getPartial('footer'); ?>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>