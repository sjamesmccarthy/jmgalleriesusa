    <div class="grid-2_sm-1">

        <div class="col">
            <img style="width: 100%" src="/catalog/__image/<?= $photo_meta['file_name'] ?>.jpg" />
        </div>
        <div class="col">
            <h1><?= $photo_meta['title'] ?></h1>
            <h4><?= $photo_meta['loc_place'] ?>, <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?></h4>
            <!-- <p>Limited Edition</p> -->
            <p>Available Sizes: <?= $photo_meta['available_sizes'] ?></p>

            <h4>And So The Story Goes ...</h4>
            <p><?= $photo_meta['desc'] ?></p>
            <?php $this->printp_r($photo_meta) ?>

            <button style="margin-top: 32px;">BUTTON</button>
        </div>

    </div>

    <div class="grid-4_sm-2 grid-4_md-3 filmstrip">
        <div class="col-12">
            <p>YOU MAY ALSO LIKE THESE POPULAR PHOTOS</p>
        </div>

        <?= $thumb_html ?>

        <!-- <div class="col"><img src="/view/image/demo-thumb.jpg" /></div>
        <div class="col"><img src="/view/image/demo-thumb.jpg" /></div>
        <div class="col sm-hidden"><img src="/view/image/demo-thumb.jpg" /></div>
        <div class="col sm-hidden md-hidden"><img src="/view/image/demo-thumb.jpg" /></div> -->

    </div>

<p><a href="<?= $this->page->catalog_path ?>">Back To <?= $photo_meta['category_title'] ?></a></p>
<p><a href="/">Back To Home</a></p>