<!DOCTYPE html>
    
    <?php $this->getPartial('header'); ?>
    <?php print $this->component('hero'); ?>
    
    <body>
    <!--  class="dark-theme" -->
        
        <?php print $this->component('notice'); ?>
        
            <main>
        
                <?php $this->getPartial('nav'); ?>

                    <div class="content_wrapper">
                        <?php $this->view() ?>
                    </div>

            </main>

                <?php $this->getPartial('footer'); ?>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>