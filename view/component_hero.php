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
        <div id="hero" data-url="$this->hero_image">
                <div class="hero-text-container">
                    <p class="hero-text-explore-link"><a href="$this->hero_link">Explore This Collection</a></p>
                    <p class="hero-text"><a href="$this->hero_link">$this->hero_title</a></p>
                    <p class="hero-text-arrow"><a href="$this->hero_link"><img class="hero-down-arrow" src="/view/image/icon_down.svg" /></a></p>
                </div>
        </div>

    <script>

        $("#hero").each( function() { 
            $(this).css("background-image", "linear-gradient(rgba(255,255,255,.5) 0%, rgba(117,117,119,0) 50%), url(/catalog/__image/" + $(this).data("url") +")" ); 
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