<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<div class="newsletter-container">

    <form id="subscribeForm" action="/view/ajax_email_process.php" method="POST">
    <input type="hidden" id="formType" name="formType" value="SubscribeForm" />
    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
    <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />

    <h4 class="pb-16">SUBSUBSCRIBE TO OUR ONCE A MONTH AMAZING OFFER</h4>
    
        <input type="text" style="width: 25%" name="contactfirstname" id="contactfirstname" placeholder="First Name" />
        <input type="text" style="width: 25%"  name="contactlastname" id="contactlastname" placeholder="Last Name" />
        <input type="text" style="width: 34%; margin-right: 12px;"  name="subcontactemail" id="subcontactemail" placeholder="Email" />
        <button id="subBtn">SUBSCRIBE</button>

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