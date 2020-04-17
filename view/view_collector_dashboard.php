<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>
<link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap" rel="stylesheet">

<section class="collector--section">
    <div class="grid-12">

        <div class="col-12 collector--main_container">

           <div class="signout">
               <p><span class="whoami"><?= $res_first_name ?> <?= $res_last_name ?> &mdash; </span><a href="/d/collector/signout?ref=collector">sign out</a></p>
            </div>

            <article class="note-from-artist">
                    <p>
                        Hello <?= $res_first_name ?> <?= $res_last_name ?>,<br /><br />Thank you for being a collector of j.McCarthy Fine Art. I am grateful for your support and continued loyalty, and hope that you have found the perfect place in your home or office for your fine art purchase.<br /><br />This collector portal is where you can easily manage your collection, earn rewards for referring family and friends and discover some amazing offers and new Limited Edition releases that I have curated just for my collectors. If you have any questions about your artwork or would like to inquire about new artwork, please <a href="/contact">contact</a> me.
                   </p>

                   <p style="text-align: right">Cheers, <br /><img src="/view/image/signature_full-web.png"></p>

                    <div id="note-close" style="text-align: right"><i class="fas fa-times-circle"></i></div>
            </article>

            <?= $mycollection_html ?>
            <?= $myrewards_html ?>
            <?= $amazingoffer_html ?>
            <?= $polarized_html ?>

            <article id="version">
                <p class="tiny">v1.0.1587154706</p>
           </article>

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
