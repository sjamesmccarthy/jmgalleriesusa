<section class="pt-32 center">

    <h2>We're sorry, something went wrong.</h2>
    <p>For one reason or another we were unable to process your order at this time.</p>
    <p class="pt-32"><a href="<?= $_SERVER['HTTP_REFERER']; ?>">Try Again</a></p>
    <p>or <a href="/galleries">continue shopping in our galleries page</a></p>
    
   <?php
        // $_POST = $_SESSION['order_data'];
        // require_once($_SERVER["DOCUMENT_ROOT"] . '/view/email_order_LE.php');
        // echo $tmpl;
    ?>

</section>
<?= $you_may_also_like_html ?>

