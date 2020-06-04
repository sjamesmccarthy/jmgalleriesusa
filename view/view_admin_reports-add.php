<section class="admin--reports-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 reports-add--container">

            <div class="admin-header">
            <h2><?= $this->page->title ?></h2>
            </div>

            <!-- <h1><?= $formTitle ?></h1> -->

            <form id="reports-add" action="/studio/api/update/reports" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <label for="title">NAME</label>
                <input class="half-size" maxlength="255" type="text" id="name" name="name" placeholder="NAME (eg, ALL DONATED ARTWORK)" value="<?= $res_name ?>" required>
                <label for="edition-style">DESCRIPTION</label>
                <input class="half-size" maxlength="255" type="text" id="desc" name="desc" placeholder="DESCRIPTION (eg, Report showing all donated artwork to date)" value="<?= $res_desc ?>">
            </div>

            <div>
                <label for="sql_code">SQL</label>
                <textarea id="sql_c" name="sql_c"><?= $res_sql ?></textarea>
            </div>
            
            <div>
            <p class="pt-16">
          <input type="checkbox" id="fav" name="fav" value="1" <?= ($res_fav == "1" ? "CHECKED" : ""); ?> /> 
          <label for="fav" style="font-size: 1.2rem; background-color: transparent;">Favorite</label>
        </p>
            </div>

            <div class="clear">
                <button class="mt-32" id="sendform" value="SEND"><?= $button_label ?></button>
                <?= $button_archive_cancel ?>
            </div>

            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){
      
    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#sendform');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#suppliers-add').submit();               
          } 
        });
    });

    $('#archive').on("click", function(e) {
        e.preventDefault();
        alert('This Feature Not Available At This Time');
    });

});

</script>