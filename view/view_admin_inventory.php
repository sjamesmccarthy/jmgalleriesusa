<section class="inventoryidx--container">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col inventory--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col pb-0">
                        <h2>Index of <b>Inventory</b> (<?= $active_inventory_count ?>)</h2>
                        
                            <div class="tabs"> 
                                <!-- <div class="tab-ACTIVE <?= $active_filter ?>" ><a href="?filter=ACTIVE">ACTIVE</a></div> -->
                                <div class="tab-STUDIO" ><a href="?filter=STUDIO">STUDIO</a></div>
                                <div class="tab-HC" ><a href="?filter=HC">HOME COLLECTION</a></div>
                                <div class="tab-DONATED" ><a href="?filter=DONATED">DONATED</a></div>
                                <div class="tab-COLLECTOR" ><a href="?filter=COLLECTOR">COLLECTOR</a></div>
                                <div class="tab-TINYVIEWS" ><a href="?filter=TINYVIEWS">tinyVIEWS</a></div>
                                <div class="tab-DESTROYED" ><a href="?filter=DESTROYED">DESTROYED</a></div>
                                <div class="tab-INVENTORY" ><a href="/studio/inventory"><i class="fas fa-times-circle"></i></a></div>
                            </div>

                        </div>
                        <div class="col-1 add-icon"><a href="/studio/inventory-add"><i class="fas fa-plus-circle"></i></a></div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Series</th>
                                <th>Edition</th>
                                <th>Max Ed.</th>
                                <th>Location</th>
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
                { data: 'TOTAL_VALUE' }
            ]
        } );
        
    });

</script>