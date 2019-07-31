    <!-- partial_home_hero.php -->
    <section>
    <div class="grid-1 mtop">
        <div style="overflow: hidden; height: 500px;" class="col">
            <img style="position: absolute; top: -270px" src="/view/image/demo-full.jpg" />
            <p class="hero_text">NORTHERN NEVADA</p>
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