<link href="https://fonts.googleapis.com/css?family=Fira+Sans:100,300,400,500,700,800,900" rel="stylesheet">
<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>

    <div class="amazing-offer-container">

            <!-- <p class="amazing-offer-title">
              <span class="small">&mdash; jM Galleries presents &mdash;</span>
            </p> -->
              
              <h1 class="amazing-offer-h1 padbot-30">
                <?= strtoupper($amazingOfferMonth) ?>
                NEW RELEASE
              </h1>
              
              <p class="amazing-offer-caption">
                I am excited to share my latest work titled, <b>"<?= $amazingOfferTitle ?>"</b>. Captured in the beautiful and peaceful gardens at the Carmelite Monastery in Carmel, California; founded circa 1925 in honor of Our Lady Mediatrix and St. Therese.
              </p>
              
              <div class="amazing-offer-photo">
                <p class="amazing-offer-center">
                  <img class="amazing-offer-image" style="width: <?= $imageWidth ?>" src="/view/image/newsletter/amazing-offer-photo.jpg?month=<?= $amazingOfferMonth ?>" alt="Amazing Offer Email Photo" />
                </p>
              </div>
              
              <p class="amazing-offer-caption">
              Gazing down upon the gardens, the grand walls of the monastery delight in the small pink and white daisies which sway in the sweet and salty breeze of the Pacific Ocean.  These wild-spread <b>"Daises for Our Lady"</b>, and her gardens, offer tranquil moments to remind us of our journeys as we wander through her spirit.<br /><br />

              This fine-art photograph will inspire an aurora of peace in any room displayed. It is available in small (print-only), medium and large sizes as a standard float-mounted print. All are numbered, <a href="/styles" target="_new">limited-edition</a> series.
              </p>

            <p class="amazing-offer-caption" style="float: right; padding-bottom: 0; margin-top: 0;">
            Thanks for your support,<br />
              <img style="float: right; margin-right: 30px;" src="/view/image/signature_full-web.png" />
            </p>

            <p class="amazing-offer-blurb">
            Pre-Order Pricing for your Limited-Edition, Numbered, 13x19 Fine-Art Print
            </p>
            <p class="amazing-offer-blurb-desc">
            <span style="text-align: left"></span>
            </p>

        <div class="amazing-offer-form">
                
                <div class="amazing-offer-error-explained amazing-offer-error amazing-offer-padding red allcaps hidden center thickborder">
                    Please complete all the fields below.<br />Also, if you do not include a valid phone or email we will not be able to process your order.
                </div>
                
        <form id="amazingOfferForm" action="#" method="post">
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />

        <fieldset class="form-main">
        <p>
        <!-- <label class="" for="name">Your First and Last Name</label> -->
        <input class="" type="text" id="contactinfoname" name="contactinfoname" placeholder="YOUR NAME" value="" required>
        </p>

        <p>
        <!-- <label class=""  for="contactinfoEmail">Your Email Address</label> -->
        <input class="" type="text" id="contactinfoemail" name="contactinfoemail" placeholder="YOUR EMAIL" value="" required>
        </p>

        <p>
        <!-- <label class=""  for="contactinfoEmail">Your Email Address</label> -->
        <input class="" type="text" id="contactinfoaddress" name="contactinfoaddress" placeholder="YOUR STREET ADDRESS" value="" required>
        </p>

        <p>
        <!-- <label class=""  for="contactinfoEmail">Your Email Address</label> -->
        <input class="" type="text" id="contactinfoaddress" name="c" placeholder="YOUR CITY, STATE and POSTAL CODE" value="" required>
        </p>

        <p class="pt-16">
          <input type="checkbox" id="buyme" name="buyme" value="True, Pre-Sale" required/> 
          <label for="buyme" style="font-size: 1.2rem;">Yes, I would like to buy (1) Limited-Edition, Numbered, 13x19, Fine-Art Print, "<?= $amazingOfferTitle ?>" for $89 <strike>$100</strike>.
        <input name="amazingOfferTitle" type="hidden" value="<?= $amazingOfferTitle ?>" />
        </p>

      <span style="font-size: .8rem;"><a href="/styles">Learn more about our Styles, Editions and Prices.</a> If you prefer Acrylic, or wish to add an open-air-frame please <a href="/contact">contact us</a> for a price.</span>

        <p class="amazing-offer-center pt-16">
        <button id="sendform" class="amazing-offer-button allcaps">SUBMIT ORDER REQUEST</button>
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
                <p smallhalf>THIS OFFER EXPIRES ON <?= $amazingOfferExpiration ?>. MSRP pricing for float-mounted prints can be found on our <a href="/styles" target="_new">Styles, Editions and Pricing</a> page. This Pre-Order Pricing is only valid for 13x19 print (12x18 image area) Fine-Art photograph.
                *Taxes apply to Nevada residents. Price listed as USD. Shipping (UPS only) varies by destination and within U.S.A only. Limit 1 per customer per shipping address. All limited edition photos are signed, numbered and include a Certificate of Authenticity. This offer is only valid for online purchases and for this specific photo, "<?= $amazingOfferTitle ?>" and does not include a frame, mat or other mounting options. </p>
                
                  <!-- <p class="amazing-offer-center padtop40"><img src="/images/square-payment-icons.png" style="width: 200px;"/></p> -->
            </div>
            
            <p id="form_response" class="amazing-offer-form-response"> </p>

    </div>

    <script>

  jQuery(document).ready(function($){

      $('#amazingOfferForm').submit(function() {
            event.preventDefault();
            console.log('validating...');
            
            var name = $("#contactinfoname").val();
            var email = $("#contactinfoemail").val();
            var address = $("#contactinfoaddress").val();
            var citystate = $("#contactinfocitystate").val();

            if (name == '' || email == '' || address == '' || citystate == '') {
              alert("Please Fill Required Fields");
              return false;
            } else {
              console.log('validation PASS');
            }

            console.log('Sending... ' + $('#g-recaptcha-response').val());

              var url = "view/ajax_amazing_offer_email.php";

              grecaptcha.ready(function() {

                  grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
                    $.ajax({
                      type: "POST",
                      url: url,
                      data: $("#amazingOfferForm").serialize(),
                      async: true,
                      success: function(data)
                      {
                          $('.form-main').prop('disabled', true).css('opacity','.2');
                          $('#sendform, .amazing-offer-expires').hide();
                          $('#form_response').html("Thank You For Your Order.<br />Please check your Spam/Junk folder for a confirmation email. An art consultant will be in touch in 48 hours.").addClass('success').show();

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