<script src="https://www.google.com/recaptcha/api.js?render=6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh"></script>
<link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap" rel="stylesheet">

<section class="collector--section">
    <div class="grid-center">

        <div class="col collector--main_container">
            <?= $mycollection_html ?>
            <?= $note_html ?>
            <!-- 
            <?= $myrewards_html ?>
            <?= $amazingoffer_html ?>
            <?= $polarized_html ?> -->

        </div>
        
    </div>
    
    <div class="grid">
        <div class="col signout">
             <p class="">SAVE 25% ON YOUR NEXT FINE-ART PURCHASE WTH PROMO-CODE: <b>COLLECT1MORE</b> AT CHECKOUT / <a id="myaccount" href="">change PIN</a> / <a href="/d/collector/signout?ref=collector">sign out</a></p>
             <p class="tiny">*Only valid for existing collectors, limit 1 per collector.</p>
        </div>
    </div>
        <?= $myaccount_html ?>
</section>

<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

    if(getCookie('collector_note') == "CLOSE") {
        $('.note-from-artist').hide();
    } else {
        $('.note-from-artist').show();

    }
    
    $('#myaccount, .close-myaccount').on("click", function(e) {
        e.preventDefault();
        $('#my-account').toggle();
    });
    
    $('.provenance, .provenance--close').on("click", function(e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $('#' + id).toggle();
        $('.provenance--close').toggle();
    });

    $('#note-close').on("click", function() {
        console.log('hiding-note');
        $('.note-from-artist').slideUp("slow");
        $('.whoami').show();
        $('html,body').animate({ scrollTop: 0 }, "slow");

        let var_collector_note = 'CLOSE';

        if(getCookie('collector_note') == false) {
          setCookie('collector_note',var_collector_note,'1');
          console.log('cookie.Set(' + var_collector_note + ')');
        } 

    });

    $('#referrCollectorForm').submit(function() {

        console.log('start.form.referrCollectorForm.submission');

        grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              console.log('grecaptcha.ready');
        });

            event.preventDefault();

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

        $('#collector-account').submit(function() {

        console.log('start.form.AccountSettings.submission');

        grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
              document.getElementById('g-recaptcha-response').value = token;
              console.log('grecaptcha.ready');
        });

            event.preventDefault();

              var url = "/view/ajax_collector_account_process.php";

              grecaptcha.ready(function() {

                  grecaptcha.execute('6LetD7YUAAAAAFX5cXupV3exd1YCSuYFY_az92Wh', {action: 'homepage'}).then(function(token) {
                    $.ajax({
                      type: "POST",
                      url: url,
                      data: $("#collector-account").serialize(),
                      async: true,
                      success: function(data)
                      {
                          console.log(data);
                          if(data == 200) {
                          var data_html = "Your PIN Has Been Successfully Changed - Please Don't Forget It";
                          $('.form_response').removeClass('error');
                          $('.form_response').html(data_html).addClass('success').show().delay('5000').slideUp("slow")
                          $('#pin, #pin_check, #pin_btn').attr('disabled','disabled').addClass('disabled-ele');
                          $('#pin_btn').addClass('disabled-ele');
                          $('.tryagain').show();
                          } else {
                          var data_html = "We Are Sorry There Was A Problem Changing Your PIN - Contact Support";
                          $('.form_response').removeClass('success');
                          $('.form_response').html(data_html).addClass('error').show().delay('5000').slideUp("slow")
                          }
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

    function setCookie(cname, cvalue, exdays) {
    // console.log('Setting-Cookie ' + cname)
      var d = new Date();
      if(exdays != '0') {
          d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
          var expires = "expires="+d.toUTCString();
      } else {
          var expires = null; 
      }

      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }

</script>
