<section class="admin--section">
    <div class="grid-">
        
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col admin--main_container">

            <!-- <h1><?= $first_name ?>, here is your dashboard.</h1> -->

            <div class="grid">

                <div class="col">
                    <!-- quickstats -->
                    <?= $quickstats_html ?>
               </div>
            </div>

            <div class="grid">
                <div class="col ">
                    <!-- photosviewed -->
                    <?= $photosviewed_html ?>
                </div>
                <div class="col">
                    <!-- recentactivity -->
                     <?= $activity_html ?>
                </div>
                <!-- <div class="col-1 divider"></div> -->
            </div>

        </div>

    </div>
</section>