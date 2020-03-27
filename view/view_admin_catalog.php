<section class="catalogidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid">
                        <div class="col"><h2 class="pb-32">Catalog of <b>Active Online Photos</b> (<?= $active_photos_count ?>)</h2></div>
                        <div class="col-1 add-icon"><a href="/studio/catalog-add"><i class="fas fa-plus-circle"></i></a></div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Catalog Category</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Last View</th>
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
            paging: false,
            searching: true,
            oSearch: {"sSearch": "ACTIVE"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/catalog-add?id=' + row.file_name + '">' + data + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'category' },
                { data: 'status' },
                { data: 'views' },
                { data: 'lastview',
                    "render": function(data, type, row, meta){
                        return data;
                    } 
                }
            ],
            "order": [[ 0, "asc" ]]
        } );
        
    });
</script>