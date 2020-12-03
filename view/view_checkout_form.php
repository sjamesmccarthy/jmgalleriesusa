<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="contact">
    <div class="grid-center">

        <div class="col-8_sm-11">

            <h1><?= $formTitle ?></h1>
            <p class="checkout-sub blue"><?= $subtitle ?></p>
            
            <?= $subNotice ?>

            <form id="nonce-form" action="<?= $action_uri ?>" method="POST">
            <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
            <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
            
            <!-- <input type="hidden" name="edition" value="product" /> -->
            <input type="hidden" name="title" value="<?= $order_title ?>" />
            <input type="hidden" id="shipping_cost" name="shipping_cost" value="null" />
            <input type="hidden" id="shipping_provider" name="shipping_provider" value="null" />
            
            <?= $hidden_fields ?>

            <h3>About You</h3>
            <input class="half-size-old"type="text" id="contactname" name="contactname" placeholder="YOUR NAME (eg, John Smith)" value="<?= $name ?>" required>

            <input class="half-size-old" type="text" id="contactemail" name="contactemail" placeholder="YOUR EMAIL (eg, john.smith@ydomain.com)" value="<?= $email ?>" required>

            <h3 class="mt-32 pb-0">Your Order for $<span id="estimated_cost_format"><?= $estimated_cost_calc ?></span> <span id="estimated_cost_format_strike" style="text-decoration: line-through; color: #e4e4e4;"><span></h3>
            <span id="estimated_cost" class="noshow"><?= $cost ?></span>
            <?= $limited_deposit ?>
            <input type='hidden' id="price" name='price' value="<?= $cost ?>" />
            <input type='hidden' id="quantity" name='quantity' value="<?= $res_quantity ?>" />
            
            <textarea style="border:0; border-left: 1px solid #e4e4e4; margin-left: 2rem; font-size: 1rem; height: 12rem; margin-top: 8px;"  id="contactsubject" name="contactsubject" disabled /><?= $order_subject ?></textarea>

            <p class="pt-8 pb-32 promo-container"><input class="half-size" style="margin-bottom: 0;" type="text" id="promocode" name="promocode" placeholder="PROMO CODE" value="<?= $promo_code ?>" /><input type="hidden" id="promo_amt" name="promo_amt" value="0" /><span class="ml-16 tiny promo-btn"><a href="#" id="apply_promo">apply code</a></span></p><p class="promo-label"><b>PROMO <span class="promo-name uppercase"></span> APPLIED</b></p>

            <div>
                <h3 class="pt-16">Ship To</h3> 
                <p><input class="half-size-old" type="text" name="address" placeholder="SHIPPING ADDRESS (eg, 123 Main St.)" value="<?= $address ?>" $required />
                <input class="half-size-old" type="text" name="address_other" placeholder="SHIPPING ADDRESS SECOND LINE (eg, Suite, Apt)" value="<?= $address_exxtra ?>"/></p>
                <p><input class="half-size-old" type="text" name="city" placeholder="CITY (eg, Las Vegas, Dallas, Barstow)" value="<?= $city ?>"required/>
                <input class="half-size-old" type="text" name="state" placeholder="State (eg, NV, CA, NY, TX)" value="<?= $state ?>"required/></p>
                <p><input class="half-size-old" type="text" name="postalcode" placeholder="Postal Code (eg, 95474)" value="<?= $postalcode ?>"required/><p>
                <p><input class="half-size-old" type="text" name="phone" placeholder="PHONE (eg, 951-708-1831)" value="<?= $phone ?>"required /><p>
                
                <ul class="shipping">
                    <?= $ship_rates_html ?>
                </ul>

            </div>
            
            <h3 class='mt-32'>Payment</h3><p class='pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' /> <!-- <i style='font-size: 1.8rem; margin-left: 5px;' class='fab fa-bitcoin'></i> --><br /><span class='small'Estimated Total Not Including Tax or Shipping or any Promotional Codes.<br />Visa, Mastercard, American Express and Discover accepted and processed with Square. <!-- Shipping costs and tax, if applicable, will be included on final bill. Bitcoin is accepted via Coinbase or Square Cash App.<br /> Cash (USD) is accepted on pickup only orders. No checks. <u>There is no payment due at this time.</u> You will be billed separately through Square.--></span></p>

            <?= $pay_SqPaymentForm ?>
            <?= $pay_SqForm_CSS ?>
            <?= $pay_SqPaymentForm_localjs ?>
            <?= $pay_SqPaymentFormFields ?>


            <button class="mt-32" id="sq-creditcard" 
                    onclick="onGetCardNonce(event)" value="SEND"><?= $button_label ?></button>

            <div id="error"></div>
            <input type="hidden" id="card-nonce" name="nonce">
            </form>

            <p id="form_response"> </p>
        </div>

        <div class="pl-32 col-3_sm-11">
            <!-- <h1 style="line-height: 1">Staying Connected</h1>
            <p class="pt-16">There are numerous ways to stay connected with j.McCarthy and jM Galleries from following on Instagram, LinkedIn, Twitter to subscribing to the monthly newsletter or reading our <a href="/polarized">Field Notes</a> blog.</p> -->
            
            <h2 class="pt-32" style="line-height: 1">Join<br />My Newsletter</h2>
            <p class="pt-16 pb-16">Every month I will send you a new photograph to enjoy as well as a special offer for a tinyViews&trade; Edition and preview an upcoming Limited Edition.</p>
            <input type="text" class="newsletterinput" name="email_signup" id="email_signup" placeholder="Your Email" /><button class="newsletter-button"><i class="fas fa-arrow-right" style="vertical-align: middle; margin-top: -15px; position: relative;"></i></button>

            <h2 class="pt-32" style="line-height: 1">Read<br />My Field Notes</h2>
            <p class="pt-16">A weekly blog about art, photography, collecting and my photography adventures.</p>
            <p class="pt-16"><a href="/polarized">Read Now</a></p>

            <h2 class="pt-32" style="line-height: 1">Follow Me<br />on Social Media</h2>
            <p class="pt-16">
                <!-- <a target="_new" class="mr-16 blue" style="font-size: 1.5rem" href="http://twitter.com/jmgalleriesusa"><i class="fab fa-twitter"></i></a> -->
                <a target="_new" class="mr-16 blue" style="font-size: 1.5rem" href="http://linkedin.com/company/jmgalleriesusa"><i class="fab fa-linkedin"></i></a>
                <a target="_new" class="mr-16 blue" style="font-size: 1.5rem" href="http://instagram.com/jmgalleriesusa"><i class="fab fa-instagram"></i></a>
                <!-- <a class="mr-16" href="/polarized"><i class="fas fa-pen-alt"></i></a> -->
                <!-- <a target="_new" class="mr-16" href="/signup"><i class="fas fa-envelope"></i></a> -->
            </p>

        </div>

    </div>
