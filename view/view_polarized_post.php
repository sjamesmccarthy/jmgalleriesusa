<div class="responses__container">
    <h3>Responses (1)</h3>
    <p class="--close"><i class="fas fa-times"></i></p>

    <div class="--response-content-container">
        <div class="--response-content-card border--bottom">
            <form>
                <textarea  name="response_content" placeholder="What are your thoughts?" disabled="disabled"></textarea>
                <input type="text" name="response_email" placeholder="Type email to verify your response" disabled="disabled" />
                <div style="text-align: right;" class="">
                    <p style="display: inline-block; text-align: right; margin-right: 1rem; margin-top: .4rem; font-size: .9rem;"><a class="noshow" href="" >cancel</a></p><button class="noshow">Respond</button>
                    <p class="center">FEATURE PREVIEW - COMING SOON</p>
                </div>
            </form>
        </div>
    </div>

    <!-- responses pulled from database -->
    <div class="--response-data-card border--bottom">
        <p class="--avatar">A</p>
        <p class="--avatar-byline"> ansel.adams@<br />August 13, 2020</p>
        <div class="--content">
            <p>Millions of men have lived to fight, build palaces and boundaries, shape destinies and societies; but the compelling force of all times has been the force of originality and creation profoundly affecting the roots of human spirit.</p>

            <p>In my mind's eye, I visualize how a particular... sight and feeling will appear on a print. If it excites me, there is a good chance it will make a good photograph. It is an intuitive sense, an ability that comes from a lot of practice.</p>
        </div>
    </div>

    <div class="--response-data-card">
        <p style="text-align: center; padding-top: 20vh;">
            No responses yet, be the first to leave one.
        </p>

        <!-- <p class="--avatar">J</p>
        <p class="--avatar-byline"> James McCarthy<br />August 13, 2020</p>
        <div class="--content">
            <p>Donec sed odio dui. Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

            <p>Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Vestibulum id ligula porta felis euismod semper. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div> -->
    </div>


</div>

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
                <div class="byline--social" mt-16">
                    <p class="--follow">FOLLOW ON</p>
                    <p class="mr-16"><a target="_social" href="https://twitter.com/jmgalleriesusa"><i class="fab fa-twitter"></i></a></p>
                    <p><a target="_social" href="https://www.linkedin.com/in/jmccarthyusa/"><i class="fab fa-linkedin"></i></a></p>
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

            <div class="mt-32 --social-links">
                <div style="display: inline-block">
                    <a class="response--icon" href=""><i class="fas fa-comment-alt"></i></a>
                    <p style="display:inline-block; vertical-align: top; margin-left: .5rem; margin-top: 4px;">No responses yet, be the first to leave one.</p>
                </div>

                <div style="display: inline-block; float: right;">
                        <a target="_social" href="<?= $social_twitter ?>"><i class="fab fa-twitter"></i></a>
                </div>

            </div>

            <div>
                <p class="__container--bottom_toc"><a href="/polarized">&#8672;</a></p>
            </div>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){

    $('.response--icon').on("click", function(e) {
        console.log('responses--icon.click');
        $('.responses__container').toggle();
        e.preventDefault();
    });

    /* Closing responses area */
    $('.--close').on("click", function(e) {
        console.log('close--icon.click');
        $('.responses__container').toggle();
        e.preventDefault();
    });

    $(document).mouseup(function(e) {
    var container = $('.responses__container');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.hide();
    }

});


});
</script>