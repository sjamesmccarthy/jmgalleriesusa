<section id="catalog" class="pb-32">
    <div class="grid-4_sm-2 grid-4_md-3">
        
        <div class="col-12 title pb-32 pt-32">
            <h2><?= strtoupper($catalog_title) ?></h2>
            <p><?= $catalog_desc ?></p>
            <ul class="editions-list">
                <li class="selected">All</li>
                <li>Gallery Edition</li>
                <li>Studio Edition</li>
                <li>Open Edition</li>
                <li>as tinyViews&trade; Edition</li>
            </ul>
        </div>

        <!-- generated html from component file -->
        <?= $thumb_html ?>
        <!-- /generated html from component file -->
  
    </div>
</section>