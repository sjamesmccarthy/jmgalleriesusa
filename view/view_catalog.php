<section id="catalog" class="pb-32">
    <div class="grid-4_sm-2 grid-4_md-3">
        
        <div class="col-12 title pb-32 pt-32">
            <h2><?= strtoupper($catalog_title) ?></h2>
            <p><?= $catalog_desc ?></p>
            <ul class="filter-editions-list">
                <li class="filter-all selected">All</li>
                <li class="filter-gallery">Gallery Edition</li>
                <li class="filter-studio">Studio Edition</li>
                <li class="filter-open">Open Edition</li>
                <li class="filter-tinyviews">as tinyViews&trade; Edition</li>
            </ul>
        </div>

        <!-- generated html from component file -->
        <?= $thumb_html ?>
        <!-- /generated html from component file -->
  
    </div>
</section>

<script>
jQuery(document).ready(function($){
    $('.filter-all').click(function() {
        console.log('filter-all.clicked');
        $('.filter-thumb-gallery').toggle();
    });
});
</script>
