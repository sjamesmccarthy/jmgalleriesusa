<!DOCTYPE html>
<html lang="en">

    <?php $this->getPartial('header','admin'); ?>

    <body>
    <!--  class="dark-theme" -->

        <?php print $this->component('notice'); ?>

            <main>

                <div class="content_wrapper">
                    <?php $this->view() ?>
                </div>

            </main>

                <?php $this->getPartial('footer'); ?>
    </body>

</html>
