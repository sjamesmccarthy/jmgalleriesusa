<section id="detail pb-24 pt-24">
        <div class="grid-<?= $grid ?>_sm-1">
        <div class="<?= $col_left ?>-middle" style="text-align: right;">
            <img style="width: <?= $img_w ?>" src="/catalog/__image/<?= $photo_meta['file_name'] ?>.jpg" />
        </div>
        <div class="<?= $col_right ?>-middle" style="padding-left: 64px;">

            <h1 style="padding: 0; margin-left: -5px; line-height: 1.3;"><?= $photo_meta['title'] ?></h1>

            <p style="color: #4D4D4D; text-transform: uppercase"><b>Limited Edition</b></p>
            <p class="pb-32" style="font-size: .8em; color: #4D4D4D;">Because of limited availability this work can not be purchased online. If you're a collector please click the <a href="/contact">Request A Quote</a> button below.</p>

            <div style="display: inline-block;">
                <a style="color: #4D4D4D;" href="/contact"><img src="/view/image/icon_email.svg" style="width: 16px; opacity: .6; margin-right: 10px;" /></a>
            </div>
            <div style="display: inline-block; vertical-align: top; color: #4D4D4D; font-size: 1em; position: relative; margin-top: -2px;">
                <a style="color: #4D4D4D; font-weight: 300" href="/contact"><b>Email Us</b></a><br />
                <span style="font-size: .8em; font-weight: 300">Messages will be returned in about 24 hours.</span>
            </div>

            <div style="display:block">&nbsp;</div>

            <div style="display: inline-block;">
                <a style="color: #4D4D4D;" href="/exhibits"><img src="/view/image/icon_geo.svg" style="width: 16px; opacity: .6; margin-right: 10px;" /></a>
            </div>
            <div style="display: inline-block; vertical-align: top; color: #4D4D4D; font-size: 1em; position: relative; margin-top: -2px;">
                <a style="color: #4D4D4D; font-weight: 300" href="/contact"><b>See It First</b></a><br />
                <span style="font-size: .8em; font-weight: 300">This artwork is currently exhibiting in Las Vegas, Nevada.</span>
            </div>

            <h6 class="blue padbot-8 padtop-32"><?= $photo_meta['loc_place'] ?> | <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?></h6>
            <p style="line-height: 1.4; color: #4D4D4D;"><?= $photo_meta['story'] ?></p>

            <button style="margin-top: 32px;">REQUEST A QUOTE</button>
        </div>

    </div>
</section>

<!-- <section class="pb-24 mt-42">
    <div class="grid-6_sm-2 grid-6_md-3">
         
        <div class="col-12">
            <h6 class="pb-16">YOU MAY ALSO LIKE THESE POPULAR PHOTOS</h6>
        </div>

        <?= $thumb_html ?>

    </div>
</section> -->