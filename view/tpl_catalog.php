<!DOCTYPE html>

    <?php $this->getPartial('header'); ?>
    <?php print $this->component('hero'); ?>
    
    <body>
        
        <?php print $this->component('notice'); ?>

            <main>

                <?php  $this->getPartial('nav'); ?>

                <!-- <div style="min-height: 100vh;"> -->
                    <?php $this->view() ?>
                <!-- </div> -->

            </main>                  
        
                <?php $this->getPartial('footer'); ?>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>