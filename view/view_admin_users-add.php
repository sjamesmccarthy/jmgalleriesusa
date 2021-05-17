<section class="admin--users-add">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col users-add--container">

            <div class="admin-header">
                <h2><?= $this->page->title ?></h2>
                <p class="close-x"><i class="fas fa-times-circle"></i></p>
            </div>

            <form id="reports-add" action="/studio/api/update/users" method="POST">
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <?= $id_field ?>
            <?= $type_id ?>

            <div class="half-size">
                <label for="title">USERNAME (email)</label>
                <input class="" maxlength="255" type="text" id="username" name="username" placeholder="USERNAME (eg, john@wick.com)" value="<?= $res_username ?>" required>
                
            </div>

            <div>
                <label for="edition-style">TYPE</label>
                <input class="half-size" maxlength="255" type="text" id="type" name="type" placeholder="TYPE (eg, ARTIST, COLLECTOR)" value="<?= $res_type ?>">
                <label for="edition-style">ID</label>
                <input class="half-size" maxlength="255" type="text" id="ac_id" name="ac_id" placeholder="ARTIST OR COLLECTOR ID (eg, 15)" value="<?= $ac_id ?>" <?= $disabled ?>/>
            </div>

            <div>            
                <label for="title">REGENERATE PIN (6-DIGIT)</label>
                <input class="half-size" maxlength="6" type="text" id="pin" name="pin" placeholder="REGENERATE PIN (eg, JM1234 or 678967 or GKLYNM)" />
                

                <label for="edition-style">MD5</label>
                <input class="half-size" maxlength="255" type="text" id="pinMD5" name="pinMD5" value="<?= $res_pin ?>" disabled />
            </div>

            <div class="half-size valign-top">
                <h4 class="pt-32 pb-16">Additional Roles</h4>
                <ul>
                    <?= $roles_html ?>
                </ul>
            </div>

            <div class="half-size">
                <h4 class="pt-32 pb-16">Application Access</h4>
                <ul>
                    <?= $apps_html ?>
                </ul>
            </div>


            <div class="clear">
                <button class="mt-32 w-50" id="sendform" value="SEND"><?= $button_label ?></button>
                <?= $button_archive_cancel ?>
            </div>

            </form>

            <p id="form_response"> </p>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){
    
    $('.close-x').on("click", function() {
        window.location.href = '/studio/users';
    });

    $("#pin").keypress(function () {
          $(this).addClass('toUpper');
    });

    if($('#type').val() == "ARTIST") { 
        $('#role-artist').attr("checked","checked");
    }
    if($('#type').val() == "COLLECTOR") { 
        $('#role-collector').attr("checked","checked");
    }

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