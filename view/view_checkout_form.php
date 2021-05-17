<section id="contact">
    <div class="grid-center">

        <div class="col-8_sm-11">

            <h1><?= $formTitle ?></h1>
            <p class="checkout-sub blue"><?= $subtitle ?></p>
            
            <?= $subNotice ?>

            <form id="nonce-form" action="<?= $action_uri ?>" method="POST">
            <input type="hidden" id="formType" name="formType" value="<?= $formType ?>" />
            <input name="refer_IP" type="hidden" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
            
            <input type="hidden" name="title" value="<?= $order_title ?>" />
            <input type="hidden" id="shipping_cost" name="shipping_cost" value="<?= $add_ship_cost ?>" />
            <input type="hidden" id="shipping_provider" name="shipping_provider" value="<?= $add_shipping_provider ?>" />
            
            <?= $hidden_fields ?>

            <h3>About You</h3>
            <input class="half-size-old"type="text" id="contactname" name="contactname" placeholder="YOUR NAME (eg, John Smith)" value="<?= $name ?>" >

            <input class="half-size-old" type="text" id="contactemail" name="contactemail" placeholder="YOUR EMAIL (eg, john.smith@ydomain.com)" value="<?= $email ?>" >

            <h3 class="mt-32 pb-0">Your Order for $<span id="estimated_cost_format"><?= $estimated_cost_calc ?></span> <span id="estimated_cost_format_strike" style="text-decoration: line-through; color: #e4e4e4;"><span></h3>
            <span id="estimated_cost" class="noshow"><?= $cost ?></span>
            <?= $limited_deposit ?>
            <input type='hidden' id="price" name='price' value="<?= $cost ?>" />
            <input type='hidden' id="quantity" name='quantity' value="<?= $res_quantity ?>" />
            
            <div style="border:0; border-left: 1px solid #e4e4e4; margin-left: 2rem; padding-left: 1rem; font-size: 1rem; min-height: 12rem; margin-top: 8px;">
            <?= nl2br($order_subject) ?>   
            <p class="tiny pt-32 pb-32">Note: Shipping Costs May Have Been Added To Above Total</p>
            </div>

            <textarea style="display:none;"  id="contactsubject" name="contactsubject" disabled /><?= $order_subject ?></textarea>

            <p class="pt-8 pb-32 promo-container"><input class="half-size" style="margin-bottom: 0;" type="text" id="promocode" name="promocode" placeholder="PROMO CODE" value="<?= $promo_code ?>" /><input type="hidden" id="promo_amt" name="promo_amt" value="0" /><span class="ml-16 tiny promo-btn"><a href="#" id="apply_promo">apply code</a></span></p><p class="promo-label"><b>PROMO <span class="promo-name uppercase"></span> APPLIED</b></p>

            <div>
                <h3 class="pt-16">Ship To</h3> 
                <p><input class="half-size-old" type="text" id="address" name="address" placeholder="SHIPPING ADDRESS (eg, 123 Main St.)" value="<?= $address ?>" $ />
                <input class="half-size-old" type="text" id="address_other" name="address_other" placeholder="SHIPPING ADDRESS SECOND LINE (eg, Suite, Apt)" value="<?= $address_exxtra ?>"/></p>
                <p><input class="half-size-old" type="text" id="city" name="city" placeholder="CITY (eg, Las Vegas, Dallas, Barstow)" value="<?= $city ?>"/>
                <input class="half-size-old" type="text" id="state" name="state" placeholder="State (eg, NV, CA, NY, TX)" value="<?= $state ?>"/></p>
                <p><input class="half-size-old" type="text" id="postalcode" name="postalcode" placeholder="Postal Code (eg, 95474)" value="<?= $postalcode ?>"/><p>
                <p><input class="half-size-old" type="text" id="phone" name="phone" placeholder="PHONE (eg, 951-708-1831)" value="<?= $phone ?>" /><p>
                
                <ul class="shipping">
                    <?= $ship_rates_html ?>
                </ul>

            </div>
            
            <h3 class='mt-32'>Payment</h3><p class='pb-16'><img style='margin-bottom: 10px; width: 150px; vertical-align: middle' src='/view/image/square-payment-icons.png' alt="square payment icon" /> <!-- <i style='font-size: 1.8rem; margin-left: 5px;' class='fab fa-bitcoin'></i> --><br /><span class='small'Estimated Total Not Including Tax or Shipping or any Promotional Codes.<br />Visa, Mastercard, American Express and Discover accepted and processed with Square. <!-- Shipping costs and tax, if applicable, will be included on final bill. Bitcoin is accepted via Coinbase or Square Cash App.<br /> Cash (USD) is accepted on pickup only orders. No checks. <u>There is no payment due at this time.</u> You will be billed separately through Square.--></span></p>

            <?= $pay_SqPaymentForm ?>
            <?= $pay_SqForm_CSS ?>
            <?= $pay_SqPaymentForm_localjs ?>
            <?= $pay_SqPaymentFormFields ?>


            <button class="mt-32" id="sq-creditcard" 
                    value="SEND"><?= $button_label ?></button>

            <div id="error"></div>
            <input type="hidden" id="card-nonce" name="nonce">
            </form>

            <p id="form_response"> </p>
        </div>

        <div class="pl-32 col-3_sm-11">
           <?php $this->getPartial('findus'); ?>
        </div>

    </div>
