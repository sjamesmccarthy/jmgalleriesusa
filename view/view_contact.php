<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="contact">
    <div class="grid-center">

        <div class="col-9">

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
              return false;
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
                          
                          var data_html = "Thank You For Your Message, an art consultant will be in touch in 48 hours<!-- (code: " + data + ")-->";
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
                  });;
              });
        });

  });

</script>