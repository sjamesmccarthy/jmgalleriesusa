<section class="admin--section">
    <div class="grid-">
        
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col admin--main_container">

             <div class="pt-40 pb-40">
                 <!-- <p><?= $today ?></p> -->
                 <h1 style="font-weight: 400">Hello <?= $first_name ?>,  here is your studio.</h1>
             </div>
             

            <div class="grid">

                <div class="col">
                    <!-- quickstats -->
                    <div style="display:none;">
                        <?= $quickstats_html ?>
                    </div>
               </div>
            </div>
            
            <div class="grid">

                <div class="col">
                    <!-- quickstats -->
                    <?= $orders_html ?>
               </div>
            </div>

            <div class="grid">
                <div class="col ">
                    <!-- photosviewed -->
                    <?= $photosviewed_html ?>
                </div>
            </div>
            
            <div class="grid">
                <div class="col ">
                    <!-- photosviewed -->
                    <?= $reports_html ?>
                </div>
            </div>
            
            <div class="grid">
                <div class="col">
                    <!-- recentactivity -->
                     <?= $activity_html ?>
                </div>
                <!-- <div class="col-1 divider"></div> -->
            </div>

        </div>

    </div>
</section>