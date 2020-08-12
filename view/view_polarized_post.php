<section id="polarized" class="pt-24">
    <div class="grid-noGutter-center">

        <div class="col-8 __container">

            <p class="__container--toc"><a href="/polarized">&#8672;</a></p>
            <!-- <h1>Journal</h1>
            <p class="pb-32 blue" style="margin-top: -10px">a Collection of field-notes by Photographer j.McCarthy</p> -->

            <h3><?= $res_title?></h3>
            
            <div>
                <p style="font-family: 'roboto', sans-serif; font-size: 1.3rem;color: rgba(117,117,117);padding-top: .5rem;"><?= $res_teaser?></p>
            </div>

             <div class="mt-32 mb-16" style="display: flex; position: relative;">
                <div class="avatar">
                    <img src="/view/image/avatar/jamesmccarthy_1.jpg" />
                </div>
                <div class="byline" style="flex:5;">
                    <b><?= $res_first_name ?> <?= $res_last_name ?></b><br />
                    <?= $res_created  ?> &hybull; <?= $res_count ?>  Words, <?= $read_time ?>
                </div>
                <div class="mt-16">
                    <p style="display: inline-block; font-size: 1.5rem;" class="mr-16"><a target="_social" href="https://twitter.com/jmgalleriesusa"><i class="fab fa-twitter"></i></a></p>
                    <p style="display: inline-block; font-size: 1.5rem;" ><a target="_social" href="https://www.linkedin.com/in/jmccarthyusa/"><i class="fab fa-linkedin"></i></a></p>
                </div>
            </div>

                <div class="content__area">
                    
                    <div id="teaser" class="mt-32 mb-32">
                        <?= $res_content_leadin ?>
                    </div><!- cl_teaser -->

                    <?= $img_html ?>

                    <div class="mt-32">
                        <?= $res_content ?>
                    </div>

                </div>

            <div class="mt-32">
                <p class="small blue right" style="font-weight: 700; margin-bottom: .5rem;">Share on Twitter and LinkedIn</p>
                 <p style="border-top: 1px solid #e4e4e4; padding-top: 1rem; border-radius: 0; font-size: 1.2rem; text-align: right;"><a style="margin-left: 20px; margin-right: 20px;" target="_social" href="<?= $social_twitter ?>"><i class="fab fa-twitter"></i></a> <a target="_social" href="<?= $social_linkedin ?>"><i class="fab fa-linkedin"></i></a></p>
            </div>

            <div>
                <p class="__container--bottom_toc"><a href="/polarized">&#8672;</a></p>
            </div>

        </div>

    </div>
</section>
