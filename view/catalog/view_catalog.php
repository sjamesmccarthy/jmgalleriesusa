<section id="catalog">
    <div class="grid-4_sm-2 grid-4_md-3">

        <div class="col-12 title pb-32">
            <h2><?= strtoupper($catalog_title) ?></h2>
            <p class="light --subhead pt-8"><?= $catalog_desc ?></p> 
            <!-- <?= $catalog_le_desc ?> -->
            <?php
                if($catalog_tabs_hidden != true) {
            ?>
            <ul class="filter-editions-list mt-32">
                <li class="filter-all">All</li>
                <li class="filter-gallery">Limited Ed.</li>
                <!-- <li class="filter-studio">Studio Edition</li> -->
                <li class="filter-open">Open Ed.</li>
            </ul>
            <?php } ?>
        </div>

        <!-- generated html from component file -->
            <?= $thumb_html ?>
        <!-- /generated html from component file -->

    </div>

    <div>
        <?= $tv_le_link; ?>
        <!-- <p class="shop-tv-link" style="text-transform: lowercase">or, <a href="/shop">Discover Other Fine-Art Products In Our Gallery Store</a></p> -->
    </div>

</section>

<script>
jQuery(document).ready(function($){

        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-gallery"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-gallery').show();

        <?php if($_REQUEST['filter'] == "tinyviews") { ?>
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-open"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-open').show();
        <?php } ?>

        <?php if($_REQUEST['filter'] == "limited") { ?>
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-gallery"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-gallery').show();
        <?php } ?>

    $('.filter-all').click(function() {
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-all"]').addClass("selected");
        $('[class*="f-"]').show();
    });
    $('.filter-gallery').click(function() {
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-gallery"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-gallery').show();
    });

    // $('.filter-studio').click(function() {
    //     $('[class*="filter-"]').removeClass("selected");
    //     $('[class*="filter-studio"]').addClass("selected");
    //     $('[class*="f-"]').hide();
    //     $('.f-studio').show();
    // });

    $('.filter-open').click(function() {
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-open"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-open').show();
    });
    // $('.filter-tinyviews').click(function() {
    //     $('[class*="filter-"]').removeClass("selected");
    //     $('[class*="filter-tinyviews"]').addClass("selected");
    //     $('[class*="f-"]').hide();
    //     $('.f-tinyviews').show();
    // });
});
</script>
