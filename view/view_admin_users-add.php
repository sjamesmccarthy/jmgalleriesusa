<section class="admin--users-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 users-add--container">

            <h2 class="pb-32 pt-32"><?= $this->page->title ?></h2>

            <h1><?= $formTitle ?></h1>

            <form id="reports-add" action="/studio/api/update/users" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <?= $type_id ?>

            <!-- <div>
                <label for="title">FIRST NAME</label>
                <input class="half-size" maxlength="255" type="text" id="first" name="first" placeholder="FIRST NAME (eg, JOHN)" value="<?= $res_first ?>" required>
                <label for="edition-style">LAST NAME</label>
                <input class="half-size" maxlength="255" type="text" id="last" name="last" placeholder="LAST NAME (eg, Wick)" value="<?= $res_last ?>">
            </div> -->

            <div class="half-size">
                <label for="title">USERNAME (email)</label>
                <input class="" maxlength="255" type="text" id="username" name="username" placeholder="USERNAME (eg, john@wick.com)" value="<?= $res_username ?>" required>
                
            </div>

            <div>
                <label for="edition-style">TYPE</label>
                <input class="half-size" maxlength="255" type="text" id="type" name="type" placeholder="TYPE (eg, ARTIST, COLLECTOR)" value="<?= $res_type ?>">
                <label for="edition-style">ID</label>
                <input class="half-size" maxlength="255" type="text" id="ac_id" name="ac_id" placeholder="ARTIST OR COLLECTOR ID (eg, 15)" value="<?= $ac_id ?>" />
            </div>

            <div>            
                <label for="title">REGENERATE PIN (6-DIGIT)</label>
                <input class="half-size" maxlength="6" type="text" id="pin" name="pin" placeholder="REGENERATE PIN (eg, JM1234 or 678967 or GKLYNM)" required />
                

                <label for="edition-style">MD5</label>
                <input class="half-size" maxlength="255" type="text" id="pinMD5" name="pinMD5" value="<?= $res_pin ?>" readonly />
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
    
    $("#pin").keypress(function () {
          $(this).addClass('toUpper');
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