
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<section id="product_detail">
    <form id="product" action="/checkout" method="post">
    <?= $hidden_felds ?>

    <div class="grid">
        
        <?= $image_html ?>
        
        <div class="col-6_sm-12">
            <h1><?= $res_title ?></h1>
            <?= $price_html ?>
            <?= $options_quantity_html ?>
            
            <div class="--desc">
                <p><?= $res_desc ?></p>
                <?= $res_details_html ?>
            </div>

            <?= $free_ship ?>
            <?= $options_html ?>

            <button class="buy_btn">Buy Now</button>
        </div>

    </div>
        
    </form>
</section>

<!-- generated html from component file: component_most_popular -->
<!-- removed 9/25/2020 -->
<section id="you-may-like" class="filmstrip mt-64">
    <?= $you_may_also_like_html ?>
</section> 
<!-- /generated html from component file -->

<script>
$(document).ready(function($){
    $('.slider').bxSlider( {
        controls:false,
        useCSS:false,
        responsive:true,
        slideWidth:600,
        mode:'fade',
        autoHover:true,
        auto:false,
        autoControls:true,
        // pause:3000,
        touchEnabled:true,
        hideControlOnEnd: true,
        infiniteLoop: true,
        pagerType: "full",
        pagerShortSeparator: "/",
        keyboardEnabled: "true"
    });
});
</script>