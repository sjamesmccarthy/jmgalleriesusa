<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="contact">
    <div class="grid-center">

        <div class="col-11">

        <p class="blue"><?= $subTitle ?></p>
        <h1 class="pb-16"><?= $formTitle ?></h1>

        <form id="contactForm" action="/view/ajax_email_process.php" method="POST">
        <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
        <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />

        <fieldset class="form-main">
        <p>
        <!-- <label class="" for="name">YOUR NAME</label> -->
        <input type="text" id="contactname" name="contactname" placeholder="YOUR NAME" value="<?= $name ?>" required>
        </p>

        <p>
        <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
        <input type="text" id="contactemail" name="contactemail" placeholder="YOUR EMAIL" value="<?= $email ?>" required>
        </p>

        <p>
        <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
        <input type="text" id="contactsubject" name="contactsubject" placeholder="<?= $subject_PH ?>" value="<?= $subject_VAL ?>" required>
        </p>

        <?= $formSizes ?>

        <div class="mt-16">
        <?= $message_PH ?>
        
        <!-- <label class="" for="comments">TYPE YOUR MESSAGE HERE</label> -->
        <textarea style="margin-top: 10px" id="comments" name="comments" placeholder="TYPE ANY COMMENTS HERE" rows="8"><?= $msg ?></textarea>
        </div>
        
        <?= $promo_field ?>
        <?= $estimated_cost ?>
        <?= $payment_field ?>

        </fieldset>

        <button id="sendform" value="SEND"><?= $button_label ?></button>
        </form>

        <p id="form_response"> </p>


        </div>


    </div>
</section>

<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

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
                          
                          var data_html = "Thank You For Your Order, an art consultant will be in touch in 48 hours.<!-- (code: " + data + ")-->";
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