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
        <div style="text-align: center;">

            <p style="display: inline-block; font-size: 1rem; background-color: #FFF; padding: 16px;text-align: center;">
            <a href="/polarized">POLARIZED</a> /
            <a href="/all">THE WORK</a>
        </div>

        <div id="hero" data-url="$this->hero_image" style="box-shadow: 0px 20px 25px 0px rgba(0, 0, 0, 0.3);">
                <div class="hero-text-container">
                    <div style="position:absolute; bottom: 25%; width: 100%; left: 0;">

                    <p class="topnav-logo">
                        <img style="margin-left: 10px;" class="topnav--logo-img logo-white logo-large" src="/view/image/logo_fullsize.png" alt="jm Galleries logo" \>
                    </p>

                    <p class="hero-text"><a href="$this->hero_link">$this->hero_title</a></p>
                    <p class="hero-text-explore-link-btn"><a href="$this->hero_link">Explore This Collection</a></p>
                    <!-- <p class="hero-text-arrow"><a href="$this->hero_link"><img class="hero-down-arrow" src="/view/image/icon_down.svg" /></a></p> -->
                    </div>
                </div>
        </div>

        <!-- linear-gradient(rgba(255,255,255,.5) 0%, rgba(117,117,119,0) 50%),  -->
    <script>

        $("#hero").each( function() { 
            $(this).css("background-image", "url(/catalog/__image/" + $(this).data("url") +")" ); 
            $(this).css("background-postion", "$this->hero_position");
        });

    </script>
    END;
} else {
    $html = <<< END
        <!-- <div id="hero-catalog">
        </div> -->
    END;

}

return($html);

?>