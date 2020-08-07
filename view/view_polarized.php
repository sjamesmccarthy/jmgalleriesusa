<section id="polarized" class="pt-24">
    <div class="grid-noGutter-center">

        <div class="col-8 __container">

            <h1>Polarized</h1>
            <p class="pb-32 blue" style="margin-top: -10px">a Collection of fieldnotes by Photogrpaher j.McCarthy</p>

            <?= $card_html ?>
            <div style="margin-bottom: 1rem; text-transform: uppercase; font-weight: 800;">Some older FIELD NOTES and other thoughts</div>
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
            $('#' + ele).css("border-bottom", "1px solid #FFF").css("padding-bottom","1rem");
        } else {
            $("div[id*='imgT']").css("border","none");
            $('#' + ele).css("border-bottom", "1px solid #FFF").css("padding-bottom","1rem");
            $(".filmstrip--large-preview").slideDown();
        }
        
        // $(".filmstrip--large-preview").toggle();
        $("div[id*='img_']").hide();
        $(".filmstrip--large-preview").show();
        $("div #img_" + $(this).attr("data-file") + "_expanded").show();
    });

    $(".close_filmstrip").on("click", function(e) {
        console.log( $(".close_filmstrip").attr("data-filmstrip") );
        $(".filmstrip--large-preview").slideUp();
    });

});
</script>