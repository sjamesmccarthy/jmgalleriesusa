<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="contact">
    <div class="grid-center">

        <div class="col-8_sm-11">

            <h1><?= $formTitle ?></h1>
            <p class="checkout-sub blue"><?= $formTitleSub ?></p>
            
            <?= $subNotice ?>

            <form id="<?= $action_id ?>" action="<?= $action_uri ?>" method="POST">
            <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
            <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
            <input name="product_id" type="hidden" value="1" />

            <!-- <p> -->
            <!-- <label class="" for="name">YOUR NAME</label> -->
            <?= $order_about_you ?>
            <input class="half-size-old"type="text" id="contactname" name="contactname" placeholder="YOUR NAME (eg, John Smith)" value="<?= $name ?>" required>
            <!-- </p> -->

            <!-- <p> -->
            <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
            <input class="half-size-old" type="text" id="contactemail" name="contactemail" placeholder="YOUR EMAIL (eg, john.smith@ydomain.com)" value="<?= $email ?>" required>
            <!-- </p> -->

            <?= $subject ?>

            <?= $formSizes ?>
            <?= $promo_field ?>
            <?= $estimated_cost ?>
            <?= $deposit_hidden ?>


            <div>
            <?= $message_PH_label ?>

                <div class="<?= $hide_for_order ?>">
                <?= $message_H3 ?>
                <textarea id="comments" name="comments" placeholder="<?= $message_PH ?>" rows="9"><?= $msg ?></textarea>
                </div>

            </div>
            
            <?= $payment_field ?>
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
           
           <?php $this->getPartial('findus'); ?>

        </div>

    </div>
</section>

<?= $pay_sqPaymentFormJS ?>
  
<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

    $('#email_signup').on("click", function() {
        // $(location).attr('href', '/signup', '_blank');
        window.open('/signup', '_blank'); 
    })

    $("#promocode").keyup(function () {
          $(this).addClass('toUpper');
    });

    $('#apply_promo').on("click", function(e) {
        e.preventDefault();

        // run ajax call to small php script which process this. 
        // script will return an integer. 
        // then use javascript to format
        // console.log(payload);

        if( $('#promocode').val() != '' ) {

            // console.log( "realprice: " + $('#price').val() );

            var url = "/view/ajax_promocode_process.php";
            console.log("promo:" + $('#promocode').val() + "," + "cost:" + $('#price').val());

            $.ajax({
                  type: "POST",
                  url: url,
                  data: { "promo":$('#promocode').val(), "cost":$('#price').val() },
                  async: true,
                  success: function(data)
                  {
                      if(data == "INVALID CODE") {
                          $('#promocode').val(data).css('color','red');
                      } else {

                          var oldprice = parseFloat($('#price').val());
                          
                          if( $('#ship_UPS_value').val() != '0') {
                              console.log("addShippingUPS: " + $('#ship_UPS').val() );
                              var rValue = parseFloat(data) + 30;
                            } else {
                                console.log( $('#ship_UPS_value').val() );
                                var rValue = parseFloat(data);
                            }
                            
                        var newprice = rValue.toFixed(2);
                        // console.log("np: " + newprice);
                          var priceCents = newprice * 100;
                          $('#estimated_cost_format').html( newprice + ' <!--USD <span style="text-decoration: line-through; color: #e4e4e4;">' + oldprice + '<span> -->');
                          $('#estimated_cost').html(newprice);
                          
                          <?php if($deposit != "true") { ?>
                            // console.log("pc: " + priceCents.toFixed(0) );
                            $('#amount_total').val(priceCents.toFixed(0));
                            $('#sq-creditcard span#estimated_cost_format').html(newprice);
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

            // var promo_code = $('#promocode').val();
            // var promo_type = promo_code.split(':')
            // var promo_amount = 0;
            // var estimated_cost = $('#estimated_cost').text();
            // var new_price = estimated_cost - promo_type[1];
            // var format_usd = new Intl.NumberFormat('en-US', {
            //   style: 'currency',
            //   currency: 'USD',
            // });
            // console.log('apply promo clicked ' + format_usd.format(new_price) );
        }

    });

    var UPScost = 30.00;
    var shipping = UPScost.toFixed(2);
    $('#ship_UPS').on('click', function () {
        $("#ship_USPS").prop("checked",false);
        $("#ship_USPS").val("0");
        var oldpriceV = parseFloat($('#estimated_cost').text());
        var oldprice = oldpriceV.toFixed(2);
        var newprice = ( parseFloat(oldprice) + parseFloat(shipping) );
        var newpriceTrim = newprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        $('#estimated_cost_format').html(newpriceTrim);
        $('#estimated_cost').html(newpriceTrim);
        $('#ship_UPS').attr("disabled",true);
        $('#ship_UPS_value').val(UPScost);
        <?php if($deposit != "true") { ?>

            var b = newprice * 100;
            var newpriceTrim = newprice.toFixed(2);

            $('#amount_total').val(newpriceTrim * 100);
            $('#sq-creditcard span#estimated_cost_format').html(newpriceTrim);
        <?php } ?>
    });
    
    $('#ship_USPS').on('click', function () {
        $("#ship_UPS").prop("checked",false);
        $("#ship_USPS").val("1");
        var oldprice = parseFloat($('#estimated_cost').text());
        // var oldprice = oldpriceV.toFixed(2);
        var newprice = ( parseFloat(oldprice) - parseFloat(shipping) );
        var newpriceTrim = newprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        $('#estimated_cost_format').html(newpriceTrim);
        $('#estimated_cost').html(newpriceTrim);
        $('#ship_UPS').attr("disabled",false);
        $('#ship_UPS_value').val('0');
        <?php if($deposit != "true") { ?>
            $('#amount_total').val(newpriceTrim * 100);
            $('#sq-creditcard span#estimated_cost_format').html(newpriceTrim);
        <?php } ?>
    });

      $('#contactForm').submit(function() {

        console.log('start.form.contactForm.submission');
        
        grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              console.log('grecaptcha.ready');
              // console.log( document.getElementById('g-recaptcha-response') );
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