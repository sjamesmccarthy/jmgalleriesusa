<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<div class="newsletter-container">

    <form id="subscribeForm" action="/view/ajax_email_process.php" method="POST">
    <input type="hidden" id="formType" name="formType" value="SubscribeForm" />
    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
    <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />

    <h4 class="text-l">MONTHLY NEWSLETTER</h4>
    <p class="subheadline pb-16 text-l">Have a new release photo delivered right to your inbox!</p>
    
        <!-- <input type="text" style="width: 25%" name="contactfirstname" id="contactfirstname" placeholder="First Name" /> -->
        <!-- <input type="text" style="width: 25%"  name="contactlastname" id="contactlastname" placeholder="Last Name" /> -->
        <div class="subscribe-form-container">
        <i class="far fa-envelope form-icon"></i>
        <input tabindex="-1" type="text" class="subscribe-form-input" name="subcontactemail" id="subcontactemail" placeholder="your@email.com" />
        <button id="subBtn" class="subscribe-form-button"><i class="fas fa-arrow-right"></i></button>
        </div>
</form>
    <p id="form_response-subscribe"></p>
</div>


<script>

  jQuery(document).ready(function($){

    jQuery.noConflict();

      $('#subscribeForm').submit(function() {

        console.log('start.form.subscribeForm.submission');

        grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              console.log('grecaptcha.ready');
              // console.log( document.getElementById('g-recaptcha-response') );
        });

            event.preventDefault();
            console.log('validating...');
            
            var sub_first = $("#contactfirstname").val();
            var sub_last = $("#contactlastname").val();
            var sub_email = $("#subcontactemail").val();

            if (sub_first == '' || sub_last == '' || sub_email == '') {
              alert("Please Fill Required Fields to Subscribe \n" + sub_first + ' ' + $("#contactlastname").val() + ' ' + $("#subcontactemail").val());
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
                      data: $("#subscribeForm").serialize(),
                      async: true,
                      success: function(data)
                      {
                          
                          var data_html = "Thank You For Subscribing.";
                          $('#contactfirstname, #contactlastname, #subcontactemail').prop('disabled', true).css('opacity','.3');
                          $('#subBtn, #subscribeForm').hide();
                          $('#form_response-subscribe').html(data_html).addClass('success').show();
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