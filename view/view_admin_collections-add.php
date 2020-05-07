<section class="admin--collections-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 collections-add--container">

            <h2 class="pb-32 pt-32"><?= $this->page->title ?></h2>

            <h1><?= $formTitle ?></h1>

            <form id="reports-add" action="/studio/api/update/collections" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <input type="hidden" id="artist_id" name="artist_id" value="1" />

            <div>
                <label for="title">TITLE</label>
                <input class="half-size" maxlength="255" type="text" id="title" name="title" placeholder="TITLE (eg, Black And White)" value="<?= $res_title ?>" required>
                <label for="edition-style">PATH (URI)</label>
                <input class="half-size" maxlength="255" type="text" id="path" name="path" placeholder="PATH (eg, black-and-white)" value="<?= $res_path ?>">
            </div>

            <div>
                <label for="desc">DESCRIPTION</label>
                <input maxlength="255" type="text" id="desc" name="desc" placeholder="DESC (eg, a Collection of Black and White Photography)" value="<?= $res_desc ?>" required>
            </div>

            <div>
                <div class="select-wrapper half-size" style="vertical-align: top">
                    <select id="status" name="status">
                    <!-- $var > 2 ? true : false -->
                        <option value="active" <?= ($res_status == "active" ? "SELECTED" : ""); ?>>STATUS (active)</option>
                        <option value="disabled" <?= ($res_status == "disabled" ? "SELECTED" : ""); ?>>STATUS (disabled)</option>
                    </select> 
                </div>
                <div class="select-wrapper half-size" style="vertical-align: top">
                <select id="type" name="type">
                <!-- $var > 2 ? true : false -->
                    <option value="collection" <?= ($res_type == "collection" ? "SELECTED" : ""); ?>>STATUS (collection)</option>
                    <option value="virtual" <?= ($res_type == "virtual" ? "SELECTED" : ""); ?>>STATUS (sql)</option>
                    <option value="virtual" <?= ($res_type == "sql" ? "SELECTED" : ""); ?>>STATUS (virtual)</option>
                </select> 
                </div>
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