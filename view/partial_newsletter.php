<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

<!-- <div class="newsletter-container">

    <form id="subscribeForm" action="/view/ajax_email_process.php" method="POST">
    <input type="hidden" id="formType" name="formType" value="SubscribeForm" />
    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
    <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />

    <h4 class="text-l">MONTHLY NEWSLETTER</h4>
    <p class="subheadline pb-16 text-l">Have a new release photo delivered right to your inbox!</p>
    
        <div class="subscribe-form-container">
        <i class="far fa-envelope form-icon"></i>
        <input tabindex="-1" type="text" class="subscribe-form-input" name="subcontactemail" id="subcontactemail" placeholder="your@email.com" />
        <button id="subBtn" class="subscribe-form-button"><i class="fas fa-arrow-right"></i></button>
        </div>
</form>
    <p id="form_response-subscribe"></p>
</div> -->

<h4 class="text-l">NEWSLETTER</h4>
<!-- <p class="subheadline pb-16 text-l">Have a new release photo delivered right to your inbox!</p> -->

<!-- Begin Mailchimp Signup Form -->
<!-- <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css"> -->
<!-- <style type="text/css"> -->
<!-- /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block. -->
<!-- We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */ -->
<!-- </style> -->
<div id="mc_embed_signup">
<form action="https://jmgalleries.us16.list-manage.com/subscribe/post?u=7fe25703399796912d1b5d6f8&amp;id=a869c7c419" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
  <div id="mc_embed_signup_scroll">
	  <input style="display: none;" type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address">
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_7fe25703399796912d1b5d6f8_a869c7c419" tabindex="-1" value=""></div>
    <div class="clear mc-inline">
      <!-- <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"> -->
      <p class="normal pb-16">Every month or so we share a new release and special offer &mdash; don't miss out.</p>
      <button type="submit" class="btn btn-success">
        SIGN-UP FREE
      </button>
    </div>
  </div>
</form>
</div>

<!--End mc_embed_signup-->

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