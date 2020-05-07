<section class="collectionsidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 collections--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid pt-32">
                        <div class="col nopad-left">
                        <h2>Index of <b>Collections for Web Catalog</b> (<?= $active_collections_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <a href="/studio/collections-add"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>path</th>
                                <th>status</th>
                                <th>type</th>
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
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/collections-add?id=' + row.catalog_collections_id + '">' + row.title + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'path',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '/' + data + '/';
                        }  
                        return data;
                    } },
                { data: 'status'},
                { data: 'type'}
            ]
        } );
        
    });
</script>