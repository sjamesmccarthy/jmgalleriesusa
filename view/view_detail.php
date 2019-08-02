    <section style="padding-top: 24px">
        <div class="grid-<?= $grid ?>_sm-1">
        <div class="<?= $col_left ?>" style="text-align: right">
            <img style="width: <?= $img_w ?>" src="/catalog/__image/<?= $photo_meta['file_name'] ?>.jpg" />
        </div>
        <div class="<?= $col_right ?>-middle" style="padding-left: 64px;">

            <h1 style="padding: 0; margin-left: -5px; line-height: 1.3;"><?= $photo_meta['title'] ?></h1>
            <h6 class="blue padbot-32"><?= $photo_meta['loc_place'] ?>, <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?></h6>

            <p class="padbot-8">Limited Edition</p>
            <p class="padbot-32">Available Sizes:<br /><?= htmlentities($photo_meta['available_sizes']) ?></p>

            <h6 class="padbot-8">And So The Story Goes ...</h6>
            <p style="line-height: 2;"><?= $photo_meta['story'] ?></p>

            <button style="margin-top: 32px;">REQUEST QUOTE</button>
        </div>

    </div>
    </section>

    <section class="padtop-32">
    <div class="grid-4_sm-2 grid-4_md-3" style="border-top: 1px solid #CCC; padding-top: 20px;">
         <div class="col-12" style="padding: 0 0 32px 0;">
            <h2>YOU MAY ALSO LIKE THESE POPULAR PHOTOS</h2>
            <p>Browse some of these photographs that other users have also liked.</p>
        </div>

        <?= $thumb_html ?>

        <!-- <div class="col"><img src="/view/image/demo-thumb.jpg" /></div>
        <div class="col"><img src="/view/image/demo-thumb.jpg" /></div>
        <div class="col sm-hidden"><img src="/view/image/demo-thumb.jpg" /></div>
        <div class="col sm-hidden md-hidden"><img src="/view/image/demo-thumb.jpg" /></div> -->

    </div>
</section>