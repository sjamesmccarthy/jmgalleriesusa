 <?php
/* 
component: HERO 
description: returns the image and title +link for the homepage hero
css: component_hero.scss
data: null
created: jmccarthy
date: 8/29/19
version: 1
*/

$catalog = ltrim($this->page->catalog_path, '/');

if ($catalog == '') {
    /* Create an API call to get the Polarized listings */
    $hero_result = $this->api_Hero_Get_Image();

    $html = <<< END
        <div class="noshow" style="text-align: center;">
            <p style="display: inline-block; font-size: 1rem; background-color: #FFF; padding: 16px;text-align: center;">
            <a href="/polarized">POLARIZED</a> /
            <a href="/all">THE WORK</a>
        </div>

        <div id="hero" data-url="$this->hero_image" style="box-shadow: 0px 20px 25px 0px rgba(0, 0, 0, 0.3);">
                
                <div class="hero-container">
                    <div class="hero-text-container">

                    <p class="topnav-logo">
                        <!-- logo_fullsize.png, style="margin-left: 10px;" -->
                        <img class="topnav--logo-img logo-white logo-large" src="/view/image/signature_full-web.png" alt="jm Galleries logo" \>
                    </p>

                    <p class="hero-text"><a href="$this->hero_link">$this->hero_title</a></p>
                    <!-- <p class="hero-text-explore-link-btn"><a href="$this->hero_link">Explore This Collection</a></p> -->
                    <!-- <p class="hero-text-arrow"><a href="$this->hero_link"><img class="hero-down-arrow" src="/view/image/icon_down.svg" /></a></p> -->
                    
                    <p class="sub-nav-border"></p>
                    
                    <p class="sub-nav-items">
                        <a  href="/polarized">Read My Field Notes </a> /  <a href="https://vlog.jmgalleries.com">Watch My vlog @YouTube</a>
                    </p>
                    
                    </div>
                </div>
        </div>
        
    <script>

        $("#hero").each( function() { 
            $(this).css("background-image", "url(/catalog/__image/" + $(this).data("url") +")" ); 
            $(this).css("background-postion", "$this->hero_position");
        });

    </script>
    END;
}

return($html);

?>