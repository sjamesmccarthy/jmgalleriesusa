<section class="pt-32">

    <div class="grid-center">
        <div class="col-8_sm-12">
            <?php

                    $_POST = $_SESSION['order_data'];
                    require_once($_SERVER["DOCUMENT_ROOT"] . '/view/' .  $_SESSION['layout']);
                    echo $tmpl;
                ?>
        </div>
    </div>

</section>

