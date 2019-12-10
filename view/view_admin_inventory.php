<section class="catalogidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <h2>Index of <b>Inventory</b> (<?= $active_inventory_count ?>)</h2>
                    <p>Filter By: <a href="?filter=STUDIO">Studio</a>, <a href="?filter=HC">Home Collection</a>, <a href="?filter=DONATED">Donated</a>, <a href="?filter=COLLECTOR">Collector</a>, <a href="?filter=tinyviews">tinyViews</a>, <a href="?filter=DESTROYED">Destroyed</a>, <a href="/studio/inventory">reset</a></p>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Series</th>
                                <th>Edition</th>
                                <th>Max Ed.</th>
                                <th>Location</th>
                                <th>Created</th>
                                <th>Cost</th>
                                <th>Value</th>
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
            oSearch: {"sSearch": "<?= $filter ?>"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/inventory-add?id=' + row.art_id + '">' + data + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'series_num' },
                { data: 'edition_num' },
                { data: 'edition_num_max' },
                { data: 'location' },
                { data: 'created' },
                { data: 'TOTAL_COST' },
                { data: 'TOTAL_VALUE' }
            ]
        } );
        
    });
</script>