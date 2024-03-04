jQuery(document).ready(function($){
    jQuery.noConflict();

    $("#email, #serial").on("focus", function(e) {
        $('.errorMsg').hide();
        $('#email').removeClass("error");
        $('.provenance-section--results').hide();
        $('#include_all').prop('checked', false);
    });

    $('#lookup-btn').on("click", function(e) {
        e.preventDefault();

        console.log("lookup-btn.clicked");
        console.log("lookup-btn.error-checking");

        /* Validate Form */
        let errFlag;

        if ( !$('#email').val() ) { 
            errFlag = 1; 
            $('#email').addClass('error');
        } 
        // else if ( !$('#serial').val() ) {
            
        //     if ( $('#email').val() ) {
        //         errFlag = 0; 
        //     } else {
        //         errFlag = 1;
        //     }

        // } 
        else { errFlag = 0; }
        
        console.log("errFlags:" + errFlag);

        if(errFlag === 1) { 
            $('.errorMsg').html("Please Fix (" + errFlag + ") Fields Above");
            $('.errorMsg').show();
            // console.log(errFlag + " errors found");
            return false; 
        }

        /* Ajax with Axios Lookup */
        var bodyFormData = new FormData();

        bodyFormData.append('email', $("#email").val());
        bodyFormData.append('serialreg', $("#serial").val());
        if( $('#include_all').is(':checked')) {
            bodyFormData.append('include_all', $('#include_all').is(':checked'));
            console.log('checkbox.true');
        } else {
            console.log('checkbox.false');
        }

        axios({
            method: 'post',
            url: '/view/__ajax/ajax_provenance_serialreg.php',
            data: bodyFormData,
            headers: { "Content-Type": "multipart/form-data" },
            })
            .then(function (response) {
                //handle success
                console.log(response);
                $('.provenance-section--ajax-data').html(response.data);
                $('.provenance-section--results').show();
            })
            .catch(function (response) {
                //handle error
                console.log(response);
        });
    });

});