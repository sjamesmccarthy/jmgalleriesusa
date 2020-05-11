<section id="catalog">
    <div class="grid-4_sm-2 grid-4_md-3">
        
        <div class="col-12 title pb-32">
            <h2><?= strtoupper($catalog_title) ?></h2>
            <p><?= $catalog_desc ?></p>
            <ul class="filter-editions-list">
                <li class="filter-all selected">All</li>
                <li class="filter-gallery">Limited Edition</li>
                <!-- <li class="filter-studio">Studio Edition</li> -->
                <li class="filter-open">tinyViews&trade; Edition</li>
                <!-- <li class="filter-tinyviews">tinyViews&trade; Edition</li> -->
            </ul>
        </div>

        <!-- generated html from component file -->
            <?= $thumb_html ?>
        <!-- /generated html from component file -->
  
    </div>
</section>

<script>
jQuery(document).ready(function($){

        <?php if($_REQUEST['filter'] == "tinyviews") { ?>
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-open"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-open').show();
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
