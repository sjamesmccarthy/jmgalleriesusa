<section id="footer">
    
    <!-- <div class="thin-line"></div> -->
    
    <div class="pt-32 pb-32 footer-max-width">
    
        
            <?php 
                $this->getPartial('newsletter'); 
            ?>
        
        <div class="grid nopad-left">

            <div class="col-12 collection-list">
            <ul>
                <?= $collections_html ?>
                <li><a href="/all">View All</a></li>
                <li>&mdash;</li>
                <li><a href="/styles">Frames & Pricing</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
            </div>
          
         </div>

         <div class="grid-center">

                <div class="col-7 breadcrumb">
                <p><a href="/"><img class="breadcrumb-logo" src="/view/image/logo_fullsize.png" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /><?= $this->page->title ?> </p>
                </div>
                <div class="col-5-right breadcrumb">
                <p class="pull-right text-right"><?= $this->config->copyright ?><br /> <a href="/release-notes">Made With &#10084; in Las Vegas</a> | <a href="/privacy">Privacy Policy</a></p>
                </div>

        </div>

    </div>

    <!-- <?= $env ?> -->
    <?= $cookie_consent ?>

</section>


<script>
jQuery(document).ready(function($){

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