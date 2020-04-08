<section id="detail">

<!-- <section class="mt-72"> -->
    <article class="">
       <?= $super_photo ?>
    </article>
<!-- </section> -->
</section>

<!-- <section> -->
    <article class="mb-64">
    <div class="grid">

        <div class="col-12 pb-8 mt-32">
        <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>
        <!-- <p class="pb-32 edition-title blue">Limited <?= $as_editions ?> </span> -->
        <!-- <p class="pb-32 edition-title blue">$1,000.00 &mdash; 16x20 inch, framed to 23x26 inches. <?= $as_editions ?></span></p> -->
        <p class="pb-32 edition-title"><?= $edition_desc ?></span></p>

            <p class="detail-story">And, so the story goes ...
            at <?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?> &mdash;

            <?= $photo_meta['story'] ?></p>

        </div>

        <!-- <p><?= $exif_data ?></p> -->

    </div>

    <div class="grid-2 mt-16">
            <?= $in_roomImg ?>
            <?= $in_roomImgAlt ?>
            <!-- <?= $in_roomImgAlt2 ?> -->
            <?= $tinyviewImage ?>
    </div>

    <div>
    <?= $gallery_details ?>
    <?= $btn_link ?><button class="mt-32"><?= $btn ?></button></a>
    </div>

</article>

<!-- generated html from component file: component_most_popular -->
<section id="you-may-like" class="filmstrip mt-64">
    <?= $you_may_also_like_html ?>
</section> 
<!-- /generated html from component file -->