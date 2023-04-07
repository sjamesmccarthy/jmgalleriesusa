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
    <input type="hidden" id="material_type" name="material_type" value="<?= $edition_material_type ?>" />
    <input type="hidden" name="price" id="price" value="<?= $default_price ?>" />
    <input type="hidden" name="print_price" id="print_price" value="<?= $default_price ?>" />
    <input type="hidden" name="frame_price" id="frame_price" value="<?= $frame_price_default ?>" />
    <input type="hidden" name="matted_size" id="matted_size" value="<?= $matted_size_default ?>" />

    <?= $catalog_no_hidden ?>

    <div class="grid-center mt-32">

        <div class="col-9_md-9_sm-12" style="position:relative;">
            <h1 class="detail-h1"><?= $photo_meta['title'] ?></h1>
            <p class="edition-title"><!--<?= $photo_meta['loc_place'] ?> &mdash; --><?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?><?= $date_taken ?></span></p>

<!--             <p class="mt-32 detail-story"><?= $photo_meta['loc_place'] ?> in  <?= $photo_meta['loc_city'] ?>, <?= $photo_meta['loc_state'] ?> &mdash;
            </p>

            <p>
              <?= $photo_meta['story'] ?>
            </p> -->

            <div class="grid-center">
             <div class="col">
              <p class="blue price ml-16 mt-8">$<span id="price_view" class="price"><?= number_format($default_price, 0) ?></span></p>
            <p class="small ml-16"><?= strtoupper($edition_desc) ?><!-- <?= $edition_max ?> -->  <?= $edition_desc_material_slash ?></span></p>
              <p class="frame_data blue text-center pb-16"></p>

            <?= $sizes_pricing ?>
            <?= $sizes_frames ?>
            <button class="mt-32"><?= $btn ?></button>

            <p class="mt-32 ml-8 small text-center">Questions?<br /><a class="small underline normal-weight"target="_infoTab" href="/contact">Contact an Art consultant</a></p>
            <!-- <p class="ml-8 text-center"><a target="_infoTab" class="small underline normal-weight" href="/styles">Click here for framing information</a></p> -->

            <?= $gallery_details ?>

            </div>
            </div>

            <div class="grid-center hidden">
                <div class="col">
                    <p class="text-center">As of January 1, 2023 my fine-art photography will only be available for purchase through private sales during exhibition. </p>
                </div>
            </div>


        </div>

    <!-- previous location of buy form -->

    </div>

    </form>
    <!-- </article> -->
</section>

<!-- generated html from component file: component_most_popular -->
<!-- removed 9/25/2020 -->
<section id="you-may-like" class="filmstrip mt-16">
    <?= $you_may_also_like_html ?>
</section>
<!-- /generated html from component file -->

<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

    <?php if($studio_print == "true") :?>
        $('#frame').find('option').attr("disabled", "disabled");
        $('.frame-block, .media-details').hide();
    <?php endif ?>

    $('#buysize').on("change", function(e) {

        var nf = new Intl.NumberFormat();
        var p = $("#buysize option:selected").attr("data-price");
        var mt = $("#buysize option:selected").attr("data-material");
        $('#price').html(nf.format(p));

        // Check Frame Options
        var ps = $("#buysize option:selected").val();
        var ms = $("#buysize option:selected").attr("data-mattedsize");

        // Remove frame options from NOTECARDS (previously also 5x7 ps == '5x7' ||)
        if(ps == '16x24 (includes ½ inch white border)') {
            // $('#frame').find('option').not(':first').css("display", "none");
            $('#frame').find('option').attr("disabled", "disabled");
            $('.frame-block').hide(); /* media-details */

            console.log('tinyVIEWS Studio PRINT ONLY');
       } else {
           // console.log('ImageSize: ' + ps + '/MattedSize: ' + ms);
           $('.frame-block, .media-details').removeClass('hidden').show();
           $('#frame').find('option').not(':first').removeAttr("disabled");

           $('#matted_size').val(ms);
            // $('#frame').find('option').not(':first').css("display", "block");
            if($("#frame option:selected").val() == "FRAMELESS" || $("#frame option:selected").val() == "ADDWITHACRYLIC" ) {
                    $('#frame').find('option').not(':first').attr("disabled");
                } else {
                    $('#frame').find('option').not(':first').removeAttr("disabled");
                }
        }

        $("#frame").prop('selectedIndex', 0);
        $('.frame_data').hide();
        $('.frame_data').html('');
        $('#price').val(p);
        $('#print_price').val(p);
        // $('#price_view').html(nf.format(p));
        $('#price_view').html(new Intl.NumberFormat('en-US').format(p));
        // console.log('updating price.View(.price)=' + nf.format(p));
        $('#material_type').val(mt);
        console.log(new Intl.NumberFormat('en-US').format(p));

    });

    $('#frame').on("change", function(e) {
        var fr = $("#frame option:selected").val();

        // IF LIMITED EDITION
        if($("#frame option:selected").val() == "Black Vodka" || $("#frame option:selected").val() == "Whiskey" || $("#frame option:selected").val() == "Bourbon" ){

                console.log('Premium Designer Frame INCLUDED');
                $('.frame_data').show();
                $('.frame_data').html( '(+' + $("#frame option:selected").val() + ' Frame, Included)');
                return false;
        }

        else  if($("#frame option:selected").val() == "ADDWITHACRYLIC") {
                console.log('ADD TO ACRYLIC Premium Designer Frame');
                $('.frame_data').show();
                $('.frame_data').html( '(+ <a target="_new" href="/styles">Optional Premium Frame Cost</a>)');
                $('#frame_price').val('$');
                return false;
        }

        // ELSE IF OPEN EDITION
        else if($("#frame option:selected").val() == "Studio-Ash-Gray" || $("#frame option:selected").val() == "Studio-Snow-White") {
            $('.frame_data').show();

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

            $('.frame_data').html( '(+' + fp + ' for Studio Frame)');
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
             $('.frame_data').hide();
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
