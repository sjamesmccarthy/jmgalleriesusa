<section id="footer">
    
    <!-- <div class="thin-line"></div> -->
    
    <div class="pt-32 pb-32 footer-max-width">

                <div class="grid">
                    <div class="col-8_md-10 foot-news">
                    <?php 
                        $this->getPartial('newsletter'); 
                    ?>
                    </div>
                </div>
        
        <div class="grid">

            <div class="col-12_md-hidden collection-list">
            <ul>
                <?= $collections_html ?>
                <li><a href="/all">View All</a></li>
                <li>&mdash;</li>
                <li><a href="/styles">Pricing</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
            </div>

            <!-- <div class="grid">
                <div class="col-3 footer-column mb-32">
                    <h3>COLLECTIONS</h3>
                    <ul>
                        <?= $collections_html ?>
                        <li class="top-border"><a href="/all">View All</a></li>
                    </ul>
                </div>

                <div class="col footer-column">
                    <h3>EXPLORE</h3>
                    <ul>
                        <li><a href="/exhibits">Exhibits</a></li>
                        <li><a href="/styles">Editions & Framing</a></li>
                        <li><a href="/moments">Moments, News & Events</a></li>
                        <li><a target="_shop" href="/thestudio">The Studio</a></li>
                        <li><a target="_blog" href="https://medium.com/jmgalleriesusa">Polarized Quarterly</a></li>
                    </ul>
                </div>

                <div class="col footer-column">
                        <h3>SHOP</h3>
                            <ul>
                                <li><a target="_shop" href="/shop">tinyViews™</a></li>
                                <li><a href="/styles">Fine-Art Pricing</a></li>
                                <li><a href="/contact">Customer Service</a></li>
                            </ul>
                </div>

                <div class="col footer-column">
                    <h3>ABOUT</h3>
                        <ul>
                            <li><a href="/about">the Photographer</a></li>
                            <li><a href="/legal">Privacy Policy</a></li>
                            <li><a href="/contact">Contact Us</a></li>
                        </ul>
                </div>

            </div> -->
         </div>

         <div class="grid-center">

                <div class="col-6 breadcrumb">
                <p><a href="/"><img class="breadcrumb-logo" src="/view/image/logo_fullsize.png" /></a> <?= $bc_catalog ?> <img class="breadcrumb-arrow" src="/view/image/icon_navarrow-right.svg" /><?= $this->page->title ?> </p>
                </div>
                <div class="col-6-right breadcrumb">
                <p class="right"><?= $this->config->copyright ?><br /><a href="/privacy">Privacy Policy</a></p>
                </div>

        </div>

    </div>

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