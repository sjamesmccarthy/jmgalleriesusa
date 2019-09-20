<section id="footer">
            
        <!-- <div class="grid-max-width grid-noGutter"> -->
            <div class="footer-maxwidth">
            <div class="grid">
                <div class="col pb-32">
                    <a href="/"><img class="breadcrumb-logo" src="/view/image/logo_fullsize.png" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <?= $this->page->title ?>
                </div>

                <div class="col-right">
                     <a target="_social" href="https://twitter.com/jmgalleriesusa"><img src="/view/image/social_twitter.svg" /></a>
                    <a target="_social" href="https://instagram.com/jmgalleriesusa"><img src="/view/image/social_instagram.svg" /></a>
                    <a target="_social" href="https://linkedin.com/company/jmgalleriesusa"><img src="/view/image/social_linkedin.svg" /></a>
                    <a target="_social" href="https://medium.com/jmgalleriesusa"><img src="/view/image/social_medium.svg" /></a>
                </div>
            </div>

            <div class="grid">
                <div class="col-9">
                    <?php 
                        $this->getPartial('newsletter'); 
                    ?>
                </div>
            </div>

            <div class="grid">
                <div class="col-9_xs-3 mt-32">
                        <a href="/galleries">Galleries</a> | 
                        <a target="_new" href="/shop">TinyViews&trade; Store</a> | 
                        <a target="_shop" href="/polarized">Polarized Quarterly</a> | 
                        <a target="_new" href="/thestudio">Portraits, Events & Headshots</a> | 
                        <a href="/moments">Moments, News & Events</a> |
                        <a href="/about">About</a> |
                        <a href="/contact">Contact</a>
                </div>

                <div class="col-3_xs-3 mt-32" style="text-align: right; position: absolute; bottom: 32px; right: 32px;">
                    <p class="small"> <?= $this->config->copyright ?> | <a href="/legal">Terms of Use</a></p>
                </div>
            </div>

        </div>
        <!-- </div> -->
    </section>
