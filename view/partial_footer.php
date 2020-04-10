<section id="footer">
    
    <!-- <div class="thin-line"></div> -->
    
    <div class="footer-maxwidth pt-32 pb-32">

                <div class="grid-4">
                    <div class="col-7 foot-news">
                    <?php 
                        $this->getPartial('newsletter'); 
                    ?>
                    </div>
                </div>
        
        <div class="grid">

            <div class="col-12">
            <ul>
                <?= $collections_html ?>
                <li><a href="/all">View All</a></li>
                <li>&mdash;</li>
                <li><a href="/all">Pricing</a></li>
                <li><a href="/all">Contact</a></li>
            </ul>
            </div>

            <!-- <div class="grid">
                <div class="col-3 footer-column mb-32">
                    <h3>COLLECTIONS</h3>
                    <ul>
                        <?= $collections_html ?>
                        <li class="top-border"><a href="/all">View All</a></li>
                    </ul>
                </div>

                <div class="col footer-column">
                    <h3>EXPLORE</h3>
                    <ul>
                        <li><a href="/exhibits">Exhibits</a></li>
                        <li><a href="/styles">Editions & Framing</a></li>
                        <li><a href="/moments">Moments, News & Events</a></li>
                        <li><a target="_shop" href="/thestudio">The Studio</a></li>
                        <li><a target="_blog" href="https://medium.com/jmgalleriesusa">Polarized Quarterly</a></li>
                    </ul>
                </div>

                <div class="col footer-column">
                        <h3>SHOP</h3>
                            <ul>
                                <li><a target="_shop" href="/shop">tinyViews™</a></li>
                                <li><a href="/styles">Fine-Art Pricing</a></li>
                                <li><a href="/contact">Customer Service</a></li>
                            </ul>
                </div>

                <div class="col footer-column">
                    <h3>ABOUT</h3>
                        <ul>
                            <li><a href="/about">the Photographer</a></li>
                            <li><a href="/legal">Privacy Policy</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                        </ul>
                </div>

            </div> -->

                <div class="col-6 breadcrumb">
                <p><a href="/"><img class="breadcrumb-logo" src="/view/image/logo_fullsize.png" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /><?= $this->page->title ?> </p>
                </div>
                <div class="col-6 breadcrumb">
                <p class="right"> <?= $this->config->copyright ?> | <a href="/legal">Terms of Use</a></p>
                </p>
                </div>

        </div>

    </div>
</section>
