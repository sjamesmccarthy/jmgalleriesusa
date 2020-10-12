   <!-- <section id="top-nav<?= $addToClass ?>"> -->
        <div id="top-nav<?= $addToClass ?>" class="grid">
    
            <?= $active ?>

            <div class="col-2-middle md-hidden sm-hidden">
                <p class="center heading" ><a href="/all?filter=tinyviews" class="<?= $all ?>">tinyVIEWS<span style="font-size:.9rem; font-weight: 300;"><sup>&trade;</sup></span></a><br /><span class="font-light">OPEN EDITIONS</span></p>
            </div>
            <div class="col-3-middle md-hidden sm-hidden">
                <p class="center heading"><a href="/polarized" class="<?= $polarized ?>">FIELD NOTES</a><br /><span class="font-light">the JOURNAL</span></p>
            </div>
            <div class="col-2-middle md-hidden sm-hidden">
                <p class="topnav-logo"><a href="/"><img class="topnav--logo-img" src="/view/image/logo_fullsize.png" /></a></p>
                <p class="topnav-subline">beta</p>
            </div>
            <div class="col-3-middle md-hidden sm-hidden">
                <p class="center heading"><a href="/galleries" class="<?= $galleries ?>">THE WORK</a><br /><span class="font-light">LIMITED EDITIONS</span></p>
            </div>
            <!-- <div class="col-3_md-hidden-middle">
                <p class="center heading"><a href="/moments" class="<?= $moments ?>">MOMENTS</a><br />NEWS & EVENTS</p>
            </div> -->
            <div class="col-2-middle md-hidden sm-hidden">
                <p class="center heading"><a href="/about" class="<?= $about ?>">ABOUT</a><br /><span class="font-light">j.MCCARTHY</span></p>
            </div>

        </div>

        <div class="grid">
        <div class="col nav-mobile<?= $addToClass ?>">
            <!-- <i class="fas fa-bars" aria-hidden="true"></i> -->
            <img class="nav-mobile-logo" src="/view/image/logo_fullsize.png" />
            <p>MENU</p>
        </div>
        </div>

        <ul class="nav-mobile-ul">
            <li class="close"><i class="fas fa-times-circle"></i>
            </li>
                <li><a href="/">HOME</a></li>
                <li><a href="/polarized" class="<?= $polarized ?>">FIELD NOTES</a></li>
                <li><a href="/galleries" class="<?= $galleries ?>">LIMITED EDITIONS</a></li>
                <li><a href="/all?filter=tinyviews" class="<?= $all ?>">tinyVIEWS OPEN EDITIONS</a></li>
                <li><a href="/about" class="<?= $about ?>">ABOUT j.McCarthy</a></li>
        </ul>

        <div class="thin-line<?= $addToClass ?>"></div>
    <!-- </section> -->

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