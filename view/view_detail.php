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

        <div class="col-9">
            <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>
            <p class="edition-title"><?= $edition_desc ?> <?= $edition_max ?> <?= $edition_desc_material_slash ?></span></p>
        </div>
        
        <div class="col-12 mt-16">
            <p class="detail-story"><?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?> &mdash;
            <?= $photo_meta['story'] ?></p>
        </div>

    </div>
            
    <div class="grid mt-16">

    <div class="col-2_sm-12">
            <!-- <p class="small blue" style="margin-bottom: -10px; margin-left: 5px;">$ USD</p> -->
            <p class="blue price">$<span id="price" class="price"><?= number_format($default_price, 2) ?></span></p><p class="frame_data price"></p>
            <input type="hidden" name="total_cost" id="total_cost" value="<?= $default_price ?>" />
        </div>

       <?= $sizes_frames ?>

       <div class="col-2_sm-12">
        <?= $btn_link ?><button><?= $btn ?></button></a>
       </div>

    </div>

    <div class="">
        <!-- <?= $btn_link ?><button><?= $btn ?></button></a> -->
        <?= $gallery_details ?>
    </div>

        <article class="nopad">
            <div id="alt-imgs" class="grid">
            <?= $in_roomImg ?>
            <?= $in_roomImgAlt ?>
            <?= $tinyviewImage ?>
            <?= $tinyviewNotesImage ?>
            </div>
        </article>

    <?= $tinyViewFinePrint ?>

    </form>
    </article>
</section>

<!-- generated html from component file: component_most_popular -->
<!-- removed 9/25/2020 -->
<section id="you-may-like" class="filmstrip mt-0">
    <?php //$you_may_also_like_html ?>
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
           console.log('ELSE-not 5x7');
           console.log($("#frame option:selected").val());
            // $('#frame').find('option').not(':first').css("display", "block");
            if($("#frame option:selected").val() == "FRAMELESS" || $("#frame option:selected").val() == "ACRYLIC" ) { 
                    $('#frame').find('option').not(':first').attr("disabled");
                } else {
                    $('#frame').find('option').not(':first').removeAttr("disabled");
                }
        }

        $("#frame").prop('selectedIndex', 0); 
        $('.frame_data').html(''); 
        $('#total_cost').val(p);

    });

    $('#frame').on("change", function(e) {
        var fr = $("#frame option:selected").val();

        // IF LIMITED EDITION 
        if($("#frame option:selected").val() == "Black Vodka" 
            || $("#frame option:selected").val() == "Whiskey" 
            || $("#frame option:selected").val() == "Bourbon" ){

                console.log('Premium Designer Frame');
                $('.frame_data').html( '(+' + $("#frame option:selected").val() + ' Frame, Included)');
                return false;
        }

        // ELSE IF OPEN EDITION
        else if($("#frame option:selected").val() == "Studio-Ash-Gray" || $("#frame option:selected").val() == "Studio-Snow-White") {
            
            var print = parseFloat($("#buysize option:selected").attr("data-price"));
            var fp = parseFloat($("#buysize option:selected").attr("data-frameprice")); 
            // console.log(fp);

            var newprice = print + fp;
            // console.log('newprice='+newprice);

            newprice_f = parseFloat(newprice).toFixed(2);
            // console.log('newprice_f=' + newprice_f);

            // var nf = new Intl.NumberFormat();
            // newprice = (nf.format(newprice_f));
            // $('#price').html('np ' + newprice_f);

            $('.frame_data').html( '(+' + fp + ' for Frame)');
            // $('.frame_data').html( '(+' + fp + ' ' + $("#frame option:selected").val() + ' Frame)');
            // $('#total_cost').val(newprice_f);
            // console.log('frame.changed(' + $('#total_cost').val() + ')');

        // ELSE PRINT-ONLY NO FRAME SELECTED
        } else {
            console.log('frame.changed(print-only)');
            console.log( parseFloat($("#buysize option:selected").attr("data-price")) );

            var newprice = parseFloat($("#buysize option:selected").attr("data-price"));
            newprice_f = parseFloat(newprice).toFixed(2);
             $('.frame_data').html('');
        }

        // var nf = new Intl.NumberFormat();
        // var p = newprice_f;
        // console.log('p=' + p);
        $('#price').html(newprice_f);
        $('#total_cost').val(newprice_f);

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