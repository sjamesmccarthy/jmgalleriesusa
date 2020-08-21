<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<div class="grid">
<div class="col-3_sm-12 responses__container">
    <h3>Responses (<span class="resp_count"><?= $resp_count ?></span>)</h3>
    <p class="--close"><i class="fas fa-times"></i></p>

    <div class="--response-content-container">
        <div class="--response-content-card">
        <form id="responseForm" action="/view/ajax_fieldnotes_responses_process.php" method="POST">
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
            <input type="hidden" id="fieldnotes_id" name="fieldnotes_id" value= "<?= $this->page->fieldnotes_id ?>" />
                <textarea id="response_content" name="response_content" placeholder="What are your thoughts?" required></textarea>
                <input type="text" id="response_email" name="response_email" placeholder="What is your email? we use this for your avatar." required/><br />
                <span class="tiny ml-16" style="color: #CCC">Avatars are imported from <a style="color: #AAA" target="_new" href="https://gravatar.com">Gravtar</a> if available.</span>
                <div class="--response-content-card-cta" style="padding-top: 1rem">
                    <button>Respond</button>
                    <p style="display: inline-block; float: right; margin-top: .4rem; font-size: .9rem;"><a class="--response-content-card-cancel" href="#">cancel</a></p>
                </div>
        </form>
        </div>
    </div>

    <!-- responses pulled from database -->
    <div class="responses">
        <?= $fieldsnotes_respsonses_html ?>
    </div>

</div>
</div>

<section id="polarized" class="pt-24">
    <div class="grid-noGutter-center">

        <div class="col-8_sm-12 __container">

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

                <div style="display: inline-block; margin-right: 2rem;">
                    <a class="response--icon-cheers" href="#"><i class="fas fa-glass-cheers"></i></a>
                    <p class="response--icon-label"><span class="repsonse--cheers-count"><?= $res_cheers ?></span> Cheers!</p>
                </div>

                <div style="display: inline-block">
                    <a class="response--icon response--icon-bubble" href=""><i class="fas fa-comment-alt"></i></a>
                    <p class="response--icon--count response--icon-label"><?= $res_responses ?></p>
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

    $('.--response-content-card-cancel').on("click", function(e) { 
        $('.--response-content-card-cta').hide();
        e.preventDefault();
    });

    $('#response_content, #response_email').on("click", function(e) { 
        $('.--response-content-card-cta').show();
    });

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

    $('.response--icon-cheers').on("click", function(e) {

            var count = $('.repsonse--cheers-count').html();
            if ( count >= 1 ) {
                ++count;
            } else {
                count = '1';
            }

        /* AJAX update to fieldnote record */
        var fn_ID = <?php echo $this->page->fieldnotes_id ?>;
        var url = "/view/ajax_cheers_process.php";
    
        $.ajax({
            type: "POST",
            url: url,
            data: { id: fn_ID },
            async: true,
            success: function(data)
            {
                $('.repsonse--cheers-count').html( count );
            },
            error : function(request,error) {
                console.log("ERROR: "+JSON.stringify(request));
            }
        });

        e.preventDefault();
    });

$('#responseForm').submit(function(e) {
console.log('responseForm.ajax.start()');

grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
      document.getElementById('g-recaptcha-response').value = token;
      console.log('LINE-169-grecaptcha.ready');
});

    event.preventDefault();
    console.log('Sending... ' + $('#g-recaptcha-response').val());

      var url = "/view/ajax_fieldnotes_responses_process.php";

      grecaptcha.ready(function() {

          grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'responses'}).then(function(token) {
            $.ajax({
              type: "POST",
              url: url,
              data: $("#responseForm").serialize(),
              async: true,
              success: function(data)
              {
                  
                // console.log(data);
                var resp_count = $('.resp_count').html();
                if ( resp_count >= 1 ) {
                    ++resp_count;
                } else {
                    resp_count = '1';
                }

                $( ".responses" ).prepend( data );
                $('.resp_count').html( resp_count );
                $('.response--icon--count').html( resp_count + ' Responses');
                $('.no_resp_yet').hide();
                $('.--response-content-container').hide();
              },
              error : function(request,error) {
                  console.log("Error: "+JSON.stringify(request));
              }
            });
            
            return false;
          });
      });

      e.preventDefault();
});

});
</script>