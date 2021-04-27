        <div id="top-nav<?= $addToClass ?>">

            <?= $active ?>
            
            <div class="grid" style="position: relative;">
                <div class="col-5-middle small-hidden">
                    <p class="center heading"><a href="/polarized" class="<?= $polarized ?>">POLARIZED</a><br /><span class="font-light">my FIELD NOTES</span></p>
                </div>
                <div class="col-2 small-hidden">
                  <!-- logo_fullsize.png -->
                    <p class="topnav-logo"><a href="/"><img class="topnav--logo-img" src="/view/image/signature_full-web.png" alt="jm Galleries logo" /></a></p>
                </div>
                <div class="col-5-middle small-hidden">
                    <p class="center heading"><a href="/all" class="<?= $galleries ?>">THE WORK</a><br /><span class="font-light"><a class="font-light" href="/galleries">LIMITED</a> / <a class="font-light" href="/all?filter=tinyviews">OPEN</a> Ed.</span></p>
                </div>
                
            </div>

        </div>

        <div class="grid">
        <div class="col nav-mobile<?= $addToClass ?>">
            <p class="small text-right"><i class="fas fa-ellipsis-v"></i></p>
            <img class="nav-mobile-logo" src="/view/image/signature_full-web.png" alt="jm Galleries logo" />
        </div>
        </div>

        <ul class="nav-mobile-ul">
            <li class="close"><i class="fas fa-times-circle"></i>
            </li>
            <li><a href="/">HOME</a></li>
                <li><a href="/all?filter=limited">LIMITED EDITIONS</a></li>
                <li><a href="/all?filter=tinyviews">OPEN EDITIONS</a></li>
                <li><a href="/polarized">Field Notes @POLARIZED</a></li>
                <li><a href="https://vlog.jmgalleries.com">vlog @YOUTUBE</a></li>
                <li><a href="/shop">jM GALLERIES STORE</a></li>
                <li><a href="/about">ABOUT</a></li>
                <li><a href="/contact">CONTACT</a></li>
        </ul>


<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

    $('.nav-mobile, .nav-mobile-home').on("click", function () {
        $('.nav-mobile-ul').toggle();
    });

    $('.nav-mobile-ul .close').on("click", function () {
        $('.nav-mobile-ul').toggle();
    });

  });

</script>