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

if ($catalog == 'home') {
    /* Create an API call to get the Polarized listings */
    $hero_result = $this->api_Hero_Get_Image();
    // $hero_cta = '<a href="' . $this->hero_link . '">Explore More ' . $this->hero_collection . '</a></p>';

    if($this->hero_featured_contrast == "1") {
        $explore_background = 'rgba(0,0,0,.2)';
        $explore_background = '#2574A9';
        $logo_invert = "logo-dark";
        $this->color_text = "color-black"; 
    } else {
        $explore_background = 'rgba(255,255,255,.8)';
        $explore_background = '#2574A9';
        $logo_invert = "logo-white";
        $this->color_text = "color-white";
    }

    $hero_cta = '<a class="" href="' . $this->hero_link . '/' . $this->hero_link_image . '">' . strtoupper($this->hero_title) . '&mdash; </a> <a class="" href="' . $this->hero_link . '">' . $this->hero_collection . '</a></p>';

    $html = <<< END
        <div class="noshow" style="text-align: center;">
            <p style="display: inline-block; font-size: 1rem; background-color: #FFF; padding: 16px;text-align: center;">
            <a href="/shop">SHOP</a> /
            <a href="/thework">THE WORK</a>
        </div>

        <div id="hero" data-url="$this->hero_image" style="box-shadow: 0px 20px 25px 0px rgba(0, 0, 0, .3);">

                <div class="hero-container">
                <div class="hero-labelbox">
                    <p class="hero_cta" style="background-color: $explore_background">$hero_cta</p>
                </div>
                    <div class="hero-text-container">

                    <p class="topnav-logo">
                        <!-- logo_fullsize.png, style="margin-left: 10px;" -->
                        <a href="/about"><img class="topnav--logo-img $logo_invert logo-large" src="/view/__image/signature-fine-art-upscaled.png" alt="jm Galleries logo" \></a><br />
                        <span style="font-size: 0.7rem;
                            position: absolute;
                            left: 30%;
                            bottom: 25%;"
                            class="$this->color_text">LIMITED EDITION  &copy; 2022</span>
                    </p>

                    <p class="hero-text hidden"><a href="$this->hero_link">$this->hero_title</a></p>
                    <!-- <p class="hero-text-explore-link-btn"><a href="$this->hero_link">Explore This Collection</a></p> -->
                    <!-- <p class="hero-text-arrow"><a href="$this->hero_link"><img class="hero-down-arrow" src="/view/__image/icon_down.svg" /></a></p> -->

                    <p class="sub-nav-border hidden"></p>

                    <p class="sub-nav-items hidden">
                        <!-- <a  href="/fieldnotes">Read My Field Notes </a> /  <a href="https://vlog.jmgalleries.com">Watch My vlog @YouTube</a> -->
                        <!--  <a href="$this->hero_link" -->
                        <a href="/shop" style="text-transform: uppercase;">SHOP</a>
                    </p>

                    </div>
                </div>
        </div>

    <script>

        $("#hero").each( function() {
            $(this).css("background-image", "url(/view/__catalog/__image/" + $(this).data("url") +")" );
            $(this).css("background-color", "#000");
            $(this).css("background-position", "center center");
            $(this).css("background-size", "cover");
        });

    </script>
    END;
}

return($html);

?>