<section id="polarized" class="pt-24">
    <div class="grid-noGutter-center">

        <div class="col-8 __container">

            <p class="__container--toc"><a href="/polarized">&#8672;</a></p>
            <h1>Polarized.</h1>
            <p class="pb-32 blue" style="margin-top: -10px">a Collection of fieldnotes by Photogrpaher j.McCarthy</p>

            <h3><?= $res_title?></h3>
             <div class="mt-32 mb-16" style="display: flex; position: relative;   border-bottom: 1px solid #e4e4e4;
  padding-bottom: 1rem;">
                    <div class="avatar">
                    <img src="/view/image/avatar/jamesmccarthy_1.jpg" />
                </div>
                <div class="byline" style="flex:5;">
                    Written By <?= $res_first_name ?> <?= $res_last_name ?><br />
                <?= $res_created  ?> &hybull; <?= $res_count ?>  Words, <?= $read_time ?>
                </div>
                <div class="mt-16">
                    <p style="display: inline-block" class="mr-16"><a target="_social" href="https://twitter.com/jmgalleriesusa"><i class="fab fa-twitter"></i></a></p>
                    <p style="display: inline-block" ><a target="_social" href="https://www.linkedin.com/in/jmccarthyusa/"><i class="fab fa-linkedin"></i></a></p>
                </div>
            </div>

                <div class="content__area">
                    
                    <div id="teaser" class="mt-32 mb-32">
                        <?= $res_content_leadin ?>
                    </div><!- cl_teaser -->

                    <!-- <div class="image">
                        <img src="/view/image/fieldnotes/<?= $res_image ?>" /><br />
                        <span class="caption"><?= $res_caption ?></span>
                    </div> -->
                    <?= $img_html ?>

                    <div class="mt-32"><?= $res_content ?></div>

                </div>

            <div class="mt-32">
                <p class="small blue right" style="font-weight: 700; margin-bottom: .5rem;">Comment and Share on Twitter and LinkedIn</p>
                 <p style="border-top: 1px solid #e4e4e4; padding-top: 1rem; border-radius: 0; font-size: 1.2rem; text-align: right;"><a style="margin-left: 20px; margin-right: 20px;" target="_social" href="<?= $social_twitter ?>"><i class="fab fa-twitter"></i></a> <a target="_social" href="<?= $social_linkedin ?>"><i class="fab fa-linkedin"></i></a></p>
            </div>

            <div>
                <p class="__container--bottom_toc"><a href="/polarized">&#8672;</a></p>
            </div>

        </div>
   

    </div>
</section>
