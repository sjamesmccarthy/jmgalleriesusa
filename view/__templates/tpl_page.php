<!DOCTYPE html>
<html lang="en">

    <?php $this->getPartial('header'); ?>
    <?php print $this->component('notice'); ?>
    <?php print $this->component('hero'); ?>

    <body oncontextmenu="return false;" class="<?= $this->config_env->env[$this->env]['default_theme'] ?>">
    <!--  class="dark-theme" -->
            <main>

                <?php $this->getPartial('nav'); ?>

                    <div class="content_wrapper">
                        <?php $this->view() ?>
                    </div>

            </main>

                <?php $this->getPartial('footer'); ?>
    </body>

</html>
