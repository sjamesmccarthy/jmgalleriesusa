<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="contact">
    <div class="grid-center">

        <div class="col-8_sm-11 pb-32 pl-32">

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
                <input class="half-size-old"type="text" id="contactname" name="contactname" placeholder="YOUR NAME (eg, John Smith)" value="<?= $name ?>" >
                <!-- </p> -->

                <!-- <p> -->
                <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
                <input class="half-size-old" type="text" id="contactemail" name="contactemail" placeholder="YOUR EMAIL (eg, john.smith@ydomain.com)" value="<?= $email ?>" >
                <!-- </p> -->

                <p>
                <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
                <input class="half-size-old" type="text" id="contactsubject" name="contactsubject" placeholder="<?= $subject_PH ?>" value="<?= $subject_VAL ?>" />
                </p>

                <div>
                <?= $message_PH_label ?>

                    <div class="<?= $hide_for_order ?>">
                    <?= $message_H3 ?>
                    <textarea id="comments" name="comments" placeholder="<?= $message_PH ?>" rows="30"><?= $msg ?></textarea>
                    </div>

                </div>


                <button class="mt-32" value="SEND"><?= $button_label ?></button>

                <div id="error"></div>
                </form>
            </div>

            <p style="border-radius: 6px;" id="form_response"> </p>
        </div>
        
        <div class="col-4 sm-hidden">
           
           <?php $this->getPartial('findus'); ?>
        
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

    $("input[type=text]").on("focus", function(e) {
        var ele = ".e_" + $(this).attr("id");
        console.log(ele);
        $(ele).hide();
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
            
            var errors=0;
            var name = $("#contactname").val(); 
            var email = $("#contactemail").val();
            var subject = $("#contactsubject").val();
            var message = $("#message").val();

            $(".error-form-validation").remove();

            if (name.length < 1) {
                $('#contactname').after('<span class="e_contactname error-form-validation">This field is required</span>');
                ++errors;
            }
            if (email.length < 1) {
                $('#contactemail').after('<span class="e_contactemail error-form-validation">This field is required</span>');
                ++errors;
            }
            if (subject.length < 1) {
                $('#contactsubject').after('<span class="e_contactsubject error-form-validation">This field is required</span>');
                ++errors;
            }
            
            if(errors > 1) {
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