<style>
    .contact-form-label {
    font-size: 18px;
    font-weight: 7800;
    /* line-height: 1; */
    margin-top: 40px;
}

.contact-form-interest-list {
    list-style: none;
    margin-top: 20px;
}

.contact-form-interest-list > li {
    margin-left: 20px;
    font-size: 18px;
    margin-top: 10px;
    /* line-height: 1.0; */
}

.contact-form-interest-list > li > input[type="radio"] {
    margin-right: 10px;
}

</style>

   <section id="footer" class="pt-32">

        <div class="thin-line footer-background"><?= $addToClass ?>
    <p smallhalf style="position: absolute; right: 20px; bottom: 20px;"><?= $this->config->copyright ?></p>

</div>
            
        <div class="grid-noGutter">

            <div class="col-12">
                <div class="col-12-middle pb-32" style="font-weight: 300">
                 <a href="/"><img src="/view/image/logo_fullsize.png" style="width: 28px; vertical-align: middle" /></a> <?= $bc_catalog ?> <img style="vertical-align: middle; opacity: .6; width: 16px; height: 16px" src="/view/image/icon_navarrow-right.svg" /> <?= $this->page->title ?>
               </div>
            </div>

            <div class="col-4-top md-hidden pt-16">
                <?php 
                    $this->getPartial('newsletter'); 
                ?>


                <div class="pt-24 pt-16">
                    <!-- <a href="/"><img src="/view/image/logo_fullsize.png" style="width: 28px;" /></a> -->
                    <a target="_social" href="https://twitter.com/jmgalleriesusa"><img src="/view/image/social_twitter.svg" /></a>
                    <a target="_social" href="https://instagram.com/jmgalleriesusa"><img src="/view/image/social_instagram.svg" /></a>
                    <a target="_social" href="https://linkedin.com/company/jmgalleriesusa"><img src="/view/image/social_linkedin.svg" /></a>
                    <a target="_social" href="https://medium.com/jmgalleriesusa"><img src="/view/image/social_medium.svg" /></a>
                </div>

            </div>
            
            <div class="col-2 pt-16" style="padding-left: 16px">
                <h4 style="padding-bottom: 16px;">EXPLORE</h4>
                <ul>
                    <li><a href="/galleries">Galleries</a></li>
                    <li><a href="/exhibits">Exhibitions</a></li>
                    <li><a href="/styles">Frames, Styles & Editions</a></li>
                    <li><a href="/moments">News & Moments</a></li>
                    <li><a target="_blog" href="https://medium.com/jmgalleriesusa">Polarized</a></li>
                </ul>
            </div>

            <div class="col-2 pt-16" style="padding-left: 16px">
                <h4 style="padding-bottom: 16px;">ABOUT</h4>
                    <ul>
                        <li><a href="/about">the Photographer</a></li>
                        <!-- <li><a href="/styles">Limited Editions</a></li> -->
                        <li><a href="/legal">Privacy Policy</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
            </div>

            <div class="col-2 pt-16" style="padding-left: 16px">
                    <h4 style="padding-bottom: 16px;">SALES</h4>
                        <ul style="margin-left: 5px;">
                            <li><a href="/styles">Pricing</a></li>
                            <li><a href="/contact">Customer Service</a></li>
                            <li><a href="/newsletter">Monthly Amazing Offer</a></li>
                        </ul>
            </div>

            <div class="col-2 pt-16" style="padding-left: 16px">
                    <h4 style="padding-bottom: 16px;">SHOP</h4>
                        <ul>
                            <li><a target="_shop" href="/shop">tinyViews™</a></li>
                            <!-- <li><a href="/shop">2019 Calendar</a></li> -->
                            <!-- <li><a target="_shop" href="/books">Books</a></li> -->
                            <li><a target="_shop" href="/portraits-events-headshots">Portraits, Events & Headshots</a></li>
                        </ul>
            </div>

            
        </div>
    </section>
