<?php

    $amazingOfferMonth = "August";
    $amazingOfferTitle = "Daisies for Our Lady";
    $amazingOfferTitleLocation = "Carmelite Monastery, California";
    $amazingOfferTitleLastMonth = "Daisies for Our Lady";
    $currenOfferName =  $amazingOfferMonth . " " . YEAR . " New Release, \"" . $amazingOfferTitle ."\"";
    $amazingOfferExpiration = $amazingOfferMonth . " 31, 2019";
    $imageWidth = "100%"; /* 60% for Portrait Orientation */

?>

<!-- 
  // jQuery(document).ready(function($){

  //   $("#name, #contactinfoEmail, #size").on("focus", function() {
  //       $("#name, #contactinfoEmail, #size").removeClass("amazing-offer-error");
  //       $(".amazing-offer-error-explained").slideUp("fast").fadeOut("1000");
  //       // $(".amazing-offer-error-explained").css("display", "block");
  //   } );

  //   $('input:text').bind('focus blur', function() {
  //       $(this).toggleClass('form-focus');
  //       $('label').addClass('label-focus');
  //   });

  // });

  // function formSubmit() {
  //    var url = "/ajax_amazing-offer.php";
  //        // the script where you handle the form input.

  //          $.ajax({
  //                 type: "POST",
  //                 url: url,
  //                 data: $("#amazingOfferForm").serialize(),
  //                 // serializes the form's elements.
  //                 async: true,
  //                 success: function(data)
  //                 {
  //                   $('#form_response').html(data).addClass('success').show();
  //                   $('.amazing-offer-h1, .amazing-offer-blurb, .amazing-offer-blurb-desc, #amazing-offer-form, #amazingOfferForm, .amazing-offer-expires').fadeOut();
  //                 }
  //               });
  //       console.log('success: ' + data);
  //  }

  //  function validate(event) {
  //    event.preventDefault();
  //    if (
  //        !document.getElementById('name').value || 
  //        !document.getElementById('contactinfoEmail').value || 
  //        !document.getElementById('size').selectedIndex != '0') {

  //       $("#name, #contactinfoEmail, #size").addClass("amazing-offer-error");
  //       $(".amazing-offer-error-explained").removeClass("hidden").slideDown("fast");
     
  //    } else {
  //       event.preventDefault();
  //       grecaptcha.reset();
  //       grecaptcha.execute();
  //    }
  //  }

  //  function onload() {
  //    var element = document.getElementById('formButton');
  //    element.onclick = validate;
  //  }
  -->