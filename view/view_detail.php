<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="detail">
    <article>
       <?= $super_photo ?>
    </article>
</section>

<section>
    <article class="">
    <form id="limited_ed_form" action="/contact" method="post">
    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
    <?= $catalog_no_hidden ?>

    <div class="grid">

        <div class="col-10">
            <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>
            <p class="pb-32 edition-title"><?= $edition_desc ?> <?= $edition_max ?> <?= $edition_desc_material_slash ?></span></p>
        </div>

        <div class="col-2">
            <p class="tiny blue right" style="margin-bottom: -10px; margin-left: 5px;">$ USD</p>
            <p class="right"><span id="price" class="price right"><?= number_format($default_price, 2) ?></span><br /><span class="frame_data price"></span></p>
            <input type="hidden" name="total_cost" id="total_cost" value="<?= $default_price ?>" />
        </div>
        
        <div class="col-12 mt-16">
            <p class="detail-story"><?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?> &mdash;
            <?= $photo_meta['story'] ?></p>
        </div>

    </div>
            
    <div class="grid mt-32">
       <?= $sizes_frames ?>
    </div>

    <div class="mt-16 ml-16 mb-64">
        <?= $btn_link ?><button><?= $btn ?></button></a>
        <?= $gallery_details ?>
    </div>

        <div id="alt-imgs" class="grid">
        <?= $in_roomImg ?>
        <?= $in_roomImgAlt ?>
        <?= $tinyviewImage ?>
        <?= $tinyviewNotesImage ?>
        </div>

    <?= $tinyViewFinePrint ?>

    </form>
    </article>
</section>

<!-- generated html from component file: component_most_popular -->
<section id="you-may-like" class="filmstrip mt-0">
    <?= $you_may_also_like_html ?>
</section> 
<!-- /generated html from component file -->

<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

    $('#buysize').on("change", function(e) {

        var nf = new Intl.NumberFormat();
        var p = $("#buysize option:selected").attr("data-price");
        $('#price').html(nf.format(p));

        // Check Frame Options
        var ps = $("#buysize option:selected").val();

        // Remove frame options from 5x7 and NOTECARDS
        if(ps == '5x7' || ps == 'NOTECARDS') { 
            // $('#frame').find('option').not(':first').css("display", "none"); 
            $('#frame').find('option').not(':first').attr("disabled", "disabled"); 
            console.log('5x7');
       } else {
            // $('#frame').find('option').not(':first').css("display", "block");
            $('#frame').find('option').not(':first').removeAttr("disabled");
        }

        $("#frame").prop('selectedIndex', 0); 
        $('.frame_data').html(''); 
        $('#total_cost').val(p);

    });

    $('#frame').on("change", function(e) {
        var fr = $("#frame option:selected").val();

    /* add HTML span id:frame_data and if selected populate DOM element */
    /* add update var url below with new pattern [ &frame=ASH-GRAY(+$40) ] $40 needs to reflect cost from $config obj */

        if($("#frame option:selected").val() == "Studio-Ash-Gray" || $("#frame option:selected").val() == "Studio-Snow-White") {
            
            var print = parseFloat($("#buysize option:selected").attr("data-price"));
            var fp = parseFloat($("#buysize option:selected").attr("data-frameprice")); 
            // console.log(fp);
            var newprice = print + fp;
            $('.frame_data').html( '(+' + fp + ' ' + $("#frame option:selected").val() + ' Frame)');
            $('#total_cost').val(newprice);
            console.log('frame.changed(' + $('#frame_data_cost').val() + ')');

        } else {
            console.log('frame.changed(print)');
            var newprice = parseFloat($("#buysize option:selected").attr("data-price"));
             $('.frame_data').html('');
        }

        var nf = new Intl.NumberFormat();
        var p = newprice;
        $('#price').html(nf.format(p));
        $('#total_cost').val(p);

    });

      $('#limited_ed_form').submit(function() {

        // console.log('start.form.limited_ed_form.submission');

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

            //$("#buysize option:selected").attr("data-price")

              var url = "/contact?photo=<?= $photo_meta['file_name'] ?>&size=" + $('#buysize').val() + "&frame=" + $('#frame').val() + "&cost=" + $('#total_cost').val() + "&edition=<?= $edition ?>" + "&catalog_no=<?= $catalog_no ?>";

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