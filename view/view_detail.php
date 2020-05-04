<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>
<section id="detail">

<!-- <section class="mt-72"> -->
    <article style="margin-top: -30px">
       <?= $super_photo ?>
    </article>
<!-- </section> -->
</section>

<!-- <section> -->
    <article class="">
    <form id="limited_ed_form" action="/contact" method="post">
    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
    <?= $catalog_no_hidden ?>

    <div class="grid">

        <div class="col-12">
            <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>
            <p class="pb-32 edition-title"><?= $edition_desc ?></span></p>
            <p class="tiny blue" style="margin-bottom: -10px; margin-left: 5px;">$ USD</p>
            <p id="price" class="price" style="margin-right: 20px; "><?= $default_price ?> </p>
        </div>
        
        <div class="col-12 mt-16">
            <p class="detail-story"><?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?> &mdash;
            <?= $photo_meta['story'] ?></p>
        </div>

    </div>
            
    <div class="grid mt-32">

       <?= $sizes_frames ?>

    </div>
    <div class="mt-16 ml-16">
        <?= $btn_link ?><button><?= $btn ?></button></a>
        <?= $gallery_details ?>
    </div>

    <div id="alt-imgs" class="grid mt-32">
            <?= $in_roomImg ?>
            <?= $in_roomImgAlt ?>
            <?= $tinyviewImage ?>
            <?= $tinyviewNotesImage ?>
    </div>
            <?= $tinyViewFinePrint ?>

</form>
</article>

<!-- generated html from component file: component_most_popular -->
<section id="you-may-like" class="filmstrip mt-16">
    <?= $you_may_also_like_html ?>
</section> 
<!-- /generated html from component file -->

<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

    $('#buysize').on("change", function(e) {

        $('#price').html($("#buysize option:selected").attr("data-price"));

    });

      $('#limited_ed_form').submit(function() {

        console.log('start.form.limited_ed_form.submission');

        grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              console.log('grecaptcha.ready');
              // console.log( document.getElementById('g-recaptcha-response') );
        });

            event.preventDefault();
            
            // Validating
            // var name = $("#contactname").val();
            // var email = $("#contactemail").val();
            // var subject = $("#contactsubject").val();
            // var message = $("#message").val();

            // if (name == '' || email == '' || subject == '') {
            //   alert("Please Fill Required Fields To Send Message.");
            //   return false;
            // } else {
            //   console.log('validation PASS');
            // }

              var url = "/contact?photo=<?= $photo_meta['file_name'] ?>&size=" + $('#buysize').val() + "&frame=" + $('#frame').val() + "&cost=" + $("#buysize option:selected").attr("data-price") + '&edition=<?= $edition ?>' + '&catalog_no=<?= $catalog_no ?>' ;

              grecaptcha.ready(function() {

                  grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
                    
                    window.location.href = url;

                    // $.ajax({
                    //   type: "POST",
                    //   url: url,
                    //   data: $("#contactForm").serialize(),
                    //   async: true,
                    //   success: function(data)
                    //   {
                          
                    //       var data_html = "Thank You For Your Message, an art consultant will be in touch in 48 hours<!-- (code: " + data + ")-->";
                    //       $('.form-main').prop('disabled', true).css('opacity','.3');
                    //       $('#sendform').hide();
                    //       $('#form_response').html(data_html).addClass('success').show();
                    //       console.log(data);
                    //   },
                    //   error : function(request,error) {
                    //       console.log("Request: "+JSON.stringify(request));
                    //   }
                    // });
                    
                    return false;
                  });;
              });
        });

  });

</script>