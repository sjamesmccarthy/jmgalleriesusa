<section id="footer">
    
    <!-- <div class="thin-line"></div> -->
    
    <div class="pt-32 pb-32 footer-max-width">
        
        <div class="grid nopad-left hidden">

            <div class="col-12 collection-list">
            <ul>
                <?= $collections_html ?>
                <li><a href="/all">View All</a></li>
                <li>&mdash;</li>
                <li><a href="/styles">Frames & Pricing</a></li>
                <li><a href="/contact">Contact Us</a></li>
            </ul>
            </div>
          
         </div>

         <div class="grid-center-noGutter">

                <div class="col-7_sm-hidden_md-hidden breadcrumb" style="margin-top: 4px;">
                <p><a href="/"><img class="breadcrumb-logo" src="/view/image/logo_fullsize.png" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /><?= $this->page->title ?> </p>
                </div>

                <div class="col-5_sm-12 breadcrumb copyright">
                    <p><a href="/about"><?= $this->config->copyright ?></a> | <a href="/privacy">Privacy Policy</a> | <a class="theme-toggle"><i class="fas fa-adjust"></i></a></p>
                    <?php  $this->getPartial('newsletter'); ?>
                </div>

        </div>

    </div>

    <!-- <?= $env ?> -->
    <?= $cookie_consent ?>

</section>


<script>
jQuery(document).ready(function($){

// Select the button
const theme = document.querySelector(".theme-toggle");
// Select the theme preference from localStorage
const currentTheme = localStorage.getItem("theme");

// If the current theme in localStorage is "dark"...
if (currentTheme == "dark") {
  // ...then use the .dark-theme class
  document.body.classList.add("dark-theme");
}

// Listen for a click on the button 
theme.addEventListener("click", function() {
  // Toggle the .dark-theme class on each click
  document.body.classList.toggle("dark-theme");
  
  // Let's say the theme is equal to light
  let theme = "light";
  // If the body contains the .dark-theme class...
  if (document.body.classList.contains("dark-theme")) {
    // ...then let's make the theme dark
    theme = "dark";
  }
  // Then save the choice in localStorage
  localStorage.setItem("theme", theme);
});

    if(getCookie('cookie_consent') == "AGREED") {
        $('cookie_banner').hide();
    }
    
    $('#cookie_consent').on("click", function() {

        let var_cookie_consent = 'AGREED';

        if(getCookie('cookie_consent') == false) {
          setCookie('cookie_consent',var_cookie_consent,'30');
          console.log('cookie.Set(' + var_cookie_consent + ')');
          $('.cookie_banner').hide();
        } 

      });
    
  });

function setCookie(cname, cvalue, exdays) {
    console.log('SettingCookie.partial_footer: ' + cname);
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
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