</section>

<?= $pay_sqPaymentFormJS ?>
  
<script>

  jQuery(document).ready(function($){
    jQuery.noConflict();

     $('.ship').click(function() {
        $('.ship').not(this).prop('checked', false);
        var shipping = $(this).val();
        var shipping_provider = $(this).attr('id');
        var shipping_provider_name = $(this).attr('data-shipper');
        console.log( shipping_provider + '=' + shipping );
        
        /* Update costs and hidden fields */
        var oldprice = parseFloat( parseFloat( $('#estimated_cost').html() ) );
        var newprice = parseFloat(oldprice.toFixed(2)) + parseFloat( shipping );
        var newpriceTrim = newprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        var newpriceCents = newprice * parseFloat(100);
        console.log("oldprice:" + oldprice + "/" + "newprice:" + newprice + "/shipCost: " + $(this).val() );
        
        $('#shipping_provider').val(shipping_provider_name);
        $('#shipping_cost').val(shipping);
        $('#estimated_cost_format, #sq-creditcard span#estimated_cost_format_btn').html(newpriceTrim);
        $('#sq-creditcard #amount_total').val(newpriceCents);
        
        <?php if($deposit != "true") { ?>
            $('#amount_total').val(newpriceCents.toFixed(0));
            $('#sq-creditcard span#estimated_cost_format_btn').html( newpriceTrim );
        <?php } else { ?>
            $('#amount_total').val('10000');
            var b = parseFloat( $('#amount_total').val() / 100 );
            var bdec = b.toFixed(2);
            console.log('dep:true ' + bdec);
            $('#sq-creditcard span#estimated_cost_format_btn').html( bdec );
        <?php } ?>

    });

    $("#promocode").focus(function () {
        $('#promocode').val('');
        $('#promocode').css('color','black');
    })

    $("#promocode").keyup(function () {
          $(this).addClass('toUpper');
    });

    $('#apply_promo').on("click", function(e) {
        e.preventDefault();

        if( $('#promocode').val() != '' ) {

            console.log( "realprice: " + $('#price').val() );

            var url = "/view/ajax_promocode_process.php";
            console.log("promo:" + $('#promocode').val() + "," + "cost:" + $('#price').val());

            $.ajax({
                  type: "POST",
                  url: url,
                  data: { "promo":$('#promocode').val(), "cost":$('#price').val() },
                  async: true,
                  success: function(data)
                  {
                      if(data == "INVALID CODE -0") {
                          data = "INVALID: DISCOUNT CAN'T BE GREATER THEN PRODUCT PRICE";
                          $('#promocode').val(data).css('color','red');
                      } else if(data == "INVALID CODE 1") {
                          data = "HUH? WE COULDN'T FIND THAT CODE";
                          $('#promocode').val(data).css('color','red');
                        } else {

                            var oldprice = parseFloat($('#price').val());
                            console.log("oldPrice: " + oldprice);
                          
                            var rValue = parseFloat(data);
                            console.log('data:' + data);
                            
                            $('input:checkbox[class=ship]').each(function() 
                            {    
                                if( $(this).is(':checked') ) {
                                    var shipping = $(this).val();
                                    var shipping_provider = $(this).attr('id');
                                    var shipping_provider_name = $(this).attr('data-shipper');

                                    console.log('ship_box: ' + shipping);

                                    rValue = rValue + parseFloat(shipping);
                                    $('#shipping_provider').val(shipping_provider_name);
                                    $('#shipping_cost').val(shipping);
                                } else {
                                    var shipping = 0;
                                }

                            });

                            var newprice = rValue.toFixed(2);
                            console.log("newBasePrice: " + newprice);

                            var priceCents = newprice * 100;
                            var newpriceFormatted = newprice.replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            var oldpriceFormatted = oldprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                            $('#estimated_cost_format').html( newpriceFormatted);
                            $('#estimated_cost_format_btn').html( newpriceFormatted);
                            $('#estimated_cost_format_strike').html( oldpriceFormatted );
                            $('#estimated_cost').html(newprice);
                            
                            <?php if($deposit != "true") { ?>
                                console.log("pc: " + priceCents.toFixed(0) );
                                $('#amount_total').val(priceCents.toFixed(0));
                                $('#sq-creditcard span#estimated_cost_format').html(newpriceFormatted);
                            <?php } ?>

                            var promo_amt = parseFloat(oldprice) - parseFloat(newprice);
                            $('#promo_amt').val( promo_amt.toFixed(2) );
                            $('.promo-btn').hide();
                            $('.promo-container').hide();
                            $('.promo-name').html( $('#promocode').val() );
                            $('.promo-label').show();
                        }
                  },
                  error : function(request,error) {
                      console.log("Request: "+JSON.stringify(request));
                  }
                });
        }

    });

    $("input[type=text]").on("focus", function(e) {
        var ele = ".e_" + $(this).attr("id");
        console.log(ele);
        $(ele).hide();
    });

    $('#nonce-form').submit(function(e) {
        console.log('formSubmit()');

        var errors=0;
        var contactname = $("input[name='contactname']").val();
        var contactemail = $("input[name='contactemail']").val();
        var contactsubject = $("textarea[name='contactsubject']").val();
        var address = $("input[name='address']").val();
        var city = $("input[name='city']").val();
        var state = $("input[name='state']").val();
        var postalcode = $("input[name='postalcode']").val();
        var phone = $("input[name='phone']").val();
        
        $(".error-form-validation").remove();

        if (contactname.length < 1) {
            $('#contactname').after('<span class="e_contactname error-form-validation">This field is required</span>');
            ++errors;
        }
        if (contactemail.length < 1) {
            $('#contactemail').after('<span class="e_contactemail error-form-validation">This field is required</span>');
            ++errors;
        }
        if (address.length < 1) {
            $('#address').after('<span class="e_address error-form-validation">This field is required</span>');
            ++errors;
        }
        if (city.length < 1) {
            $('#city').after('<span class="e_city error-form-validation">This field is required</span>');
            ++errors;
        }
        if (state.length < 1) {
            $('#state').after('<span class="e_state error-form-validation">This field is required</span>');
            ++errors;
        }
        if (postalcode.length < 1) {
            $('#postalcode').after('<span class="e_postalcode error-form-validation">This field is required</span>');
            ++errors;
        }
        if (phone.length < 1) {
            $('#phone').after('<span class="e_phone error-form-validation">This field is required</span>');
            ++errors;
        }

        if(errors > 1) {
            return false;
        } else {
            onGetCardNonce(event);
        }
        
    });

  });

</script>