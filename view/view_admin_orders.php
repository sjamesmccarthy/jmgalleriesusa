<section class="ordersidx--container">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col orders--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col pb-0">
                        <h2>Index of <b>Orders</b> (<?= $active_orders_count ?>)</h2>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>item</th>
                                <th>invoice</th>
                                <th>received</th>
                                <th>amount</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

        </div>

    </div>
</section>

<script>
    jQuery(document).ready(function($){
       
        $('.notification').delay(5000).slideUp("slow").fadeOut(3000);

        $('#dataTable').DataTable( {
            processing: true,
            paging: false,
            pagingType: "numbers",
            searching: true,
            // oSearch: {"sSearch": "<?= $filter ?>"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'name'},
                { data: 'item', 
                    "render": function(data, type, row, meta){

                        var item_obj = JSON.parse(row.item);

                        if(type === 'display'){

                            data = item_obj.title.toUpperCase() + ', ' + item_obj.edition.toUpperCase() + ' edition';
                        }  
                        return data;
                    } 
                },
                { data: 'invoice_number',
                        "render": function(data, type, row, meta){
                            if(type === 'display'){
                                data = '<a href="/studio/orders-add?id=' + row.product_order_id + '">' + data + '</a>';
                            }  
                        return data;
                    } 
                },
                { data: 'received'},
                { data: 'price',
                        "render": function(data, type, row, meta){
                            if(type === 'display'){
                                if(row.discount != '') { var promo = ' (-PROMO)'; } else { var promo = ''; }
                                data = data + promo;
                            }  
                        return data;
                    } 
                }
            ]
        } );
        
    });
</script>