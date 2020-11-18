<section class="pt-32">

   <?php

        $_POST = $_SESSION['order_data'];
        require_once($_SERVER["DOCUMENT_ROOT"] . '/view/email_order_LE.php');
        echo $tmpl;
    ?>

</section>
<?= $you_may_also_like_html ?>

