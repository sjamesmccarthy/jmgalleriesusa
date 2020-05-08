<section class="admin--section">
    <div class="grid-12">
        
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 admin--main_container pt-32">

            <!-- quickstats -->
            <?= $quickstats_html ?>

            <div class="grid pt-32 nopad-left pb-32">
                <div class="col nopad-left">
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