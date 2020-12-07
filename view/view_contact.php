<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="contact">
    <div class="grid-center">

        <div class="col-8_sm-11">

            <div class="form-main">
            <h1><?= $formTitle ?></h1>
            <p class="checkout-sub blue"><?= $formTitleSub ?></p>
            
            <?= $subNotice ?>

                <form id="<?= $action_id ?>" action="<?= $action_uri ?>" method="POST">
                <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
                <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />

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
                <input class="half-size-old" type="text" id="contactsubject" name="contactsubject" placeholder="<?= $subject_PH ?>" value="<?= $subject_VAL ?>" />
                </p>

                <div>
                <?= $message_PH_label ?>

                    <div class="<?= $hide_for_order ?>">
                    <?= $message_H3 ?>
                    <textarea id="comments" name="comments" placeholder="<?= $message_PH ?>" rows="9"><?= $msg ?></textarea>
                    </div>

                </div>


                <button class="mt-32" value="SEND"><?= $button_label ?></button>

                <div id="error"></div>
                </form>
            </div>

            <p style="border-radius: 6px;" id="form_response"> </p>
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
                          
                          var data_html = "Thank You For Your Message,<br />an art consultant will be in touch in 48 hours.";
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