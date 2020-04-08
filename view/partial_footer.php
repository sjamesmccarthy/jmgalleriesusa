<section id="footer">
        
        <div class="thin-line"></div>

        <div class="footer-maxwidth pt-32">

            <div class="grid">
                <div class="col-12">
                    <div class="col pb-32 breadcrumb">

                    <a href="/"><img class="breadcrumb-logo" src="/view/image/logo_fullsize.png" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <?= $this->page->title ?>
                </div>
                </div>
            </div>

            <div class="grid">
                <div class="col-3 footer-column mb-32">
                    <h3>COLLECTIONS</h3>
                    <ul>
                        <?= $collections_html ?>
                        <li class="top-border"><a href="/all">View All</a></li>
                    </ul>
                </div>

                <div class="col footer-column">
                    <!-- Change this to "EXHIBITS" -->
                    <!-- Joe Maxx, Las Vegas, NV -->
                    <!-- The Merc, Temecula, CA -->
                    <!-- Lake Tahoe, Virtual -->

                    <h3>EXPLORE</h3>
                    <ul>
                        <li><a href="/exhibits">Exhibits</a></li>
                        <li><a href="/styles">Editions & Framing</a></li>
                        <li><a href="/moments">Moments, News & Events</a></li>
                        <li><a target="_shop" href="/thestudio">The Studio</a></li>
                        <li><a target="_blog" href="https://medium.com/jmgalleriesusa">Polarized Quarterly</a></li>
                        <!-- <li>Joe Maxx Coffee, Las Vegas, NV</li> -->
                        <!-- <li>The Merc, Temecula, CA</li> -->
                        <!-- <li>Lake Tahoe, NV</li> -->
                        <!-- <li class="top-border"><a href="/exhibits">Previous Exhibits</a></li> -->
                    </ul>
                </div>

                <div class="col footer-column">
                        <h3>SHOP</h3>
                            <ul>
                                <li><a target="_shop" href="/shop">tinyViews™</a></li>
                                <!-- <li><a target="_shop" href="/thestudio">The Studio</a></li> -->
                                <li><a href="/styles">Fine-Art Pricing</a></li>
                                <li><a href="/contact">Customer Service</a></li>
                                <!-- <li><a target="_blog" href="https://medium.com/jmgalleriesusa">Polarized Quarterly</a></li> -->
                                <!-- <li><a href="/newsletter">Monthly Amazing Offer</a></li> -->
                            </ul>
                </div>

                <div class="col footer-column">
                    <h3>ABOUT</h3>
                        <ul>
                            <li><a href="/about">the Photographer</a></li>
                            <!-- <li><a href="/moments">Moments, News & Events</a></li> -->
                            <!-- <li><a href="/styles">Editions & Framing</a></li> -->
                            <!-- <li><a target="_shop" href="/thestudio">The Studio</a></li> -->
                            <li><a href="/legal">Privacy Policy</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                        </ul>
                </div>

                <div class="col social">
                    <div>
                        <?php 
                            $this->getPartial('newsletter'); 
                        ?>
                    </div>
                </div>

            </div>

                <div class="grid">
                    <div class="col mt-16 mb-32">
                        <p class="small"> <?= $this->config->copyright ?> | <a href="/legal">Terms of Use</a></p>
                    </div>
                </div>

        </div>
    </section>
