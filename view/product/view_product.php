
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script> -->

<link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>

<section id="product_detail">
    <form id="product" action="/checkout" method="post">
    <?= $hidden_felds ?>

    <div class="grid">
        <div class="col">
            <p class="small normal mb-32 mt-32 text-upper text-center"><a style="font-weight: 400" href="/shop">&#8592; Back To Shop</a></p>
        </div>
    </div>

    <div class="grid">

        <div class="col-6_sm-12">
            <?= $image_html ?>
        </div>
        
        <div class="col-6_sm-12">
            <h1><?= $res_title ?></h1>
            
            <div class="--desc">
                <!-- <p><?= $res_desc ?></p> -->
                <?= $res_details_html ?>
            </div>
            
            <div class="mt-32">
            <?= $price_html ?>
            <?= $options_quantity_html ?>

            <div>
                <?= $free_ship ?>
            </div>

            <?= $options_html ?>
            </div>

            <?= $buy_button ?>
        </div>

    </div>
        
    </form>
</section>

<section id="you-may-like" class="filmstrip mt-64">
    <?php
        // $you_may_also_like_html 
        // TODO: duplicate this component for the shop items insstead
    ?>
</section> 

<script>
    /* TODO: add thumbnail previews */

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