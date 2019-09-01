<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<section id="contact">
    <div class="grid-center">

        <div class="col-9">

            <h1 class="pb-16"><?= $this->title ?></h1>

<script>

  jQuery(document).ready(function($){

      $('#contactForm').submit(function() {
            event.preventDefault();
            console.log('validating...');
            
            var name = $("#contactname").val();
            var email = $("#contactemail").val();
            var subject = $("#contactsubject").val();
            var message = $("#message").val();

            if (name == '' || email == '' || subject == '') {
              alert("Please Fill Required Fields");
              return false;
            } else {
              console.log('validation PASS');
            }

            console.log('Sending... ' + $('#g-recaptcha-response').val());

              var url = "view/ajax_email_process.php";

              grecaptcha.ready(function() {

                  grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
                    $.ajax({
                      type: "POST",
                      url: url,
                      data: $("#contactForm").serialize(),
                      async: true,
                      success: function(data)
                      {
                          $('.form-main').prop('disabled', true).css('opacity','.2');
                          $('#sendform').hide();
                          $('#form_response').html("Thank You For Your Message, an art consultant will be in touch in 48 hours.").addClass('success').show();

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

        <form id="contactForm" action="/view/ajax_email_process.php" method="POST">
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />

        <fieldset class="form-main">
        <p>
        <!-- <label class="" for="name">YOUR NAME</label> -->
        <input type="text" id="contactname" name="contactname" placeholder="YOUR NAME" value="" required>
        </p>

        <p>
        <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
        <input type="text" id="contactemail" name="contactemail" placeholder="YOUR EMAIL" value="" required>
        </p>

        <p>
        <!-- <label class="" for="contactinfo">Email Address or Phone Number</label> -->
        <input type="text" id="contactsubject" name="contactsubject" placeholder="PHOTOGRAPH TITLE OR SUBJECT" value="" required>
        </p>

        <!-- <input name="refer" type="hidden" value="<?= $print_name ?>" />
        <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
        </p> -->

        <p>
        <!-- <label class="" for="comments">TYPE YOUR MESSAGE HERE</label> -->
        <textarea id="comments" name="comments" placeholder="" rows="8"><?= $referringPhotoCommentsField ?></textarea>
        </p>
        </fieldset>

        <button id="sendform" value="SEND">SEND MESSAGE</button>
        </form>

        <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
            });
        });
        </script>

        <p id="form_response"> </p>


        </div>


    </div>
</section>
