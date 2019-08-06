    <!-- partial_home_hero.php -->
    <section id="home-image">
    <div class="grid-1">
        <div 
            style="
                background-color: #CCC; 
                height: 570px;
                background-image: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(117,117,119,0) 60%), url('/view/image/demo-full.jpg');
                background-attachment: scroll;
                background-position: 100% 75%;
                background-repeat: no-repeat;
                background-size: cover;"
            class="col">
            <div class="hero_text_container">
                <p class="hero_text">OCEANS, LAKES & WATERFALLS</p>
                <p><a href="/oceans-lakes-waterfalls">Explore This Collection &rarrtl;</a></p>
            </div>
        </div>
    </div>
    </section>

    <?php if ($this->config->components['medium_blog'] == 'true') { ?>
    <section id="polarized" style="padding-bottom: 32px; border-bottom: 1px solid #CCC">
        <!-- partial_polarized.php -->
        <article>
            <div class="grid-4_sm-2_md-3">
                <div class="col-11" style="margin-bottom: 16px;">
                    <h2><a target="_new" href="https://medium.com/jmgalleriesusa">POLARIZED</a></h2>
                    <p>a Photographic Conversation & Quarterly 
                        <!-- &mdash; <a href="//medium.com/jmgalleriesusa">read more</a> -->
                        <!--  <a target="_blog" href="https://polarizedquarterly.com">Subscribe</a> or read some of free it on Medium</p> -->
                </div>
                <!-- <div class="col-1-bottom" style="margin-bottom: 16px; text-align: right;"> -->
                    <!-- <a href="//medium.com/jmgalleriesusa">read more</a> -->
                <!-- </div> -->
                
                <?= $polarized_html ?>

            </div>
        </article>
        <!-- /partial_polarized.php -->
    </section>
    <?php } ?>
    
    <!-- generated html from component file: New Releases -->
    <section id="new-release-film-strip" style="margin-top: 48px">
        <?= $thumb_new_releases_html ?>
    </section>
    <!-- /generated html from component file -->

    <!-- generated html from component file: All Other Catalogs  -->
    <section id="filmstrips">
        <?= $thumb_html ?>
    </section>
    <!-- /generated html from component file -->