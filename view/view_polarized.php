<section id="polarized_idx">
    <div class="grid">

        <div class="col-12_sm-12 __container text-center">
            <!-- <h1>Polarized</h1> -->
            <p class="tagline">a Collection of <b>Field Notes</b> by Photographer j.McCarthy</p>
            
            <ul class="filter-editions-list">
                <li class="filter-all selected">All</li>
                <li class="filter-notes">Articles</li>
                <li class="filter-youtube">Videos</li>
                <li class="filter-filmstrips">Filmstrips</li>
            </ul>
            
        </div>

        <div class="col-10_sm-12" style="margin: auto;">
            <!-- col-8_sm-12 when including FINDUS below -->
                <?= $card_html ?>
        </div>
        
        <!-- <div class="col-4_sm-hidden pl-32">
                <?php 
                    // $this->getPartial('findus'); 
                ?>
        </div> -->
        
        <div class="col-10_sm-12 newsletter-section-fn" style="margin: auto;">
            <h3>SUBSCRIBE TO MY MONTHLY NEWSLETTER</h3>
            <?php $this->getPartial('newsletter'); ?>
        </div>
           
    </div>
</section>

<script>
    jQuery(document).ready(function($){
        
        setTimeout(function() {
           $('.filter-youtube').trigger("click");
         }, 10);
       
    
        <?php if($_REQUEST['filter'] == "videos") { ?>
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-youtube"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-youtube').show();
        <?php } ?>
        
        <?php if($_REQUEST['filter'] == "filmstrips") { ?>
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-filmstrips"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-filmstrips').show();
        <?php } ?>
        
        <?php if($_REQUEST['filter'] == "articles") { ?>
        $('[class*="filter-"]').removeClass("selected");
        $('[class*="filter-notes"]').addClass("selected");
        $('[class*="f-"]').hide();
        $('.f-notes').show();
        <?php } ?>
        
        $('.filter-all').click(function() {
            $('[class*="filter-"]').removeClass("selected");
            $('[class*="filter-all"]').addClass("selected");
            $('[class*="f-"]').show();
        });
        
        $('.filter-notes').click(function() {
            $('[class*="filter-"]').removeClass("selected");
            $('[class*="filter-notes"]').addClass("selected");
            $('[class*="f-"]').hide();
            $('.f-notes').show();
        });
    
        $('.filter-youtube').click(function() {
            $('[class*="filter-"]').removeClass("selected");
            $('[class*="filter-youtube"]').addClass("selected");
            $('[class*="f-"]').hide();
            $('.f-youtube').show();
        });
        
        $('.filter-filmstrips').click(function() {
            $('[class*="filter-"]').removeClass("selected");
            $('[class*="filter-filmstrips"]').addClass("selected");
            $('[class*="f-"]').hide();
            $('.f-filmstrips').show();
        });

    });
    </script>