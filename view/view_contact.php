
<section id="contact">
    <div class="grid-center">

        <div class="col-9">

            <h1><?= $this->title ?></h1>

<script>

  jQuery(document).ready(function($){

    $('input:text, textarea').bind('focus', function() {
        $(this).toggleClass('form-focus');
        $('label').addClass('label-focus');
    });

  });

  function onSubmit(token) {
     // alert('thanks ' + document.getElementById('name').value);
   }

   function validate(event) {
     event.preventDefault();
     if (!document.getElementById('name').value || !document.getElementById('contactinfo').value) {
       alert("You must add text to the required fields");
     } else {
       grecaptcha.execute();
         var url = "/ajax_process.php";
         // the script where you handle the form input.

         console.log('sending...');
           $.ajax({
                  type: "POST",
                  url: url,
                  data: $("#contactForm").serialize(),
                  // serializes the form's elements.
                  async: true,
                  success: function(data)
                  {
                      $('#contactForm').hide();
                      $('#form_response').html("Thank You For Your Message, an art consultant will be in touch in 48 hours.").addClass('success').show();
                   //    $('#requestQuote').fadeOut();

                  }
                });
           return false;
     }
   }

   function onload() {
     var element = document.getElementById('submit');
     element.onclick = validate;
   }

</script>

        <form id="contactForm" action="#" method="post">

        <p>
        <label class="" for="name">First and Last Name</label>
        <input type="text" id="name" name="name" placeholder="First and Last Name" value="" required>
        </p>

        <p>
        <label class="" for="contactinfo">Email Address or Phone Number</label>
        <input type="text" id="contactinfo" name="contactinfo" placeholder="Your Email or Phone Number" value="" required>
        </p>

        <label>I am interested in ...</label>
        <ul class="contact-form-interest-list pt-24">
        <li><input name="interest" type="radio" value="Buying A Print"> Buying Your Amazing Artwork <b><?= $referringPhoto ?></b></li>
        <li><input name="interest" type="radio" value="Commissioning Request"> Commissioning Your Out-of-This-World Talent</li>
        <li><input name="interest" type="radio" value="General Comments, Other"> Licensing, Customer Service, or something else</li>
        </ul>

        <input name="refer" type="hidden" value="<?= $print_name ?>" />
        <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
        </p>

        <p style="margin-top: 20px;">
        <label class="" for="comments">Type Your Message Here</label>
        <textarea id="comments" name="comments" placeholder="Tell us how we can help you here, or a good joke." rows="8" style="height: 200px; padding-top: 30px;" required><?= $referringPhotoCommentsField ?></textarea>
        </p>

        <div class="g-recaptcha"
          data-sitekey="6Lem3V0UAAAAAJQyKvI6lkyRHZJstUt44YYq0TQ4"
          data-callback="onSubmit"
          data-size="invisible"
          data-badge="bottomright">
        </div>

        <button id="submit">SUBMIT YOUR FEEDBACK</button>
        </form>

        <script>onload();</script>

        <p id="form_response"> </p>


        </div>


    </div>
</section>
