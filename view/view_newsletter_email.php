<link href="https://fonts.googleapis.com/css?family=Fira+Sans:100,300,400,500,700,800,900" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

    <div class="amazing-offer-container mt-32">
              
              <div class="amazing-offer-photo">
                <p class="amazing-offer-center">
                  <img class="amazing-offer-image" style="width: <?= $imageWidth ?>" src="/view/image/amazing-offer-email-photo.jpg?month=<?= $amazingOfferMonth ?>" alt="Amazing Offer Email Photo" />
                </p>
              </div>
              
               <h1 class="amazing-offer-h1">
                 <?= $amazingOfferTitle ?>
              </h1>
              <p style="text-align: center; font-size: 1.5rem;">The <?= $amazingOfferMonth ?> New Release</p>

              <p class="amazing-offer-caption">
                <b>And So The Story Goes ...</b>
              </p>

              <p class="amazing-offer-blurb">
                <?= $andSoTheStoryGoes ?>
              </p>

              <p class="pt-32">
               <?= $amazingOfferTitle ?> will beautify and enhance any room that it is displayed. <br />$89 Pre-order pricing is for (1) 12x18 <a href="/styles">Mounted Wall Decor print</a>. All are numbered, limited-edition series.
              </p>

            <p class="amazing-offer-blurb" style="margin-top: 32px; float: right; padding-bottom: 32px;">
            Thanks for reading, and journey on!<br />
              <img style="float: right; margin-right: 30px;" src="/view/image/signature_full-web.png" />
            </p>

            <p class="amazing-offer-blurb">
            CHECKOUT INFORMATION
            </p>
            <p class="amazing-offer-blurb-desc">
            <span style="text-align: left"></span>
            </p>

        <div class="amazing-offer-form">
                
                <div class="amazing-offer-error-explained amazing-offer-error amazing-offer-padding red allcaps hidden center thickborder">
                    Please complete all the fields below.<br />Also, if you do not include a valid phone or email we will not be able to process your order.
                </div>
                
        <form id="amazingOfferForm" action="#" method="post">
        <input type="hidden" id="formType" name="formType" value="AmazingOfferForm" />
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
        <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />

        <fieldset class="form-main">
        <p>
        <!-- <label class="" for="name">Your First and Last Name</label> -->
        <input class="" type="text" id="contactname" name="contactname" placeholder="YOUR NAME" value="" required>
        </p>

        <p>
        <!-- <label class=""  for="contactinfoEmail">Your Email Address</label> -->
        <input class="" type="text" id="contactemail" name="contactemail" placeholder="YOUR EMAIL" value="" required>
        </p>

        <p>
        <!-- <label class=""  for="contactinfoEmail">Your Email Address</label> -->
        <input class="" type="text" id="contactaddress" name="contactaddress" placeholder="YOUR STREET ADDRESS" value="" required>
        </p>

        <p>
        <!-- <label class=""  for="contactinfoEmail">Your Email Address</label> -->
        <input class="" type="text" id="contactaddresscitystate" name="contactaddresscitystate" placeholder="YOUR CITY, STATE and POSTAL CODE" value="" required>
        </p>

        <p class="pt-16">
          <input type="checkbox" id="purchase" name="purchase" value="True, Pre-Sale" required/> 
          <label for="purchase" style="font-size: 1.2rem;">Yes, I would like to buy (1) Limited-Edition, Numbered, 12x18, Mounted Wall Decor, "<?= $amazingOfferTitle ?>" for <?= $amazingOfferPrice ?> <strike>$100</strike>.
        <input name="amazingOfferTitle" type="hidden" value="<?= $amazingOfferTitle ?>" />
        </p>

      <span style="font-size: .8rem;"><img src="/view/image/square-payment-icons.png" style="width: 100px; vertical-align: middle" />&nbsp;&nbsp;I understand that I will be e-mailed an invoice through Square (Mastercard, Visa, Discover) for <?= $amazingOfferPrice ?> plus shipping. <a href="/legal">Terms of Sale</a></span>

        <p class="amazing-offer-center pt-16">
        <button id="sendform" class="amazing-offer-button allcaps">LIMITED TIME — BUY NOW</button>
        </p>

        </fieldset>
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

            <div class="amazing-offer-expires">
                <p smallhalf>THIS OFFER EXPIRES ON <?= $amazingOfferExpiration ?>. Standard pricing for Mounted Wall Decor can be found on our <a href="/styles" target="_new">Styles, Editions and Pricing</a> page. This offer is not available for framed or Acrylic Fine-Art. *Taxes apply to Nevada residents. Price listed as USD. Shipping (UPS only) varies by destination and within U.S.A only. Limit 1 per customer per shipping address. All limited edition photos are signed, numbered and include a Certificate of Authenticity. This offer is only valid for online purchases and for this specific photo, "<?= $amazingOfferTitle ?>" and does not include a frame, mat or other mounting options.</p>
                
                  <!-- <p class="amazing-offer-center padtop40"><img src="/images/square-payment-icons.png" style="width: 200px;"/></p> -->
            </div>
            
            <p id="form_response" class="amazing-offer-form-response"> </p>

    </div>

    <script>

  jQuery(document).ready(function($){

      $('#amazingOfferForm').submit(function() {

        console.log('start.form.submission');

        grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              console.log('grecaptcha.ready');
              // console.log( document.getElementById('g-recaptcha-response') );
        });

            event.preventDefault();
            console.log('validating...');
            
            var name = $("#contactname").val();
            var email = $("#contactemail").val();
            var address = $("#contactaddress").val();
            var citystate = $("#contactaddresscitystate").val();

            if (name == '' || email == '' || address == '' || citystate == '') {
              alert("Please Fill Required Fields");
              return false;
            } else {
              console.log('validation PASS');
            }

            console.log('Sending... ' + $('#g-recaptcha-response').val());

              var url = "/view/ajax_email_process.php";
              console.log(url);

              grecaptcha.ready(function() {

                  grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
                    $.ajax({
                      type: "POST",
                      url: url,
                      data: $("#amazingOfferForm").serialize(),
                      async: true,
                      success: function(data)
                      {
                          var data_html = "Thank You For Your Message, an art consultant will be in touch in 48 hours<!-- (code: " + data + ")-->";
                          $('.form-main').prop('disabled', true).css('opacity','.2');
                          $('#sendform, .amazing-offer-expires').hide();
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