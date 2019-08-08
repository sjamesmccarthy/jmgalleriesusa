<link href="https://fonts.googleapis.com/css?family=Fira+Sans:100,300,400,500,700,800,900" rel="stylesheet">

    <div class="amazing-offer-container">

            <!-- <p class="amazing-offer-title">
              <span class="small">&mdash; jM Galleries presents &mdash;</span>
            </p> -->
              
              <h1 class="amazing-offer-h1 padbot-30">
                <!-- <?= $amazingOfferTitle ?></span> -->
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
            Pre-Order Pricing for your Limited-Edition, Numbered, Fine-Art Print
            </p>
            <p class="amazing-offer-blurb-desc">
            <span style="text-align: left"></span>
            </p>

            <div class="amazing-offer-form">
                
                <div class="amazing-offer-error-explained amazing-offer-error amazing-offer-padding red allcaps hidden center thickborder">
                    Please complete all the fields below.<br />Also, if you do not include a valid phone or email we will not be able to process your order.
                </div>
                
        <form id="amazingOfferForm" action="#" method="post">

        <p>
        <label class="" for="name">Your First and Last Name</label>
        <input class="" type="text" id="name" name="name" placeholder="First and Last Name" value="" required>
        </p>

        <p>
        <label class=""  for="contactinfoEmail">Your Email Address</label>
        <input class="" type="text" id="contactinfoEmail" name="contactinfoEmail" placeholder="Your Email (example: joe@email.com)" value="" required>
        </p>

        
       <div class="select-wrapper">
        <label class=""  for="size">Payment Method</label>
            <select class="" id="size" name="size">
                <option value="0">SELECT YOUR SIZE & PRE-ORDER PRICING</p>
                <option value="0">- - - - -</option>
                <option value="12x18">$59 (12x18) - SMALL, Print-Only, Numbered, Limited-Edition, SAVE $61</option>
                <option value="16x24">$189 (16x24) - MEDIUM, Numbered, Limited-Edition, SAVE $351</option>
                <option value="24x36">$369 (24x36) - LARGE, Numbered, Limited-Edition, SAVE $591</option>
            </select><br />
        </div>

      <span style="font-size: .8rem;"><a href="/styles">Learn more about our Styles, Editions and Prices.</a> If you prefer Acrylic, or wish to add an open-air-frame please <a href="/contact">contact us</a> for a price.</span>

        <!-- <p class="buyme"> -->
          <!-- <input class="" type="checkbox" id="buyme" name="buyme" value="buyMe" /> 
          <label for="buyme" style="font-size: 1.2rem;">Yes, I would like to buy (1) Limited-Edition, Numbered, Fine-Art Print, "<?= $amazingOfferTitle ?>". -->
        <input name="amazingOfferTitle" type="hidden" value="<?= $amazingOfferTitle ?>" />
        <!-- </p> -->

        <div class="g-recaptcha"
          data-sitekey="6Lem3V0UAAAAAJQyKvI6lkyRHZJstUt44YYq0TQ4"
          data-callback="formSubmit"
          data-size="invisible">
        </div>

        <p class="amazing-offer-center">
        <button id="formButton" class="amazing-offer-button allcaps">SUBMIT ORDER</button>
        </p>

        </form>
        <script>onload();</script>

    </div>

            <div class="amazing-offer-expires">
                <p smallhalf>THIS OFFER EXPIRES ON <?= $amazingOfferExpiration ?>. MSRP pricing for float-mounted prints can be found on our <a href="/styles" target="_new">Styles, Editions and Pricing</a> page. This Pre-Order Pricing is only valid for Small, Medium and Large Fine-Art photographs.
                *Taxes apply to Nevada residents. Price listed as USD. Shipping (UPS only) varies by destination and within U.S.A only. Limit 1 per customer per shipping address. Each series is limited to 12 photos. All limited edition photos are signed, numbered and include a Certificate of Authenticity. This offer is only valid for online purchases and for this specific photo, "<?= $amazingOfferTitle ?>" and does not include a frame. </p>
                
                  <!-- <p class="amazing-offer-center padtop40"><img src="/images/square-payment-icons.png" style="width: 200px;"/></p> -->
            </div>
            
            <p id="form_response" class="amazing-offer-form-response"> </p>

    </div>