<section class="admin--section">
    <div class="grid-12">
        
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 admin--main_container">

            <!-- quickstats -->
            <?= $quickstats_html ?>

            <div class="grid mt-40">
                <div class="col" style="padding-right: 16px;">
                    <!-- recentactivity -->
                     <?= $activity_html ?>
                </div>
                <div class="col-1 divider"></div>
                <div class="col">
                    <!-- photosviewed -->
                    <?= $photosviewed_html ?>
                </div>
            </div>

        </div>

    </div>
</section>