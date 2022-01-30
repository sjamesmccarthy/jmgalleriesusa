<section class="inventoryidx--container">
    <div class="grid">

        <!-- insert navigation component -->
        <?= $navigation_html ?>

        <div class="col inventory--container">

            <div class="notification <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col pb-0">

                        <h2>Index of <b>Shop Product</b> (<span class="current_recs"><?= $active_product_count ?></span>/<?= $total_product_count ?>)</h2>

                            <p><?= $active_filter ?></p>
                            <div class="tabs">
                                <div class="tab-ACTIVE" ><a href="?filter=ACTIVE">ACTIVE</a></div>
                                <div class="tab-DISABLED" ><a href="?filter=DISABLED">DISABLED</a></div>
                                <div class="tab-INVENTORY" ><a href="/studio/products"><i class="fas fa-times-circle"></i></a></div>
                            </div>

                        </div>
                        <div class="col-1 add-icon"><a href="/studio/products-add"><i class="fas fa-plus-circle"></i></a></div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>ID  </th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th>Sale</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

        </div>

    </div>
</section>

<script>
    jQuery(document).ready(function($){

        $(document).on('keyup','input[type=search]',function(){
            updateCount();
        });

        $('.tab-<?= $filter ?>').addClass('active');

        $('.notification').delay(5000).slideUp("slow").fadeOut(3000);

        $('#dataTable').DataTable( {
            processing: true,
            paging: false,
            pagingType: "numbers",
            searching: true,
            oSearch: {"sSearch": "<?= $filter ?>"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'product_id' },
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/products-add?id=' + row.product_id + '">' + data + '</a> <!-- [' + row.product_id + '] -->';
                        }
                        return data;
                    }
                },
                { data: 'price' },
                { data: 'quantity' },
                { data: 'in_stock'},
                { data: 'on_sale' },
                { data: 'status' },
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "45%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "10%", "targets": 6 },
              ]
        } );

        function updateCount() {
            var info = $('#dataTable').DataTable().page.info();
            $('.current_recs').html(info.recordsDisplay);
            console.log( info.recordsDisplay );
        }

        updateCount();

    });

</script>