</section>

<?= $pay_sqPaymentFormJS ?>
  
<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

     $('.ship').click(function() {
        $('.ship').not(this).prop('checked', false);
        var shipping = $(this).val();
        var shipping_provider = $(this).attr('id');
        var shipping_provider_name = $(this).attr('data-shipper');
        console.log( shipping_provider + '=' + shipping );
        
        /* Update costs and hidden fields */
        var oldprice = parseFloat( parseFloat( $('#estimated_cost').html() ) );
        var newprice = parseFloat(oldprice.toFixed(2)) + parseFloat( shipping );
        var newpriceTrim = newprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        var newpriceCents = newprice * parseFloat(100);
        console.log("oldprice:" + oldprice + "/" + "newprice:" + newprice + "/shipCost: " + $(this).val() );
        
        $('#shipping_provider').val(shipping_provider_name);
        $('#shipping_cost').val(shipping);
        $('#estimated_cost_format, #sq-creditcard span#estimated_cost_format_btn').html(newpriceTrim);
        $('#sq-creditcard #amount_total').val(newpriceCents);
        
        <?php if($deposit != "true") { ?>
            $('#amount_total').val(newpriceCents.toFixed(0));
            $('#sq-creditcard span#estimated_cost_format_btn').html( newpriceTrim );
        <?php } else { ?>
            $('#amount_total').val('10000');
            var b = parseFloat( $('#amount_total').val() / 100 );
            var bdec = b.toFixed(2);
            console.log('dep:true ' + bdec);
            $('#sq-creditcard span#estimated_cost_format_btn').html( bdec );
        <?php } ?>

    });

    $("#promocode").focus(function () {
        $('#promocode').val('');
        $('#promocode').css('color','black');
    })

    $("#promocode").keyup(function () {
          $(this).addClass('toUpper');
    });

    $('#apply_promo').on("click", function(e) {
        e.preventDefault();

        if( $('#promocode').val() != '' ) {

            console.log( "realprice: " + $('#price').val() );

            var url = "/view/ajax_promocode_process.php";
            console.log("promo:" + $('#promocode').val() + "," + "cost:" + $('#price').val());

            $.ajax({
                  type: "POST",
                  url: url,
                  data: { "promo":$('#promocode').val(), "cost":$('#price').val() },
                  async: true,
                  success: function(data)
                  {
                      if(data == "INVALID CODE -0") {
                          data = "INVALID: DISCOUNT CAN'T BE GREATER THEN PRODUCT PRICE";
                          $('#promocode').val(data).css('color','red');
                      } else if(data == "INVALID CODE 1") {
                          data = "HUH? WE COULDN'T FIND THAT CODE";
                          $('#promocode').val(data).css('color','red');
                        } else {

                            var oldprice = parseFloat($('#price').val());
                            console.log("oldPrice: " + oldprice);
                          
                            var rValue = parseFloat(data);
                            console.log('data:' + data);
                            
                            $('input:checkbox[class=ship]').each(function() 
                            {    
                                if( $(this).is(':checked') ) {
                                    var shipping = $(this).val();
                                    var shipping_provider = $(this).attr('id');
                                    var shipping_provider_name = $(this).attr('data-shipper');

                                    console.log('ship_box: ' + shipping);

                                    rValue = rValue + parseFloat(shipping);
                                    $('#shipping_provider').val(shipping_provider_name);
                                    $('#shipping_cost').val(shipping);
                                } else {
                                    var shipping = 0;
                                }

                            });

                            var newprice = rValue.toFixed(2);
                            console.log("newBasePrice: " + newprice);

                            var priceCents = newprice * 100;
                            var newpriceFormatted = newprice.replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            var oldpriceFormatted = oldprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            $('#estimated_cost_format').html( newpriceFormatted);
                            $('#estimated_cost_format_btn').html( newpriceFormatted);
                            $('#estimated_cost_format_strike').html( oldpriceFormatted );
                            $('#estimated_cost').html(newprice);
                            
                            <?php if($deposit != "true") { ?>
                                console.log("pc: " + priceCents.toFixed(0) );
                                $('#amount_total').val(priceCents.toFixed(0));
                                $('#sq-creditcard span#estimated_cost_format').html(newpriceFormatted);
                            <?php } ?>

                            var promo_amt = parseFloat(oldprice) - parseFloat(newprice);
                            $('#promo_amt').val( promo_amt.toFixed(2) );
                            $('.promo-btn').hide();
                            $('.promo-container').hide();
                            $('.promo-name').html( $('#promocode').val() );
                            $('.promo-label').show();
                        }
                  },
                  error : function(request,error) {
                      console.log("Request: "+JSON.stringify(request));
                  }
                });
        }

    });

      $('#CheckOutForm').submit(function() {

        console.log('CheckOutForm.submit().');
        
        grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              console.log('grecaptcha.ready');
              console.log( document.getElementById('g-recaptcha-response') );
        });

            event.preventDefault();
            console.log('validating...');
            
            var name = $("#contactname").val();
            var email = $("#contactemail").val();
            var subject = $("#contactsubject").val();
            var message = $("#message").val();

            if (name == '' || email == '' || subject == '') {
              alert("Please Fill Required Fields To Send Message.");
            //   return false;
            } else {
              console.log('validation PASS');
            }

            console.log('Sending... ' + $('#g-recaptcha-response').val());

              var url = "/view/ajax_email_process.php";

              grecaptcha.ready(function() {

                  grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
                    $.ajax({
                      type: "POST",
                      url: url,
                      data: $("#contactForm").serialize(),
                      async: true,
                      success: function(data)
                      {
                          
                          var data_html = "Thank You For Your Order, an art consultant will be in touch in 48 hours.";
                          $('.form-main').prop('disabled', true).css('opacity','.3');
                          $('.form-main').slideUp('slow');
                          $('#sendform').hide();
                          $('#form_response').html(data_html).addClass('success').show();
                          console.log(data);
                      },
                      error : function(request,error) {
                          console.log("Request: "+JSON.stringify(request));
                      }
                    });
                    
                    return false;
                  });
              });
        });

  });

</script>