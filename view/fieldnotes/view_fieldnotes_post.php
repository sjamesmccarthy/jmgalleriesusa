<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>
<!-- <link href="/view/css/jquery.desoslide.min.css?<?= time(); ?>" rel="stylesheet">
<script src="/view/js/jquery.desoslide.min.js"></script> -->

<div class="grid">
<div class="col-3_md-6_sm-12 responses__container">
    <h3>Responses (<span class="resp_count"><?= $resp_count ?></span>)</h3>
    <p class="--close"><i class="fas fa-times"></i></p>

    <div class="--response-content-container">
        <div class="--response-content-card">
        <form id="responseForm" action="/view/__ajax/ajax_fieldnotes_responses_process.php" method="POST">
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
            <input type="hidden" id="fieldnotes_id" name="fieldnotes_id" value= "<?= $this->page->fieldnotes_id ?>" />
                <textarea id="response_content" name="response_content" placeholder="What are your thoughts?" required></textarea>
                <input type="text" id="response_email" name="response_email" placeholder="What is your email? we use this for your avatar." required/><br />
                <span class="tiny ml-16" style="color: #CCC">Avatars are imported from <a style="color: #AAA" target="_new" href="https://gravatar.com">Gravtar</a> if available.</span>
                <div class="--response-content-card-cta" style="padding-top: 1rem">
                    <button>Respond</button>
                    <p style="float: right; margin-top: .4rem; font-size: .9rem;"><a class="--response-content-card-cancel" href="#">cancel</a></p>
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

    <div class="grid-noGutter">
        <div class="col-12 __container">

            <p><a href="/fieldnotes"><i class="fa-solid fa-arrow-left"></i><!--<span class="pl-8 small" style="position:absolute; margin-top: 2px;">back to notes</span>--></a></p>

            <p class="mb-16 smaller text-center"><a href="/fieldnotes">a Field Note</a><br />
            published on <?= $res_date_written ?> </p>

            <div class="col title-container pb-16">
                <h1><?= $res_title?></h1>
                <p class="teaser-title"><?= $res_teaser?></p>
            </div>

            <div class="col content__area">

                <?= $img_html ?>

                <div class="content__area--wrapper">
                    <div class="col teaser">
                        <?= $res_content_leadin ?>
                    </div>

                    <div class="col">
                        <?= $res_content ?>
                    </div>

                    <!-- start cheers, comments -->
                    <div class="col-12 __container--bottom_toc">

                        <div>
                            <a class="response--icon-cheers" href="#"><i class="fas fa-glass-cheers"></i>
                            <p class="response--icon-label""><span class="repsonse--cheers-count repsonse--count"><?= $res_cheers ?></span></a></p>

                            <a class="response--icon response--icon-bubble" href="#"><i class="fas fa-comment-alt"></i>
                            <p class="response--icon--count response--icon-label"><span class="repsonse--icon-count repsonse--count"><?= $res_responses ?></span></a></p>
                        </div>

                        <div>
                            <?= $tags_html ?>
                        </div>

                        <div>
                            <p class="__container--linkback">Published <?= $res_date_written; ?> in <a class="blue" href="/fieldnotes">Field Notes</a></p>
                        </div>

                        <!-- <div class="newsletter-section-fn"> -->
                            <!-- <h3>Sign Up For My First Friday Email</h3> -->
                            <?php
                                // $this->getPartial('newsletter');
                            ?>
                        <!-- </div> -->

                    </div>
                    <!-- /cheers, comments -->
                </div>
                <!-- /content__area--wrapper -->
            </div>
            <!-- /__content_area -->
        </div>
    </div>

</section>

<script>
jQuery(document).ready(function($){

$("div[id*='imgT']").on('click', function(e){
    var ele = "imgT_" + $(this).attr("data-file");
    console.log("clicked: " + ele );
    $("div[id*='imgT_'] >img").css("opacity",".2");

    if( $('.filmstrip--large-preview').is(':visible') ) {
        console.log(".filmstrip--preview visible");
        $("div[id*='imgT']").css("border","none");
        $('#content--teaser').hide();
        // $('#' + ele).css("border-bottom", "25px solid rgba(0,0,0,.6").css("padding-bottom","0").css("margin-bottom","0");
        $('#' + ele + ' >img').css("opacity","1");
    } else {
        console.log(".filmstrip--preview hidden");
        $("div[id*='imgT']").css("border","none");
        $('#content--teaser').hide();
        $(".filmstrip--large-preview").slideDown();
    }

    $('#content--teaser').hide();
    $("div[id*='img_']").hide();
    $(".filmstrip--large-preview").show();
    $("div #img_" + $(this).attr("data-file") + "_expanded").show();
});

    // $('#slideshow').desoSlide({
    //     thumbs: $('#slideshow_thumbs li a'),
    //     auto: {
    //         start: true
    //     },
    //     first: 3,
    //     thumbEvent: 'click'
    // });

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
        var url = "/view/__ajax/ajax_cheers_process.php";

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

      var url = "/view/__ajax/ajax_fieldnotes_responses_process.php";

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
                $('.response--icon--count').html( resp_count);
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
