<section id="detail">
        <div class="grid<?= $grid ?>">
        <div class="<?= $col_left ?>-middle_sm-12 top-photo pr-32">
            <img style="width: <?= $img_w ?>;" src="/catalog/__image/<?= $photo_meta['file_name'] ?>.jpg" />
        </div>
        <div class="<?= $col_right ?>-middle_sm-12">

            <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>

            <p class="pb-32 edition-title"><b>Limited Edition</b></p>

             <!-- <div class="edition-extra">
                <a href="/exhibits"><img src="/view/image/icon_editions.svg" class="no-border" /></a>
            </div> -->
            <div class="edition-extra-subline">
                <p>
                Available Editions<br />
                <span><?= $as_editions ?></span>
                </p>
            </div>

            <div class="flexfix">&nbsp;</div>

            <!-- <div class="edition-extra">
                <a href="/contact">
                    <img src="/view/image/icon_email_atsymbol.svg" class="no-border" />
                </a>
            </div> -->
            <div class="edition-extra-subline">
                <p>
                Email An Art Consultant
                <br />
                <span><a href="/contact">Contact us with your questions</a></span>
                </p>
            </div>

            <div class="flexfix">&nbsp;</div>
            <!-- <div class="edition-extra">
                <a href="/contact">
                    <img src="/view/image/icon_email_atsymbol.svg" class="no-border" />
                </a>
            </div> -->
            <div class="edition-extra-subline">
                <p>
                Pricing<br />
                <span><a href="/styles#pricing">View Pricing for our Editions</a></span>
                </p>
            </div>

            <?= $in_shop ?>
            
            <div>
                <a href="/contact?photo=<?= $photo_meta['file_name'] ?>"><button class="mt-32">Start Your Collection <i class="fas fa-arrow-right" style="margin-left: 20px;"></i> </button></a>
                <!-- <br /> 
                <a style="display: block; margin-top: 10px" href="/styles#pricing">View Pricing, Styles and Editions Information</a>-->
            </div>

        </div>

    </div>
<!-- </section> -->

<!-- <section> -->
    <article class="mt-72">
    <div class="grid">

        <div class="col-11 pb-8">
            <p class="blue large pb-16"><b>And, so the story goes</b><br />
            at <?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?></p>
            <p class="detail-story"><?= $photo_meta['story'] ?></p>
        </div>

        <?= $exif_data ?></p>

    </div>
    </article>
<!-- </section> -->

<!-- <section class="mt-72"> -->
    <article class="mt-72">
       <?= $super_photo ?>
    </article>
<!-- </section> -->
</section>

 <!-- generated html from component file: component_most_popular -->
<section id="you-may-like" class="filmstrip mt-72">
    <?= $you_may_also_like_html ?>
</section>
<!-- /generated html from component file -->