<section id="polarized_idx">
    <div class="grid">

        <div class="col-12_sm-12 __container">
            <!-- <h1>Polarized</h1> -->
            <p class="tagline">a Collection of <b>Field Notes</b> by Photographer j.McCarthy</p>
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