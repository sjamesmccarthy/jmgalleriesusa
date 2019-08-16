<section id="detail">
        <div class="grid-<?= $grid ?>_sm-1">
        <div class="<?= $col_left ?>-middle" style="text-align: right;">
            <img style="width: <?= $img_w ?>;" src="/catalog/__image/<?= $photo_meta['file_name'] ?>.jpg" />
        </div>
        <div class="<?= $col_right ?>-middle" style="padding-left: 64px;">

            <h1 style="padding: 0; margin-left: -5px; line-height: 1.3;"><?= $photo_meta['title'] ?></h1>

            <p class="pb-32" style="color: rgba(0,0,0,.4); text-transform: uppercase"><b>Limited Edition, Signed Art</b></p>
            <!-- <p class="pb-32" style="font-size: .8em; color: #4D4D4D;"></p> -->

             <div style="display: inline-block;">
                <a style="color: #4D4D4D;" href="/exhibits"><img src="/view/image/icon_sizes.svg" style="width: 16px; opacity: .6; margin-right: 10px;" /></a>
            </div>
            <div style="display: inline-block; vertical-align: top; color: #4D4D4D; font-size: 1em; position: relative; margin-top: -2px;">
                <a style="color: #4D4D4D; font-weight: 300" href="/contact"><b>Available Sizes</b></a><br />
                <span style="font-size: .8em; font-weight: 300"><?= $available_sizes ?></span>
            </div>

            <div style="display:block">&nbsp;</div>

            <div style="display: inline-block;">
                <a style="color: #4D4D4D;" href="/contact"><img src="/view/image/icon_email.svg" style="width: 16px; opacity: .6; margin-right: 10px;" /></a>
            </div>
            <div style="display: inline-block; vertical-align: top; color: #4D4D4D; font-size: 1em; position: relative; margin-top: -2px;">
                <a style="color: #4D4D4D; font-weight: 300" href="/contact"><b>Email An Art Consultant</b></a><br />
                <span style="font-size: .8em; font-weight: 300">Messages will be returned in 24 horus.</span>
            </div>

            <?= $on_display ?>

            <!-- <div style="display: inline-block;">
                <a style="color: #4D4D4D;" href="/exhibits"><img src="/view/image/icon_geo.svg" style="width: 16px; opacity: .6; margin-right: 10px;" /></a>
            </div>
            <div style="display: inline-block; vertical-align: top; color: #4D4D4D; font-size: 1em; position: relative; margin-top: -2px;">
                <a style="color: #4D4D4D; font-weight: 300" href="/contact"><b>See It</b></a><br />
                <span style="font-size: .8em; font-weight: 300">This art is available to view in Las Vegas, Nevada</span>
            </div> -->

            <!-- <h6 class="blue padbot-8 padtop-32"><?= $photo_meta['loc_place'] ?> | <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?></h6> -->
            
            <p class="pt-32" style="line-height: 1.4; color: #4D4D4D;"><?= $desc ?></p>
            <div>
            <a href="/contact"><button style="margin-top: 32px;">REQUEST QUOTE</button></a>
            </div>

        </div>

    </div>
</section>

<section class="mt-96">
    <article>
    <div class="grid">
        <div class="col-6-middle pb-8 center">
             <h1 style="padding: 0; line-height: 1.3;"><?= $photo_meta['title'] ?></h1>
             <h6 class="blue"><?= $photo_meta['loc_place'] ?> | <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?></h6>
        </div>

        <div class="col-6 pb-8" >
            <p style="line-height: 1.6; color: #4D4D4D; font-size: 1.5rem;"><?= $photo_meta['story'] ?></p>
        </div>
    </div>
    </article>
</section>

<section class="mt-96">
    <article>
       <?= $super_photo ?>
    </article>
</section>

<section id="you-may-like" class="filmstrip mt-96">

    <article>
    <div class="grid-4_sm-2 grid-4_md-3">
    <div class="col-11" style="margin-bottom: 16px;">
        <h2><a href="/' . $value['path'] . '">YOU MAY ALSO LIKE</a></h2>
        <p>More popular photographs based on what others are viewing</p>
    </div>
    <div class="col-1-bottom" style="margin-bottom: 16px; text-align: right;">
    <a href="/galleries">view all galleries</a>
    </div>

    <?= $thumb_html ?>

</section>