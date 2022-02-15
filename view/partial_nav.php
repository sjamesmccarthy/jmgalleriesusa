        <div id="top-nav<?= $addToClass ?>">

            <?= $active ?>

            <div class="grid" style="position: relative;">
                <div class="col-5-middle small-hidden">
                    <p class="center heading"><a href="/shop" class="<?= $polarized ?>">THE SHOP</a><br /><span class="font-light">PRINTS & BOOKS</span></p>
                </div>
                <div class="col-2 small-hidden">
                  <!-- logo_fullsize.png -->
                    <p class="topnav-logo"><a href="/"><img class="topnav--logo-img" src="/view/image/signature-fine-art-upscaled.png" alt="jm Galleries logo" /></a></p>
                </div>
                <div class="col-5-middle small-hidden">
                    <p class="center heading"><a href="/limited-editions" class="<?= $galleries ?>">THE WORK</a><br /><span class="font-light"><!--<a class="font-light" href="/limited-editions"> -->LIMITED EDITIONS</span><!-- </a> -->
                    <!-- / <a class="font-light" href="/open-editions">OPEN</a> Ed.</span> -->
                  </p>
                </div>

            </div>

        </div>

        <div class="grid">

        <?php if( $addToClass == '-home' ) {
          // print "IF:" . $addToClass;
        ?>
          <div class="grid">
          <div class="col nav-mobile-menu">
              <p class="nav-bars <?= $this->color_text ?>"><i class="fas fa-bars"></i></p>
          </div>
          </div>
        <?php } else {
        // print "ELSE:" . $addToClass;
        ?>
          <div class="col nav-mobile<?= $addToClass ?>">
              <p class="nav-bars <?= $this->color_text ?>"><i class="fas fa-bars"></i></p>
              <img class="nav-mobile-logo" src="/view/image/signature-fine-art-upscaled.png" alt="jm Galleries logo" />
          </div>
          </div>
        <?php } ?>

        <ul class="nav-mobile-ul">
            <li class="close"><i class="fas fa-times-circle"></i>
            </li>
            <li class="mt-32"><a href="/">HOME</a></li>
                <li><a href="/all?filter=limited">LIMITED EDITIONS</a></li>
                <li><a href="/fieldnotes">Field Notes About Fine Art</a></li>
                <li><a href="https://vlog.jmgalleries.com">vlog @YOUTUBE</a></li>
                <li><a href="/shop">SHOP</a></li>
<!--                 <li><a href="/all?filter=tinyviews">OPEN EDITIONS</a></li> -->
                <li><a href="/about">ABOUT</a></li>
                <li><a href="https://linktr.ee/jmgalleriesusa">FIND ME</a></li>
                <li><a href="/contact">CONTACT</a></li>

                <li class="mt-32"><p class="topnav-logo"><img class="topnav--logo-img" style="width: 240px;" src="/view/image/signature-fine-art-upscaled.png" alt="jm Galleries logo" /></p></li>
        </ul>


<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

    $('.nav-mobile, .nav-mobile-home, .nav-mobile-menu').on("click", function () {
        $('.nav-mobile-ul').toggle();
    });

    $('.nav-mobile-ul .close').on("click", function () {
        $('.nav-mobile-ul').toggle();
    });

  });

</script>
