<section class="admin--section">
    <div class="grid-12">
        <div class="col-2 nav">
            
            <div class="toolbox">
                <div class="profile--image">
                    <img src="/view/image/profile_img.jpg" />
                </div>
                
                <div class="profile--name">
                    <p><?= $first_name ?> <?=$last_name ?></p>
                    <p>Member since <?= $year ?></p>
                    <p><?= $website ?></p>
                </div>

            </div>

            <div class="toolbox">
                <ul>
                <li><b><i class="fas fa-angle-double-right"></i> STUDIO DASHBOARD</b></li>
                <li><a href="/studio/catalog-idx">Online Catalog Index</a></li>
                <li><a href="/studio/catalog-add">Add a Photo To Online Catalog</a></li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li>Inventory Index</li>
                <li>Add a Photo To Inventory</li>
                <li>r/Art, Costs, PL (everything)</li>
                <li>r/Lookup Number & Edition</li>
                <li>r/Lookup By Location</li>
                <li>r/Damaged and Donated Summary</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li>Collector Index</li>
                <li>Add a Collector</li>
                <li>Create Certificate of Authenticity</li>
                <li>r/Find Collector By Name</li>
                <li>r/Find Collectors By Photograph</li>
                </ul>
            </div>

            <div class="toolbox">
                <ul>
                <li><a href="/studio/signout">Sign Out</a></li>
                </ul>
            </div>

        </div>
        <div class="col-1"></div>
    
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