<section class="admin--orders-add">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 orders-add--container">


            <div class="admin-header">
                <h2><?= $this->page->title ?></h2>
            </div>

            <!-- <h1><?= $formTitle ?></h1> -->

            <form id="reports-add" action="/studio/api/update/order" method="POST">
            <fieldset <?= $form_disabled ?>>
            <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
            <input type="hidden" id="invoice_no" name="invoice_no" value="<?= $res_invoice_number ?>" />
            <?= $id_field ?>

           <h4 class="pb-16">Customer Information</h4>

            <div>            
                <label for="title">Name</label>
                <input class="half-size" type="text" name="name" placeholder="NAME" value="<?= $res_name ?>" />

                <label for="edition-style">Email</label>
                <input class="half-size" type="text" name="email" placeholder="EMAIL" value="<?= $res_email ?>" />
            </div> 

            <div>            
                <label for="title">Phone</label>
                <input class="half-size" type="text" name="phone" placeholder="PHONE" value="<?= $res_phone ?>" />

                <p  class="half-size small mb-16 mt-16 pl-32">
                     <input <?= ($res_added_newsletter != '0' ? "CHECKED" : ""); ?> type="checkbox" id="added_newsletter" name="added_newsletter" value="1" /> 
                     <label for="added_newsletter" style="color: #000"> Added to Newsletter | <a target="_new" href="//mailchimp.com">MailChimp</a></label>
                </p>
            </div>   

           <div>            
                <label for="title">Shipping Address</label>
                <input class="half-size" type="text" name="address" placeholder="ADDRESS" value="<?= $res_address ?>" />

                <label for="edition-style">Shipping Address Line 2</label>
                <input class="half-size" type="text" name="address_other" placeholder="ADDRESS LINE 2" value="<?= $res_address_other ?>" />
            </div>

           <div>            
                <label for="title">City</label>
                <input class="half-size" type="text" name="city" placeholder="CITY" value="<?= $res_city ?>" />

                <label for="edition-style">State</label>
                <input class="half-size" type="text" name="state" placeholder="STATE" value="<?= $res_state ?>" />
            </div>

           <div>            
                <label for="title">Postal Code</label>
                <input class="half-size" type="text" name="postal_code" placeholder="POSTAL CODE" value="<?= $res_postal_code ?>" />
            </div>

           <div class="pt-16">           
               <b>Additional Notes from Customer:</b>
                <label for="title">Notes</label>
                <p class="pt-8 ml-32"><?= $res_notes ?>
                </p>
            </div>

            <h4 class="pt-16">Order Information</h4>
            <p class="small pb-16">Digital Negative:\\jmgalleries\Darkroom\<?= $item_info->catalog_id ?>_<?= strtoupper($item_info->title); ?></p>
            <input type="hidden" name="item_catalog_id" value="<?= $item_info->catalog_id ?>" />
              <div>            
                <label for="title">Item</label>
                <input class="half-size" type="text" name="item_title" placeholder="ITEM" value="<?= $item_info->title ?>" />

                <label for="edition-style">Edition</label>
                <input class="half-size" type="text" name="item_edition" placeholder="EDITION" value="<?= $item_info->edition ?>" />
            </div> 

              <div>            
                <label for="title">Size</label>
                <input class="half-size" type="text" name="item_size" placeholder="SIZE" value="<?= $item_info->size ?>" />

                <label for="edition-style">Framing</label>
                <input class="half-size" type="text" name="item_framing" placeholder="FRAMING" value="<?= $item_info->framing ?>" />
            </div> 
            
              <div>            
                <label for="title">Quantity</label>
                <input class="half-size" type="text" name="quantity" placeholder="QUANTITY" value="<?= $res_quantity ?>" />

                <label for="edition-style">Price</label>
                <input class="half-size" type="text" name="price" placeholder="PRICE" value="<?= $res_price ?>" />
            </div> 
                 <div>            
                <label for="title">Tax</label>
                <input class="half-size" type="text" name="tax" placeholder="TAX" value="<?= $res_tax ?>" />

                <label for="edition-style">Shipping</label>
                <input class="half-size" type="text" name="shipping" placeholder="SHIPPING" value="<?= $res_shipping ?>" />
            </div>

                <input type="hidden" name="promocode" value="<?= $res_discount ?>" />
              <div>            
                <label for="title">Promotional Discount</label>
                <input class="half-size" type="text" id="discount" name="discount" placeholder="PROMOTIONAL DISCOUNT" value="<?= $res_discount ?>" />

                <label for="title"></label>
                <input class="half-size bkg-green" type="text" name="total" value="$<?= $total_price ?> <?= $promo_discount ?>" disabled />

            </div> 

                <input type="hidden" name="received" value="<?= $res_received ?>" />
            <div>            
                 <p id="1_order_received" class="half-size small mb-16 mt-16">
                     <input <?= ($res_received != '' ? "CHECKED DISABLED" : ""); ?> type="checkbox" id="order_received" name="order_received" value="1" /> 
                     <label for="order_received" style="color: #000"> RECEIVED</label>
                </p>
                <input class="half-size fake-disabled" type="text" name="received" placeholder="PENDING" value="<?= $res_received ?>" disabled/>
            </div>

                <input type="hidden" name="acepted" value="<?= $res_accepted ?>" />
            <div>            
                 <p id="1-2_order_accepted" class="half-size small mb-16 mt-16">
                     <input <?= ($res_accepted != '' ? "CHECKED DISABLED" : ""); ?> type="checkbox" id="order_accepted" name="order_accepted" value="1" /> 
                     <label for="order_accepted" style="color: #000"> ACCEPTED</label>
                </p>
                <input class="half-size fake-disabled" type="text" name="accepted" placeholder="PENDING" value="<?= $res_accepted ?>" disabled/>
            </div>

            <div>            
                 <p id="2_order_invoiced" class="half-size small mb-16 mt-16">
                     <input <?= ($res_invoiced != '' ? "CHECKED DISABLED" : ""); ?> type="checkbox" id="order_invoiced" name="order_invoiced" value="1" /> 
                     <label for="order_invoiced" style="color: #000"> INVOICED | <a target="_new" href="https://squareup.com/dashboard/invoices">Square</a></label>
                </p>
                <input type="hidden" name="invoiced" value="<?= $res_invoiced ?>" />
                <input class="half-size fake-disabled" type="text" name="invoiced" placeholder="PENDING" value="<?= $res_invoiced ?>" disabled/>
            </div>

            <div>
                <p id="3_order_printed" class="half-size small mb-16 mt-16">
                     <input <?= ($res_printed != '' ? "CHECKED disabled" : ""); ?> type="checkbox" id="order_printed" name="order_printed" value="1" /> 
                     <label for="order_printed" style="color: #000"> PRINTED | <?= $collector_link ?> | <?= $inventory_link ?> </label>
                </p>
                <input type="hidden" name="printed" value="<?= $res_printed ?>" />
                <input class="half-size fake-disabled" type="text" name="printed" placeholder="PENDING" value="<?= $res_printed ?>" disabled/>
            </div>
            <div>
                 <p id="4_order_packaged" class="half-size small mb-16 mt-16">
                     <input <?= ($res_packaged != '' ? "CHECKED disabled" : ""); ?> type="checkbox" id="order_packaged" name="order_packaged" value="1" /> 
                     <label for="order_packaged" style="color: #000"> PACKAGED</label>
                </p>
                <input type="hidden" name="packaged" value="<?= $res_packaged ?>" />
                <input class="half-size fake-disabled" type="text" name="packaged" placeholder="PENDING" value="<?= $res_packaged ?>" disabled/>
            </div>
            <div>
                 <p id="5_order_shipped" class="small half-size mb-16 mt-16">
                     <input <?= ($res_shipped != '' ? "CHECKED disabled" : ""); ?> type="checkbox" id="order_shipped" name="order_shipped" value="1" /> 
                     <label for="order_shipped" style="color: #000"> SHIPPED</label>
                </p>
                <input type="hidden" name="shipped" value="<?= $res_shipped ?>" />
                 <input class="half-size <?= $disable_css ?>" type="text" name="tracking" placeholder="CARRIER +TRACKING" value="<?= $res_shipped ?><?= $res_tracking_number_formatted ?>" /> 
            </div> 

            <button class="mt-32 <?= $closed ?>" id="<?= $button_id ?>"  value="SEND"><?= $button_label ?></button>
            <?= $button_archive_cancel ?>
            </fieldset>
            </form>

        </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){
    
    $("#discount").keyup(function () {
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