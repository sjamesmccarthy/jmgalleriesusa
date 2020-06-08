<section class="admin--reports-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 reports-add--container">

            <div class="grid admin-header">
                <div class="col">
                    <h2><?= $this->page->title ?></h2>
                     <!-- <div class="tabs"> 
                        <div data-name="SQL" class="tab-menu tab-SQL active" style="border-bottom:3px solid #000">SQL</div>
                        <div data-name="RESULTS" class="tab-menu tab-RESULTS"><a href="/studio/reports">RESULTS</a></div>
                        <div ><a href="/studio/reports"><i class="fas fa-times-circle"></i></a></div>
                    </div> -->
                </div>
            </div>

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
                <p style="width:75%; float: left;">
                <label for="title">COLUMNS</label>
                <input class="" type="text" id="columns" name="columns" placeholder="COLUMNS (eg, id,firstname,lastname,email,phone)" value="<?= $res_columns ?>" />
                </p>

                <p class="pt-16" style="width: 24%; float:right; margin-left: 8px;">
                  <input type="checkbox" id="fav" name="fav" value="1" <?= ($res_fav == "1" ? "CHECKED" : ""); ?> /> 
                  <label for="fav" style="font-size: 1.2rem; background-color: transparent;">Mark As Favorite</label>
                </p>

            </div>

            <div>
                <label for="sql_code">SQL</label>
                <textarea id="sql_c" name="sql_c"><?= $res_sql ?></textarea>
            </div>
            
            <div>
                <p class="pt-16 half-size"></p>
                <div class="half-size"><p class="btn_small_gray pull-right ml-8 active">Edit SQL</p>
                <p class="btn_small_gray pull-right">Run Query</p></div>
            </div>

            <div class="clear">
                <button class="mt-32" id="sendform" value="SEND"><?= $button_label ?></button>
                <!-- <?= $button_archive_cancel ?> -->

                <p class="mt-8 small">*Saving the report will not run the query. It will return you back to the Reports Index.</p>
            </div>

            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){

   $('.tab-menu').on("click", function() {
       $('.tab-menu').removeClass("active");
       $('.tab-' + $(this).attr("data-name") ).addClass('active');
       console.log('changing tab active: ' + '.tab-' + $(this).attr("data-name"));
   });

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