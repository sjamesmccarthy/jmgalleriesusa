        <div id="top-nav<?= $addToClass ?>">

            <?= $active ?>

            <div class="grid" style="position: relative;">
                <div class="col-5-middle small-hidden text-lower">
                    <!-- <p class="center heading"><a href="/shop" class="<?= $polarized ?>">THE SHOP</a><br /><span class="font-light">tiny<span class="text-upper">VIEWS</span> & BOOKS</span></p> -->
                    <p class="center heading"><a href="/about" class="<?= $polarized ?>">THE ARTIST</a> | <a href="/fieldnotes">FieldNotes</a></p>
                </div>
                <div class="col-2 small-hidden">
                  <!-- logo_fullsize.png -->
                    <p class="topnav-logo topnav--logo-img"><a href="/fineart"><img class="topnav--logo-img" src="/view/__image/signature-fine-art-upscaled.png" alt="jm Galleries logo" /></a></p>
                </div>
                <div class="col-5-middle small-hidden text-lower">
                    <!-- <p class="center heading"><a href="/thework" class="<?= $galleries ?>">THE WORK</a><br /><span class="font-light"><a class="font-light" href="/limited-editions">LIMITED & OPEN Ed.</span></a> -->
                    <p class="center heading"><a href="/thework" class="<?= $galleries ?>">THE WORK</a> | <a href="/shop">Shop</a></span><!-- </a> -->
                    <!-- / <a class="font-light" href="/open-editions">OPEN</a> Ed.</span> -->
                  </p>
                </div>

            </div>

        </div>

        <div class="grid">

        <?php if ($addToClass == "-home") {
          // print "IF:" . $addToClass;
          ?>

          <div class="">
          <div class="col nav-mobile-menu">
              <p class="nav-bars <?= $this->color_text ?>"><i class="fas fa-bars"></i></p>
          </div>
          </div>
        <?php } else {
          // print "ELSE:" . $addToClass;
          ?>
          <div class="col nav-mobile<?= $addToClass ?>">
              <p class="nav-bars <?= $this->color_text ?>"><i class="fas fa-bars"></i></p>
              <img class="nav-mobile-logo" src="/view/__image/signature-fine-art-upscaled.png" alt="jm Galleries logo" />
          </div>
          </div>
        <?php } ?>

        <ul class="nav-mobile-ul">
            <li class="close"><i class="fas fa-times-circle"></i>
            </li>
            <li class="mt-32"><a href="/fineart">HOME</a></li>
                <li><a href="/thework">THE WORK</a></li>
                <li><a href="/fieldnotes">FIELD NOTES</a></li>
                <!-- <li><a href="https://vlog.jmgalleries.com">vlog @YOUTUBE</a></li> -->
                <li><a href="/shop">THE SHOP</a></li>
                <!-- <li><a href="/all?filter=tinyviews">OPEN EDITIONS</a></li> -->
                <li><a href="/about">THE ARTIST</a></li>
                <li><a href="https://linktr.ee/jmgalleriesusa">CONTACT</a></li>
                <!-- <li><a href="/contact">CONTACT</a></li> -->

                <li class="mt-16"><p class="topnav-logo"><a href="/fineart"><img class="topnav--logo-img logo-white" style="width: 240px;" src="/view/__image/signature-fine-art-upscaled.png" alt="jm Galleries logo" /></a></p></li>

                <li><p><a target="_jmportraits" href="https://jmgalleries.pixieset.com/">Portraits, Weddings, Real Estate<br />and Lifestyle Photography  <i class="fa-solid fa-arrow-up-right-from-square tiny"></i></a></p></li>
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
