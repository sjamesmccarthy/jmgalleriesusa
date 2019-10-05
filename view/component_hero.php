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

/* Create an API call to get the Polarized listings */
$hero_result = $this->api_Hero_Get_Image();

$html = <<< END
<!-- <article> -->
    <!-- <div class="grid-1" style="margin: 0;"> -->
    <div id="hero" data-url="$this->hero_image">
            <div class="hero-text-container">
                <p class="hero-text"> $this->hero_title </p>
                <p class="hero-text-explore-link"><a href="$this->hero_link">Explore This Collection</a></p>
                <p class="hero-text-arrow"><img class="hero-down-arrow" src="/view/image/icon_down.svg" /></p>
            </div>
    </div>
    <!-- </div> -->
<!-- </article> -->

<script>

    $("#hero").each( function() { 
        $(this).css("background-image", "linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(117,117,119,0) 20%), url(/catalog/__image/" + $(this).data("url") +")" ); 
        $(this).css("background-postion", $this->hero_position);
    });

</script>

END;

return($html);

?>