<section class="orders--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 orders--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid">
                        <div class="col">
                        <h2>Index of <b>Orders</b> (<?= $active_orders_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <a href="/studio/users-add"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>item</th>
                                <th>invoice</th>
                                <th>open</th>
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
                { data: 'opened'},
                { data: 'price'}
            ]
        } );
        
    });
</script>