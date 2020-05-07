<!DOCTYPE html>

    <?php $this->getPartial('header'); ?>
    
    <body>
        
        <?php print $this->component('notice'); ?>
        <?php print $this->component('hero'); ?>

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