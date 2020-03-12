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
                <div class="col footer-column mb-32">
                    <h4>GALLERIES</h4>
                    <ul>
                        <li><a href="/new-releases">New Releases</a></li>
                        <li><a href="/oceans-lakes-waterfalls">Oceans, Lakes & Waterfalls</a></li>
                        <li><a href="/mountains-deserts-trees">Mountains, Deserts & Trees</a></li>
                        <li><a href="/abstract-architecture-people">Abstract & Architecture</a></li>
                        <li><a href="/flowers-fields-clouds">Flowers, Fields & Clouds</a></li>
                        <li class="top-border"><a href="/all">View All</a></li>
                    </ul>
                </div>

                <div class="col footer-column">
                    <h4>EXPLORE</h4>
                    <ul>
                        <!-- <li><a href="/galleries">Galleries</a></li> -->
                        <li><a href="/exhibits">Exhibited Art</a></li>
                        <li><a href="/styles">Editions & Framing</a></li>
                        <li><a href="/moments">Moments, News & Events</a></li>
                        <li><a target="_shop" href="/thestudio">The Studio</a   ></li>
                        <li><a target="_blog" href="https://medium.com/jmgalleriesusa">Polarized Quarterly</a></li>
                    </ul>
                </div>

                <div class="col footer-column">
                        <h4>SHOP</h4>
                            <ul>
                                <li><a target="_shop" href="/shop">tinyViews™</a></li>
                                <!-- <li><a target="_shop" href="/thestudio">The Studio</a></li> -->
                                <li><a href="/styles">Fine-Art Pricing</a></li>
                                <li><a href="/contact">Customer Service</a></li>
                                <!-- <li><a href="/newsletter">Monthly Amazing Offer</a></li> -->
                            </ul>
                </div>

                <div class="col footer-column">
                    <h4>ABOUT</h4>
                        <ul>
                            <li><a href="/about">the Photographer</a></li>
                            <li><a href="/styles">Limited Editions</a></li>
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
