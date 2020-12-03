<section id="polarized_idx">
    <div class="grid-center">

        <div class="col-12_sm-12 __container">

            <!-- <h1>JOURNAL</h1> -->
            <h4 class="subtitle blue center pt-48">a Collection of Field Notes by Photographer j.McCarthy</h4>

            <!-- START_CARDS -->
            <div class="--card_layout">
                
                <?= $card_html ?>
            
            </div>
            <!-- /START_CARDS -->

            <div class="mt-32" style="margin-bottom: 1rem; text-transform: uppercase; font-weight: 800;">Some older Field Notes ... </div>
            <ul>
                <?= $card_older_html ?>
            </ul>
           
        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){
    $("div[id*='imgT']").on('click', function(e){
        var ele = "imgT_" + $(this).attr("data-file");
        console.log("clicked: " + ele );

        if( $('.filmstrip--large-preview').is(':visible') ) { 
            console.log(".filmstrip--preview visible");
            $("div[id*='imgT']").css("border","none");
            $('#content--teaser').hide();
            $('#' + ele).css("border-bottom", "1px solid #CCC").css("padding-bottom",".5rem").css("margin-bottom","1rem");
        } else {
            $("div[id*='imgT']").css("border","none");
            $('#content--teaser').hide();
            $('#' + ele).css("border-bottom", "1px solid #CCC").css("padding-bottom",".5rem").css("margin-bottom","1rem");
            $(".filmstrip--large-preview").slideDown();
        }
        
        // $(".filmstrip--large-preview").toggle();
        $('#content--teaser').hide();
        $("div[id*='img_']").hide();
        $(".filmstrip--large-preview").show();
        $("div #img_" + $(this).attr("data-file") + "_expanded").show();
    });

    $(".close_filmstrip").on("click", function(e) {
        console.log( $(".close_filmstrip").attr("data-filmstrip") );
        $("div[id*='imgT']").css("border","none").css("padding-bottom","0").css("margin-bottom","0");
        $(".filmstrip--large-preview").slideUp();
        $('#content--teaser').show();
    });

});
</script>