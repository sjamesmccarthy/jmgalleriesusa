<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="contact">
    <div class="grid-center">

        <div class="col-8_sm-11">

            <h1><?= $formTitle ?></h1>
            <p class="checkout-sub blue"><?= $formTitleSub ?></p>
            
            <?= $subNotice ?>

        <form id="contactForm" action="/view/ajax_email_process.php" method="POST">
        <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
        <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />

        <fieldset class="form-main">
        <!-- <p> -->
        <!-- <label class="" for="name">YOUR NAME</label> -->
        <?= $order_about_you ?>
        <input class="half-size-old"type="text" id="contactname" name="contactname" placeholder="YOUR NAME (eg, John Smith)" value="<?= $name ?>" required>
        <!-- </p> -->

        <!-- <p> -->
        <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
        <input class="half-size-old" type="text" id="contactemail" name="contactemail" placeholder="YOUR EMAIL (eg, john.smith@ydomain.com)" value="<?= $email ?>" required>
        <!-- </p> -->

        <p>
        <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
        <input class="half-size-old" type="text" id="contactsubject" name="contactsubject" placeholder="<?= $subject_PH ?>" value="<?= $subject_VAL ?>" <?= $subject_disabled ?> />
        </p>

        <?= $formSizes ?>
        <?= $promo_field ?>
        <?= $estimated_cost ?>
        <?= $payment_field ?>

        <div>
        <?= $message_PH_label ?>

        <!-- <label class="" for="comments">TYPE YOUR MESSAGE HERE</label> -->
        <textarea id="comments" name="comments" placeholder="<?= $message_PH ?>" rows="18"><?= $msg ?></textarea>
        </div>
        
        <!-- <?= $promo_field ?> -->
        <?php // $payment_field ?>

        </fieldset>

        <button id="sendform" value="SEND"><?= $button_label ?></button>
        </form>

        <p id="form_response"> </p>


        </div>

        <div class="col-3_sm-11">
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

            var url = "/view/ajax_promocode_process.php";
            console.log("promo:" + $('#promocode').val() + "," + "cost:" + $('#estimated_cost').text());

            $.ajax({
                  type: "POST",
                  url: url,
                  data: { "promo":$('#promocode').val(), "cost":$('#estimated_cost').text() },
                  async: true,
                  success: function(data)
                  {
                      if(data == "INVALID CODE") {
                          $('#promocode').val(data).css('color','red');
                      } else {
                          var oldprice = $('#estimated_cost').text();
                          $('#estimated_cost_format').html(data + ' USD <span style="text-decoration: line-through; color: #e4e4e4;">' + oldprice + '<span>');
                          console.log(data);
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