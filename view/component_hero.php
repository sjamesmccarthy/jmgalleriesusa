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
            <a href="/fieldnotes">POLARIZED</a> /
            <a href="/all">THE WORK</a>
        </div>

        <div id="hero" data-url="$this->hero_image" style="box-shadow: 0px 20px 25px 0px rgba(0, 0, 0, 0.3);">
                
                <div class="hero-container">
                <div style="position: absolute; top: 5%; left: 5%;">
                    <p style="background-color: rgba(255,255,255,.2); padding: 2px 10px; font-size: .9rem;"><a style="color: #000;" href="$this->hero_link">EXPLORE THIS COLLECTION</a></p>
                </div>
                    <div class="hero-text-container">

                    <p class="topnav-logo">
                        <!-- logo_fullsize.png, style="margin-left: 10px;" -->
                        <a href="/about"><img class="topnav--logo-img logo-white logo-large" src="/view/image/signature_full-web.png" alt="jm Galleries logo" \></a><br />
                        <span style="font-size: 0.7rem;
                            position: absolute;
                            left: 30%;
                            bottom: 25%;">LIMITED EDITION  &copy; 2021</span>
                    </p>

                    <p class="hero-text hidden"><a href="$this->hero_link">$this->hero_title</a></p>
                    <!-- <p class="hero-text-explore-link-btn"><a href="$this->hero_link">Explore This Collection</a></p> -->
                    <!-- <p class="hero-text-arrow"><a href="$this->hero_link"><img class="hero-down-arrow" src="/view/image/icon_down.svg" /></a></p> -->
                    
                    <p class="sub-nav-border hidden"></p>
                    
                    <p class="sub-nav-items hidden">
                        <!-- <a  href="/fieldnotes">Read My Field Notes </a> /  <a href="https://vlog.jmgalleries.com">Watch My vlog @YouTube</a> -->
                        <a href="$this->hero_link" style="text-transform: uppercase;">Explore This Collection</a>
                    </p>
                    
                    </div>
                </div>
        </div>
        
    <script>

        $("#hero").each( function() { 
            $(this).css("background-image", "url(/catalog/__image/" + $(this).data("url") +")" ); 
            $(this).css("background-color", "#000");
            $(this).css("background-position", "center top");
        });

    </script>
    END;
}

return($html);

?>