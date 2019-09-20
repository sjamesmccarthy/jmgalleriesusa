<section id="detail">
        <div class="grid-<?= $grid ?>">
        <div class="<?= $col_left ?>-middle top-photo">
            <img style="width: <?= $img_w ?>;" src="/catalog/__image/<?= $photo_meta['file_name'] ?>.jpg" />
        </div>
        <div class="<?= $col_right ?>-middle pl-64">

            <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>

            <p class="pb-32 edition-title"><b>Limited Edition, Signed Art</b></p>

             <div class="edition-extra">
                <a href="/exhibits"><img src="/view/image/icon_sizes.svg" class="no-border" /></a>
            </div>
            <div class="edition-extra-subline">
                <a href="/contact"><b>Available Acrylic Sizes</b></a><br />
                <span><?= $available_sizes ?><?= $as_tinyview ?></span>
            </div>

            <div class="flexfix">&nbsp;</div>

            <div class="edition-extra">
                <a href="/contact"><img src="/view/image/icon_email.svg" class="no-border" /></a>
            </div>
            <div class="edition-extra-subline">
                <a href="/contact"><b>Email An Art Consultant</b></a><br />
                <span>Messages will be returned in 24 horus.</span>
            </div>

            <?= $on_display ?>
            <?= $in_shop ?>
            
            <p class="detail-desc"><?= $desc ?></p>
            <div>
            <a href="/contact?photo=<?= $photo_meta['file_name'] ?>"><button class="mt-32">BUY FINE-ART EDITION</button></a>
            </div>

        </div>

    </div>
<!-- </section> -->

<!-- <section> -->
    <article class="mt-72">
    <div class="grid-center">
        <div class="col-6-middle pb-8 center" style="display: none">
             <h2 class="detail-h1 blue"><?= $photo_meta['title'] ?></h2>
             <h6 class="blue"><?= $photo_meta['loc_place'] ?> | <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?></h6>
        </div>

        <div class="col-10 pb-8">
            <p class="blue large pb-16"><b>And, so the story goes</b><br />
            at <?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?></p>
            <p class="detail-story"><?= $photo_meta['story'] ?></p>
        </div>
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