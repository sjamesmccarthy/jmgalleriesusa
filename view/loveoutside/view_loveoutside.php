<link href="https://fonts.googleapis.com/css2?family=Beth+Ellen&display=swap" rel="stylesheet">

<section id="loveoutside">

    <div class="grid-center">
        <div class="col-10">
            
        <div class="photo-collage">
            <img src="/view/__image/loveoutside-badge-<?= $badge ?>.png" alt="loveoutside logo 1" class="home-stamp" />

            <img src="/view/__catalog/__image/big-sky.jpg" alt="loveoutside cover photo" class="home-banner-layer-1" />

            <img src="/view/__catalog/__image/bonsai-zen.jpg" alt="loveoutside cover photo" class="home-banner-layer-2" /> 
            
            <img src="/view/__catalog/__image/chasing-autumn.jpg" alt="loveoutside cover photo" class="home-banner-layer-3" />
        </div>  
            
        <h2 class="home-title">loveOutside.<span>rg</span></h2>
        <p class="larger color-blue">loveOutside.org is an upcoming collaborative group of outdoor enthusiasts +photographers preserving the world around us through creative, every-day imagery while encouraging and leading "<a target="_new" href="https://www.nps.gov/articles/leave-no-trace-seven-principles.htm">leave no trace</a>" principals to protect our bonus backyard; the outdoors.</p>

        <div class="divider pt-32"></div>

        <!-- <h3>The Carson/Tahoe Group</h3> -->
        <!-- <p>As well as Reno, Sparks, Gardnerville, Minden, Dayton, Incline Village and other surrounding communities. </p> -->
        <!-- <p>Currently meeting every other month in one of the surrounding communities to discuss all things outdoors and photography as well as go on a short outdoor +photography related field-trip in the area.</p> -->
        
        <!-- <p>Next meeting is Saturday, June 25 in Carson City at Comma Coffee around 10am. We will meet up for an intro to the group and who we are, then will be taking a short field-trip up <a target="_new" href="https://visitcarsoncity.com/attractions/prison-hill-north-loop-trail/">Prison Hill - West Loop (click here for more information)</a> for some amazing vistas of the Carson Valley. <i>If you're interested, just show up, and, like the sunshine everything is free &mdash; except for the delicious Comma Coffee edibles.</i></p> -->

        <!-- <p>Our Q2 conservation goal is trail trash clean-up along the Carson river from Buzzy's Ranch Trailhead (Carson River Park)  north along the Carson River to where it intersects with the Mexican Ditch Trail at the golfcourse. Join us on Saturday, June 25 at 9AM at the Carson River Park Parking lot. Please bring your supplies to pick up trash. It should be an easy walk for about 2 hours. Even though we will be picking up trash don't forget your camera - spring has sprung along the river!</p> -->

        <!-- <h3 class="pt-32">Start Your Own Group</h3> -->
        <!-- <p>If you have more than 5 people interested in the outdoors +photography whom are also passionate about community in their area <a href="/contact">drop me a note</a> to learn how you can create your loveOutside.Org group and be listed in the upcoming directory.</p> -->

        <h3 class="nomar-top mb-16 text-center">Sign Up For The First Friday Email To Be Notified About Upcoming Events</h3>
        <div class="text-center">

        <?php 
            $this->getPartial('newsletter'); 
        ?>

        </div>

        <p class="mt-32 text-center">
        <a target="_new" class="mr-16 blue" style="font-size: 1.5rem" href="http://twitter.com/loveoutsideorg"><i class="fab fa-twitter"></i></a>
        </p>

        </div>
    </div>
</section>
