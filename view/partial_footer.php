<section id="footer" class="pt-32">

    <div class="footer-background"><?= $addToClass ?>
        <p class="copyright"><?= $this->config->copyright ?></p>
    </div>
            
        <div class="grid-noGutter">

            <div class="col-12">
                <div class="col-12-middle pb-32 breadcrumb">
                 <a href="/"><img class="breadcrumb-logo" src="/view/image/logo_fullsize.png" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <?= $this->page->title ?>
               </div>
            </div>

            <div class="col-4-top pt-16">
                <?php 
                    $this->getPartial('newsletter'); 
                ?>


                <div class="pt-24 pt-16 social">
                    <a target="_social" href="https://twitter.com/jmgalleriesusa"><img src="/view/image/social_twitter.svg" /></a>
                    <a target="_social" href="https://instagram.com/jmgalleriesusa"><img src="/view/image/social_instagram.svg" /></a>
                    <a target="_social" href="https://linkedin.com/company/jmgalleriesusa"><img src="/view/image/social_linkedin.svg" /></a>
                    <a target="_social" href="https://medium.com/jmgalleriesusa"><img src="/view/image/social_medium.svg" /></a>
                </div>

            </div>
            
            <div class="col-2 footer-column">
                <h4>EXPLORE</h4>
                <ul>
                    <li><a href="/galleries">Galleries</a></li>
                    <li><a href="/exhibits">Exhibitions</a></li>
                    <li><a href="/styles">Frames, Styles & Editions</a></li>
                    <li><a href="/moments">News & Moments</a></li>
                    <li><a target="_blog" href="https://medium.com/jmgalleriesusa">Polarized</a></li>
                </ul>
            </div>

            <div class="col-2 footer-column">
                <h4>ABOUT</h4>
                    <ul>
                        <li><a href="/about">the Photographer</a></li>
                        <li><a href="/legal">Privacy Policy</a></li>
                        <li><a href="/contact">Contact Us</a></li>
                    </ul>
            </div>

            <div class="col-2 footer-column">
                    <h4>SALES</h4>
                        <ul>
                            <li><a href="/styles">Pricing</a></li>
                            <li><a href="/contact">Customer Service</a></li>
                            <li><a href="/newsletter">Monthly Amazing Offer</a></li>
                        </ul>
            </div>

            <div class="col-2 footer-column" >
                    <h4>SHOP</h4>
                        <ul>
                            <li><a target="_shop" href="/shop">tinyViews™</a></li>
                            <li><a target="_shop" href="/portraits-events-headshots">Portraits, Events & Headshots</a></li>
                        </ul>
            </div>

            
        </div>
    </section>
