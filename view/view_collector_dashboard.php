<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>
<link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap" rel="stylesheet">

<section class="collector--section">
    <div class="grid-12">

        <div class="col-12 collector--main_container">

           <div class="signout">
        
           <p><span class="whoami"><?= $res_first_name ?> <?= $res_last_name ?> &mdash; </span><a href="/d/collector/signout?ref=collector">sign out</a></p>
            </div>

            <div class="welcome-msg">
                <!-- <h1>Hello, <?= $res_first_name ?> <?= $res_last_name ?></h1> -->
                <!-- <p class="subhead">Welcome To <span class="col-em">Your Limited Edition Collection</span>of j.McCarthy Fine Art Photography</p> -->
            </div>

            <article class="note-from-artist">
                    <p>
                        Hello <?= $res_first_name ?> <?= $res_last_name ?>,<br /><br />Thank you for being a collector of j.McCarthy Fine Art. I am grateful for your support and continued loyalty, and hope that you have found the perfect place in your home or office for your fine art purchase.<br /><br />This collector portal is where you can easily manage your collection, earn rewards for referring family and friends and discover some amazing offers and new Limited Edition releases that I have curated just for my collectors. If you have any questions about your artwork or would like to inquire about new artwork, please <a href="/contact">contact</a> me.
                   </p>

                   <p style="text-align: right">Cheers, <br /><img src="/view/image/signature_full-web.png"></p>

                    <div id="note-close" style="text-align: right"><i class="fas fa-times-circle"></i></div>
            </article>

            <?= $mycollection_html ?>

            <article id="rewards" class="mt-32">
                <div class="grid-4_sm-2 grid-4_md-3">
                    <div class="most-popular--title col-12">
                        <h2 class="uppercase ">YOUR AMAZING OFFER &mdash; SAVE 52%</h2>
                        <p><b>As a collector you are privy to some special, exclusive new release fine art by j.McCarthy and some amazing offers.</b></p>
                        <p class="mt-8">As So The Story Goes ... at Salk Institute for Biologocial Studies in La Jolla, California. After walking around this beautiful campus just before sunset, I finally came to the front-gate and a "closed" sign stared back at me. I stood there, blank faced and let down when a security guard approached and asked if I'd like a tour. Of course I replied "are you joking?" There was only 1 rule he said: "No tripods". He escorted me to the well-known and well-photographed courtyard and there, with my tripod benched, I got a few shots of this architecturally renowned campus that unifies the sky, sea and science and once a year during the Winter Solstice the river of life aligns directly with an ocean sunset.</p>

                        <p class="mt-8"><a target="_ao" href="/contact?photo=<?= $res_currenOfferName ?>&size=SIZE-60CM&frame=DARK-WALNUT&cost=480&promo_code=COLAMOF-SAVE52&email=<?= $username ?>&name=<?= $res_first_name ?> <?= $res_last_name ?>">Order Your Framed <?= $res_imageSize ?> Limited Edition Exclusive Amazing Offer Now for <b><?= $res_amazingOfferPrice ?></b> <strike><?= $res_amazingOfferRegPrice ?></strike> (52% off Limited Edition Pricing)</a></p>
                    </div>
                    
                    <div class="amazing-offer-photo mt-32">
                    <!-- <a target="_ao" href="/d/collector/amazing-offer"><button class="button-inv" style="position: absolute;right: 40px;top: 40px;">ORDER THIS AMAZING OFFER</button></a> -->
                    <p class="amazing-offer-center">
                        <a href="/amazing-offer">
                        <img class="amazing-offer-image" style="width: <?= $res_imageWidth ?>" src="/catalog/__image/<?= $res_amazingOfferFileName ?>" alt="Amazing Offer Email Photo" />
                        </a>
                    </p>
                    <img style="width: 10%; opacity: .5; position: absolute; bottom: 30px; right: 30px; <?= $res_amazingOfferSigInvert ?>" src="/view/image/logo_fullsize.png" />
                  </div>
              

                </div>
            </article>

            <?= $polarized_html ?>

            <article id="rewards" class="mt-32">
                <div class="grid-4_sm-2 grid-4_md-3">
                    <div class="most-popular--title col-12">
                    <h2 class="uppercase ">YOUR REWARDS = <?= $myrewards_points ?> POINTS</h2>
                    <p><b>As a collector you are enrolled in our rewards program and it's pretty simple.</b></p>
                    <p class="mt-8">To get started share our website with your family and friends, and if they purchase a Limited Edition Fine Art Photograph, we will send you a tinyViews&trade; of your choice. You also receive points, and once you reach 2,500 points you're getting a free 16x20 Limited Edition of your selection. <u>Simply share this promo-code: <?= strtoupper($res_first_name) ?><?= $res_collector_id ?>,</u> and your friends and family will use this code when placing their fine art ordering either online, by phone or email and they will also receive a 15% #itswhoyouknow discount.</p>
                    </div>
                    
                    <div class="col-12">

                        <div id="form_referrCollectorForm_container">
                            <p class="blue"><?= strtoupper($subTitle); ?></p>
                            <h1 class="pb-16"><?= $formTitle ?></h1>
                              
                            <form id="referrCollectorForm" action="/view/ajax_email_process.php" method="POST">
                            <input type="hidden" id="formType" name="formType" value="referrCollectorForm" />
                            <input type="hidden" id="referred_by" name="referred_by" value="<?= $res_first_name ?> <?= $res_last_name ?>" />
                            <input type="hidden" id="referred_by_email" name="referred_by_email" value="<?= $res_email ?>" />
                            <input type="hidden" id="promo_code" name="promo_code" value="<?= strtoupper($res_first_name) ?><?= $res_collector_id ?>" />
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
                            <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />

                            <div>
                            <label for="edition-style">FRIEND'S NAME</label>
                            <input class="third-size" maxlength="255" type="text" id="ref_name" name="ref_name" placeholder="FRIEND'S NAME (eg, JESSIE JAMES)" /">
                            <label for="edition-style">FRIEND'S EMAIL</label>
                            <input class="third-size" maxlength="255" type="text" id="ref_email" name="ref_email" placeholder="FRIEND'S EMAIL (eg, jessiejames@yahoo.com)" />
                            <button class="button-inv" id="sendrederral" style="padding:13px; margin-left: 10px;">SEND PROMO CODE</button>
                            <p class="small">*The information supplied above is not saved and private to your session. However, your browser may remember previous form values.</p>
                            </div>
                            </form>
                        </div>

                        <p id="form_response" class="mt-16"> </p>

                    </div>

                </div>
            </article>

            <article id="version">
                <p class="tiny">v1.0.1586970407</p>
           </article>
           <!--  <article id="stayintouch">
                <div class="grid-4_sm-2 grid-4_md-3">
                    <div class="most-popular--title col-12">
                    <h2 class="uppercase ">PRIORITY ORDERING, OR JUST SAY HI</h2>
                    <p>The easiest way to order more j.McCarthy fine art is to write us a message below with the title and size of the photograph you are interested in acquiring for your collection.</p>
                    </div>
                        <div class="col-12">

                        <p class="blue"><?= strtoupper($subTitle); ?></p>
                        <h1 class="pb-16"><?= $formTitle ?></h1>

                        <form id="contactForm" action="/view/ajax_email_process.php" method="POST">
                        <input type="hidden" id="formType" name="formType" value="ContactForm" />
                        <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
                        <input name="name" type="hidden" value="<?= $res_first_name ?> <?= $res_last_name ?>" />
                        <input name="email" type="hidden" value="<?= $res_email ?>" />
                        <input name="subject" type="hidden" value="COLLECTOR(<?= $res_last_name ?>) DASHBOARD EMAIL" />

                        <div>
                            <label for="message">MESSAGE</label>
                            <textarea id="comments" name="comments" placeholder="WRITE YOUR MESSAGE IN THIS SPACE" rows="8"></textarea>
                        </div>


                        <button class="button-inv" id="sendform">SEND MESSAGE</button>
                        </form>

                        <p id="form_response" class="mt-16"> </p>


                        </div>
                </div>
            </article> -->

        </div>

    </div>
</section>

<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

    $('#note-close').on("click", function() {
        console.log('hideme');
        $('.note-from-artist').slideUp("slow");
        $('.whoami').show();
        $('html,body').animate({ scrollTop: 0 }, "slow");
    });

      $('#referrCollectorForm').submit(function() {

        console.log('start.form.referrCollectorForm.submission');

        grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              console.log('grecaptcha.ready');
        });

            event.preventDefault();
            console.log('Sending... ' + $('#g-recaptcha-response').val());

              var url = "/view/ajax_email_process.php";

              grecaptcha.ready(function() {

                  grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
                    $.ajax({
                      type: "POST",
                      url: url,
                      data: $("#referrCollectorForm").serialize(),
                      async: true,
                      success: function(data)
                      {
                          
                          var data_html = "Thank You For Your Referral!";
                        //   $('#form_referrCollectorForm_container').prop('disabled', true).css('opacity','.1');
                          $('#form_referrCollectorForm_container').hide();
                        //   $('#sendform').hide();
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
