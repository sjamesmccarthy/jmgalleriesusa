    <!-- partial_home_hero.php -->
    <section>
    <div class="grid-1 mtop">
        <div 
            style="
                background-color: #CCC; 
                height: 570px;
                background-image: linear-gradient(0deg, rgba(1,1,1,1) 0%, rgba(117,117,119,0) 60%), url('/view/image/demo-full.jpg');
                background-attachment: scroll;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 4px;" 
            class="col">
            <div class="hero_text_container">
                <p class="hero_text">LAKE TAHOE</p>
                <p class="hero_text_link">Explore This Collection &rarrtl;</p>
            </div>
        </div>
    </div>
    </section>

    <section id="polarized">
        <!-- partial_polarized.php -->
        <article>
            <div class="grid-4_sm-2_md-3 filmstrip">
                <div class="col-12">
                    <h2 >POLARIZED</h2>
                    <p>a Photographic Conversation & Quarterly Published <a target="_blog" href="https://medium.com/jmgalleriesusa"> @Medium</a></p>
                </div>
                
                <?= $polarized_html ?>

            </div>
        </article>
        <!-- /partial_polarized.php -->
    </section>

    <!-- generated html from component file -->
    <section id="filmstrips">
        <?= $thumb_html ?>
    </section>
    <!-- /generated html from component file -->