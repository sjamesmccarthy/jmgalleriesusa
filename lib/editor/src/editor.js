/* ****** */
/* Editor.js */
jQuery(document).ready(function($){

    console.log($("div[class*='actions'] button").length)

    /* Update the textarea content_raw onLoad */
    $('.content_raw').val( $('.content_html').html() );

    $('.content_html').on('keypress', function(e) {
        $('.content_raw').val( $('.content_html').html() );
    });

    $('.content_raw').on('keypress', function(e) {
        $('.raw_edit_save').show();
    });

    $('.raw_edit_save').on("click", function(e) {
        $('.content_html').html( $('.content_raw').val() );
        $('.raw_edit_save').hide();
    });

    $('.raw_close').on("click", function(e) {
        e.preventDefault();
        $('.content_html').html( $('.content_raw').val() );
        $('.raw_edit_container').toggle();
        $('.content_html').toggleClass('make_small');
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
                    $('.content_html').toggleClass('make_small');
                } else {
                    document.execCommand(action,false);
                    console.log(action);
                }
                $('.content_raw').val( $('.content_html').html() );
        } else {
            console.log('noaction');
        }

    });
});
    
/* ****** */