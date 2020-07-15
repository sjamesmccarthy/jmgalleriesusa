<section class="admin--fieldnotes-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 fieldnotes-add--container">

            <div class="notification success <?= $notification_state ?>"><?= $_SESSION['notification_msg'] ?></div>

            <div class="admin-header">
                    <h2><?= $this->page->title ?></h2>
                    <p class="close-x"><i class="fas fa-times-circle"></i></p>
            </div>

        <div>

                <form id="fieldnotesadd" action="/studio/api/update/fieldnotes" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
                <?= $id_field ?>
                <?= $file_1_hidden ?>
                <input type="hidden" id="artist_id" name="artist_id" value="1" />
                <input type="hidden" id="words" name="words" value="<?= $res_words ?>" />

                <div>
                    <label for="title">TITLE</label>
                    <input class="two-thirds" maxlength="100" type="text" id="title" name="title" placeholder="TITLE (eg, When Does A Photograph Become 'Fine-Art'?)" value="<?= $res_title ?>" required>
                   
                    <div class="one-thirds select-wrapper">
                    <select id="type" name="type" style="margin-bottom: 0">
                          <option value="article" <?= ($res_status == "article" ? "SELECTED" : ""); ?>>ARTICLE</option>
                          <option value="fimlstrip" <?= ($res_status == "fimlstrip" ? "SELECTED" : ""); ?>>FILMSTRIP</option>
                    </select> 
                    </div>
                    <!-- <input type="hidden" id="type" name="type" placeholder="TYPE (eg, TEXT, FILMSTRIP)" value="text"> -->
                </div>

                <div>
                    <p class="one-thirds right">https://jmgalleriesusa.com/polarized/</p>
                    <label for="title">SHORT-URL-PATH</label>
                    <input class="two-thirds" maxlength="40" class="half-size ml-16" type="text" id="short_path" name="short_path" placeholder="SHORT-URL-PATH (eg, when-does-a-photograph-become-fineart)" value="<?= $res_short_path ?>" required>
                </div>

                 <div class="file mt-16">
                    <?= $show_image_html ?>
                    <input type="text" id="caption" name="caption" value='<?= $res_caption ?>' placeholder="CAPTION (eg. Photo Credit James McCarthy)">
                    
                    <div class="file__upload-container">
                        <input class="input-upload" type="file" id="file_1" name="file_1" aria-label="Choose Main Photo"><br /><?= $image_info ?>
                        <input type="hidden" id="file_1_path" name="file_1_path" value="/view/image/fieldnotes/">
                        </div>

                </div>

                <div class="mt-32">
            
                    <p>CONTENT</p>

                    <label for="teaser">teaser</label>
                    <input class="mt-8" maxlength="250" type="text" id="teaser" name="teaser" placeholder="TEASER (eg, MAXLENGTH 133 CHARACTERS.)" value="<?= $res_teaser ?>" >

                    <div class="fn__editor">
                        <div class="actions fn__editor_tools">
                            <button data-action="bold"><i data-action="bold" class="fas fa-bold"></i></button><button data-action="italic"><i data-action="italic" class="fas fa-italic"></i></button><button data-action="underline"><i data-action="underline" class="fas fa-underline"></i></button><button data-action="justifyLeft"><i data-action="justifyLeft" class="fas fa-align-left"></i></button><button data-action="justifyCenter"><i data-action="justifyCenter" class="fas fa-align-center"></i></button><button data-action="justifyRight"><i data-action="justifyRight" class="fas fa-align-right"></i></button><button data-action="h1"><i data-action="h1" class="fas fa-heading"></i>1</button><button data-action="h2"><i data-action="h2" class="fas fa-heading"></i>2</button><button data-action="insertUnorderedList"><i data-action="insertUnorderedList" class="fas fa-list-ul"></i></button><button data-action="indent"><i data-action="indent" class="fas fa-indent"></i></button><button data-action="outdent"><i data-action="outdent" class="fas fa-outdent"></i></button><button data-action="blockquote"><i data-action="blockquote" class="fas fa-quote-right"></i></button><!-- <button data-action="insertImage"><i data-action="insertImage" class="fas fa-image"></i></button> --><button data-action="createLink"><i data-action="createLink" class="fas fa-link"></i></button><button data-action="unLink"><i data-action="unLink" class="fas fa-unlink"></i></button><button data-action="p"><i data-action="p" class="fas fa-paragraph"></i></button><button data-action="stripHTML"><i data-action="stripHTML" class="fas fa-eraser"></i></button><button data-action="code"><i data-action="code" class="fas fa-code"></i></button>
                        </div>

                        <!-- <div class="fn__editor_tools --preview">
                        </div> -->

                    </div>

                    <div class="content_html" contenteditable="true"><?= $res_content ?></div>

                        <p id="result">
                            <span id="wordCount">0</span> <span class="slash">WORDS /</span> <span id="wordLimit">READY, SET, WRITE.</a><br/>
                            <!-- Total Characters(including spaces): <span id="totalChars">0</span><br/> -->
                            <!-- Characters (excluding trails): <span id="charCount">0</span><br/> -->
                            <!-- Characters (excluding all spaces): <span id="charCountNoSpace">0</span> -->
                        </p>
                    
                    <div class="raw_edit_container"><p class="raw_edit_save"><i class="fas fa-save"></i></p><textarea name="content" id="content" class="content_raw"></textarea></div>

                </div>

                <div class="mt-16">
                    <input class="half-size" type="text" id="tags" name="tags" placeholder="TAGS (eg. adventure, tutorial, opinion, historical-profile)" value="<?= $res_tags ?>">
                    <input class="half-size <?= $date_field_hidden ?>" type="text" id="date" name="date" placeholder="CREATED ON (eg. 2020-07-01 08:32:08)" value="<?= $res_created ?>">
                </div>

                <div>
                    <div class="select-wrapper half-size">
                    <select id="status" name="status" style="margin-bottom: 0">
                          <option value="draft" <?= ($res_status == "draft" ? "SELECTED" : ""); ?>>DRAFT</option>
                          <option value="published" <?= ($res_status == "published" ? "SELECTED" : ""); ?>>PUBLISHED</option>
                          <option value="archived" <?= ($res_status == "archived" ? "SELECTED" : ""); ?>>ARCHIVED</option>
                    </select> 
                    </div>

                     <div id="make-featured" class="small half-size mb-16 mt-16 ml-8">
                     <input <?= ($res_featured == "1" ? "CHECKED" : ""); ?> type="checkbox" id="featured" name="featured" value="1" /> 
                     <label for="featured" style="color: #000"> Featured Post (Uses Background in Listing Card)</label>
                    </div>
                </div>


                <button class="mt-32 half-size" id="sendform" value="SEND"><?= $button_label ?></button>
                </form>

                <p id="form_response"> </p>
        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){

/* ****** */
console.log($("div[class*='actions'] button").length)

/* Update the textarea content_raw onLoad */
$('.content_raw').val( $('.content_html').html() );


$('.content_html').on('keypress', function(e) {
    $('.content_raw').val( $('.content_html').html() );
});

$('.raw_edit_save').on("click", function(e) {
    $('.content_html').html( $('.content_raw').val() );
});

$("div[class*='actions'] button").on("click", function(e) {
    e.preventDefault();
    var action = e.target.dataset.action;
    
    if (action) {
            if (action == 'h1' || action == 'h2' || action == 'p' || action == 'blockquote') {
                document.execCommand('formatBlock', false, action);
                console.log('formatBlock__' + action);
            } else if (action == 'createLink') {
                url = prompt('Enter the link here: ', 'https:\/\/');
                document.execCommand(action, false, url);
            } else if (action == 'stripHTML') {
                console.log('stripHTML');
                var StrippedString = $('.content_html').html().replace(/(<([^>]+)>)/ig,"");
                $('.content_html').html(StrippedString);
                $('.content_raw').val(StrippedString);
                console.log(StrippedString);
            } else if (action == 'code') {
                e.preventDefault();
                $('.raw_edit_container').toggle();
            } else {
                document.execCommand(action,false);
                console.log(action);
            }
            $('.content_raw').val( $('.content_html').html() );
    } else {
        console.log('noaction');
    }

});
    
/* ****** */

    counter = function() {
        
        var maxWordCount = 700;
        var value = $('.content_html').html();

        if (value.length == 0) {
            $('#wordCount').html(0);
            $('#totalChars').html(0);
            $('#charCount').html(0);
            $('#charCountNoSpace').html(0);
            return;
        }

        var regex = /\s+/gi;
        var wordCount = value.trim().replace(regex, ' ').split(' ').length;
        var totalChars = value.length;
        var charCount = value.trim().length;
        var charCountNoSpace = value.replace(regex, '').length;

        $('#wordCount').html(wordCount);
        $('#words').val(wordCount);
        $('#totalChars').html(totalChars);
        $('#charCount').html(charCount);
        $('#charCountNoSpace').html(charCountNoSpace);
        
            if(wordCount > (maxWordCount/2) -1 ) {
                $('#wordLimit').html("<B>YOU'RE ON A ROLL &mdash; KEEP THOSE FINGERS MOVING.</B>");
                $('#wordLimit').css("color","orange");
            }

            if(wordCount > (maxWordCount-1) ) {
                $('#wordLimit').html("<B>WHOA! COWBOY &mdash; YOU HAVE A LOT TO SAY, THINK ABOUT WRAPPING IT UP.</B>");
                $('#wordLimit').css("color","purple");
            }

            if(wordCount > (maxWordCount+50) ) {
                $('#wordLimit').html("<B>BLAH, BLAH, BLAH, YOU NEED TO DELETE SOME OF YOUR WORDS.</B>");
                $('#wordLimit').css("color","red");
            }
    
    };

    $('.content_html').change(counter);
    $('.content_html').keydown(counter);
    $('.content_html').keypress(counter);
    $('.content_html').keyup(counter);
    $('.content_html').blur(counter);
    $('.content_html').focus(counter);

    counter();

    $('.close-x').on("click", function() {
        window.location.href = '/studio/fieldnotes';
    });

    <?php if($short_path_disabled != "disabled") { ?>
        $('#title').on('keyup', function() {
            $('#short_path').val($('#title').val().toLowerCase().replace(/\s+/g, "-"));
        });
    <?php } ?>

    $('#sendform').on("click", function(e) {
        
        /* Export HTML from WYSIWYG editor DIV to textarea */
        $('.content_raw').val( $('.content_html').html() );

        $(":input[required]").each(function () {                     
        
            var myForm = $('#fieldnotesadd');
            if (!myForm[0].checkValidity()) {                
                myForm.submit();     
            } 

        });

    });

    $('#archive').on("click", function(e) {
        e.preventDefault();
        alert('This Feature Not Available At This Time');
    });

});

</script>
