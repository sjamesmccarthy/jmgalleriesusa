<section class="admin--section">
    <div class="grid-12">
        
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 admin--main_container">

            <!-- <article id="welcome_msg"> -->
                <h1><?= $first_name ?>, here is your dashboard.</h1>
            <!-- </article> -->


            <div class="grid">

                <div class="col-12">
                    <!-- quickstats -->
                    <?= $quickstats_html ?>
               </div>

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