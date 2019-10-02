<section id="footer" class="pt-32" style="border-top: .5px solid #CCC">
            
        <div class="footer-maxwidth">

            <div class="grid">
            <div class="col-10">
                <div class="col-10-middle pb-32 breadcrumb">
                 <a href="/"><img class="breadcrumb-logo" src="/view/image/logo_fullsize.png" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /> <?= $this->page->title ?>
               </div>
            </div>
            </div>

            <div class="grid">
                <div class="col-2 col_md-3 footer-column">
                    <h4>GALLERIES</h4>
                    <ul>
                        <li><a href="/new-releases">New Releases</a></li>
                        <li><a href="/oceans-lakes-waterfalls">Oceans, Lakes & Waterfalls</a></li>
                        <li><a href="/mountains-deserts-trees">Mountains, Deserts & Trees</a></li>
                        <li><a href="/abstract-architecture-people">Abstract, Architecture & People</a></li>
                        <li><a href="/flowers-fields-clouds">Flowers, Fields & Clouds</a></li>
                    </ul>
                </div>

                <div class="col-2 col_md-3 footer-column">
                    <h4>EXPLORE</h4>
                    <ul>
                        <!-- <li><a href="/galleries">Galleries</a></li> -->
                        <!-- <li><a href="/exhibits">Exhibitions</a></li> -->
                        <li><a href="/styles">Styles & Frames</a></li>
                        <li><a href="/moments">Moments, News & Events</a></li>
                        <li><a target="_shop" href="/thestudio">The Studio</a></li>
                        <li><a target="_blog" href="https://medium.com/jmgalleriesusa">Polarized Quarterly</a></li>
                    </ul>
                </div>

                <div class="col-2 col_md-3 footer-column">
                        <h4>SHOP</h4>
                            <ul>
                                <li><a target="_shop" href="/shop">tinyViews™</a></li>
                                <!-- <li><a target="_shop" href="/thestudio">The Studio</a></li> -->
                                <li><a href="/styles">Fine-Art Pricing</a></li>
                                <li><a href="/contact">Customer Service</a></li>
                                <li><a href="/newsletter">Monthly Amazing Offer</a></li>
                            </ul>
                </div>

                <div class="col-2 col_md-3 footer-column">
                    <h4>ABOUT</h4>
                        <ul>
                            <li><a href="/about">the Photographer</a></li>
                            <li><a href="/styles">Limited Editions</a></li>
                            <li><a href="/legal">Privacy Policy</a></li>
                            <li><a href="/legal">Terms of Use</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                        </ul>
                </div>

                <div class="col-3 sm-hidden md-hidden social">
                    <div style="text-align:right">
                    <h4>CONNECT</h4>
                        <ul>
                        <li><a target="_social" href="https://twitter.com/jmgalleriesusa"> <img src="/view/image/social_twitter.svg" /></a> <a target="_social" href="https://instagram.com/jmgalleriesusa"> <img src="/view/image/social_instagram.svg" /></a> <a target="_social" href="https://linkedin.com/company/jmgalleriesusa"> <img src="/view/image/social_linkedin.svg" /></a> <a target="_social" href="https://medium.com/jmgalleriesusa"> <img src="/view/image/social_medium.svg" /></a></li>
                        <li style="padding-top: 10px;">(951) 708-1831<br />fineart@jmgalleries.com</li>
                        </ul>
                    </div>
                </div>

                 <div class="col mt-32" style="text-align: right; position: absolute; bottom: 32px; right: 32px;">
                    <p class="small"> <?= $this->config->copyright ?> | <a href="/legal">Terms of Use</a></p>
                </div>

            </div>

                <div class="grid pt-32">
                    <div class="col">
                        <?php 
                            $this->getPartial('newsletter'); 
                        ?>
                    </div>
                </div>


        </div>
    </section>
