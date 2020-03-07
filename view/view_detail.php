<section id="detail">

<!-- <section class="mt-72"> -->
    <article class="">
       <?= $super_photo ?>
    </article>
<!-- </section> -->
</section>

<!-- <section> -->
    <article class="">
    <div class="grid">

        <div class="col-12 pb-8 mt-32">
        <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>
        <!-- <p class="pb-32 edition-title blue">Limited <?= $as_editions ?> </span> -->
        <!-- <p class="pb-32 edition-title blue">$1,000.00 &mdash; 16x20 inch, framed to 23x26 inches. <?= $as_editions ?></span></p> -->
        <p class="pb-32 edition-title blue"><?= $this->config->limited_edition_max ?> LIMITED EDITION / $1,000 USD / HANDMADE, SIGNED, AND AUTHENTICATED </span></p>

            <p class="detail-story">And, so the story goes ...
            at <?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?> &mdash;

            <?= $photo_meta['story'] ?></p>

            <p class="mt-16">Each 16x20 inch print comes ready-to-hang, framed in a handmade dark walnut frame with Tru Vue Museum Glass, or printed on archival canvas and stretched on a 5/8" frame. Total size of artwork is 18x22 inches. Other sizes and options are available by <a href="/contact/">contacting an art consultant</a> and looking at our <a href="/styles">Editions, Frames & Pricing</a> information.</p>
            <a href="/contact?photo=<?= $photo_meta['file_name'] ?>"><button class="mt-32">BUY THIS ARTWORK</button></a>

        </div>

        <!-- <p><?= $exif_data ?></p> -->

    </div>
    </article>
<!-- </section> -->

<article>
    <div class="grid mt-64">
            <?= $in_roomImg ?>
            <?= $in_roomImgAlt ?>
            <?= $tinyviewImage ?>
    </div>
</article>

 <!-- generated html from component file: component_most_popular -->
<section id="you-may-like" class="filmstrip mt-64">
    <?= $you_may_also_like_html ?>
</section>
<!-- /generated html from component file -->