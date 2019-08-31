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

$hero_title = 'MOUNTAINS, DESERTS & TREES';
$hero_link = '/mountains-deserts-trees';

$html = <<< END
<article>
    <div class="grid-1" style="margin: 0;">
        <div class="col home-hero">
            <div class="hero-text-container">
                <p class="hero-text"> $hero_title </p>
                <p><a href="$hero-link">Explore This Collection</a></p>
            </div>
        </div>
    </div>
</article>
END;

return($html);

?>