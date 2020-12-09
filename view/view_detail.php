<section id="detail">
    <!-- <article> -->
       <?= $super_photo ?>
    <!-- </article> -->
</section>

<section>
    <!-- <article class=""> -->
    <form id="limited_ed_form" action="/checkout" method="post">
    <input type="hidden" name="formType" value="SquarePaymentForm_fineArt" />
    <input type="hidden" name="product_id" value="<?= $product_id ?>" />
    <?= $hidden_edition_type ?>
    <input type="hidden" name="quantity" value="1" />
    <input type="hidden" name="title" value="<?= $photo_meta['title'] ?>" />
    <input type="hidden" name="img_type" value="<?= $edition_desc_material ?>" />

    <input type="hidden" name="price" id="price" value="<?= $default_price ?>" />
    <input type="hidden" name="frame_price" id="frame_price" value="<?= $frame_price_default ?>" />
    <input type="hidden" name="matted_size" id="matted_size" value="<?= $matted_size_default ?>" />

    <?= $catalog_no_hidden ?>

    <div class="grid mt-64">

        <div class="col-7_md-8_sm-12 border-right">
            <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>
            <p class="edition-title"><?= $edition_desc ?> <?= $edition_max ?> <?= $edition_desc_material_slash ?></span></p>
        <!-- </div>
        
        <div class="col-12 mt-16"> -->
            <p class="mt-32 detail-story"><?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?> &mdash;
            <?= $photo_meta['story'] ?></p>
            <?= $gallery_details ?>
        </div>

    <!-- <div class="grid mt-16"> -->
        <div class="col"> <!--col-2_sm-12-->
            <!-- <p class="small blue" style="margin-bottom: -10px; margin-left: 5px;">$ USD</p> -->
            <p class="blue price">$<span id="price_view" class="price"><?= number_format($default_price, 2) ?></span></p><p class="frame_data price"></p>
        <!-- </div> -->

       <?= $sizes_frames ?>

       
       <!-- <div class="col-2_sm-12"> -->
           <?= $btn_link ?><button><?= $btn ?></button></a>
           <p class="mt-16"><a target="_infoTab" class="small underline normal-weight" href="/styles">Click here for sizing information</a></p>
           <p class="mt-16 small ">Questions?<br /><a class="small underline normal-weight"target="_infoTab" href="/contact">Please contact us</a> to speak to an Art consultant.</p>
       </div>
    <!-- </div> -->

    </div>
            

    <div class="mt-32">
        <!-- <?= $btn_link ?><button><?= $btn ?></button></a> -->
        
    </div>
    </form>
    <!-- </article> -->
</section>

<!-- generated html from component file: component_most_popular -->
<!-- removed 9/25/2020 -->
<section id="you-may-like" class="filmstrip mt-64">
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
        var ms = $("#buysize option:selected").attr("data-mattedsize");

        // Remove frame options from 5x7 and NOTECARDS
        if(ps == '5x7' || ps == 'NOTECARDS') { 
            // $('#frame').find('option').not(':first').css("display", "none"); 
            $('#frame').find('option').not(':first').attr("disabled", "disabled"); 
            console.log('5x7');
       } else {
           console.log('ImageSize: ' + ps + '/MattedSize: ' + ms);
           $('#matted_size').val(ms);
            // $('#frame').find('option').not(':first').css("display", "block");
            if($("#frame option:selected").val() == "FRAMELESS" || $("#frame option:selected").val() == "ADDWITHACRYLIC" ) { 
                    $('#frame').find('option').not(':first').attr("disabled");
                } else {
                    $('#frame').find('option').not(':first').removeAttr("disabled");
                }
        }

        $("#frame").prop('selectedIndex', 0); 
        $('.frame_data').html(''); 
        $('#price').val(p);
        $('#price_view').html(nf.format(p));

    });

    $('#frame').on("change", function(e) {
        var fr = $("#frame option:selected").val();

        // IF LIMITED EDITION 
        if($("#frame option:selected").val() == "Black Vodka" || $("#frame option:selected").val() == "Whiskey" || $("#frame option:selected").val() == "Bourbon" ){

                console.log('Premium Designer Frame INCLUDED');
                $('.frame_data').html( '(+' + $("#frame option:selected").val() + ' Frame, Included)');
                return false;
        }

        else  if($("#frame option:selected").val() == "ADDWITHACRYLIC") {
                console.log('ADD TO ACRYLIC Premium Designer Frame');
                $('.frame_data').html( '(+ Premium Frame Cost)');
                $('#frame_price').val('$');
                return false;
        }

        // ELSE IF OPEN EDITION
        else if($("#frame option:selected").val() == "Studio-Ash-Gray" || $("#frame option:selected").val() == "Studio-Snow-White") {
            
            var print = parseFloat($("#buysize option:selected").attr("data-price"));
            var fp = parseFloat($("#buysize option:selected").attr("data-frameprice")); 
            console.log('FramePrice: ' + fp);

            var newprice = print + fp;
            console.log('newprice='+newprice);

            newprice_f = parseFloat(newprice).toFixed(2);
            console.log('newprice_f=' + newprice_f);

            // var nf = new Intl.NumberFormat();
            // newprice = (nf.format(newprice_f));
            // $('#price').html('np ' + newprice_f);

            $('.frame_data').html( '(+' + fp + ' for Frame)');
            // $('.frame_data').html( '(+' + fp + ' ' + $("#frame option:selected").val() + ' Frame)');
            // $('#price').val(newprice_f);

            $('#frame_price').val(fp);
            console.log('frame.changed(' + $('#price').val() + ')');

        // ELSE PRINT-ONLY NO FRAME SELECTED
        } else {
            console.log('frame.changed(print-only)');
            console.log( parseFloat($("#buysize option:selected").attr("data-price")) );

            var newprice = parseFloat($("#buysize option:selected").attr("data-price"));
            newprice_f = parseFloat(newprice).toFixed(2);
             $('.frame_data').html('');
             $('#frame_price').val('PRINT-ONLY-WITH-MATTE');
        }

        // var nf = new Intl.NumberFormat();
        // var p = newprice_f;
        console.log('updating price.View(.price)=' + newprice_f);
        $('#price_view').html(newprice_f);
        $('#price').val(newprice_f);

    });

      $('#limited_ed_form-o').submit(function() {

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

            //   var url = "/contact?photo=<?= $photo_meta['file_name'] ?>&size=" + $('#buysize').val() + "&frame=" + $('#frame').val() + "&cost=" + $('#price').val() + "&edition=<?= $edition ?>" + "&catalog_no=<?= $catalog_no ?>";
                var url = '/checkout';

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