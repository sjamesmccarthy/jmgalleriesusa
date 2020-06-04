<!DOCTYPE html>

    <?php $this->getPartial('header'); ?>
    
    <body>
        
        <?php print $this->component('notice'); ?>

            <main>

                <?php  $this->getPartial('nav'); ?>
                <?php print $this->component('hero'); ?>

                <!-- <div style="min-height: 100vh;"> -->
                    <?php $this->view() ?>
                <!-- </div> -->

            </main>                  
        
                <?php $this->getPartial('footer'); ?>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>