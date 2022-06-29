<section class="inventoryidx--container">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col inventory--container">

            <div class="notification <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col pb-0">
                        <h2>Index of <b>Inventory</b> (<span class="current_recs"><?= $active_photos_count ?></span>/<?= $total_inventory_count ?>)</h2>
                        
                            <div class="tabs"> 
                                <div class="tab-STUDIO" ><a href="?filter=STUDIO">STUDIO</a></div>
                                <!-- <div class="tab-HC" ><a href="?filter=HC">HOME COLLECTION</a></div> -->
                                <div class="tab-DONATED" ><a href="?filter=DONATED">DONATED</a></div>
                                <div class="tab-COLLECTOR" ><a href="?filter=COLLECTOR">COLLECTOR</a></div>
                                <!-- <div class="tab-TINYVIEWS" ><a href="?filter=TINYVIEWS">tinyVIEWS</a></div> -->
                                <div class="tab-DESTROYED" ><a href="?filter=DESTROYED">DESTROYED</a></div>
                                <div class="tab-INVENTORY" ><a href="/studio/inventory"><i class="fas fa-times-circle"></i></a></div>
                            </div>

                        </div>
                        <div class="col-1 add-icon"><a href="/studio/inventory-add"><i class="fas fa-plus-circle"></i></a></div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>ID  </th>
                                <th>Title</th>
                                <!-- <th>Ed</th> -->
                                <!-- <th>Size</th> -->
                                <!-- <th>Media</th> -->
                                <th>Location</th>
                                <th>Serial No.</th>
                                <!-- <th>Value</th> -->
                                <!-- <th>Acquired At</th> -->
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
                { data: 'art_id' },
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/inventory-add?id=' + row.art_id + '">' + data + ' #' + row.edition_num + '</a> <!-- [' + row.art_id + '] --><br />' + row.print_size + ' ' + row.print_media;
                        }  
                        return data;
                    } 
                },
                // { data: 'edition_num' },
                // { data: 'print_size' },
                // { data: 'print_media'},
                { data: 'location' },
                { data: 'serial_num' },
                // { data: 'TOTAL_VALUE' },
                // { data: 'acquired_from' }
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "60%", "targets": 1 },
                // { "width": "5%", "targets": 2 },
                // { "width": "10%", "targets": 3 },
                // { "width": "25%", "targets": 4 },
                { "width": "40%", "targets": 2 },
                // { "width": "5%", "targets": 2 },
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