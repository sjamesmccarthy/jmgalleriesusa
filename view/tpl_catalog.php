<!DOCTYPE html>
    
    <?php $this->getPartial('header'); ?>
    
    <body>
        <main>
        
                <?php 
                    $this->getPartial('nav'); 
                ?>

                        <div style="min-height: 100vh;">
                            <?php 
                                $this->view() 
                            ?>
                        </div>
                        
        
        </main>
                <?php 
                    $this->getPartial('footer'); 
                ?>
    </body>
    
    <?php $this->getPartial('analytics'); ?>

</html>