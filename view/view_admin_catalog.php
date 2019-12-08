<section class="catalogidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <h2 class="pb-32">Catalog of <b>Active Online Photos</b> (<?= $active_photos_count ?>)</h2>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Catalog Category</th>
                                <th>Status</th>
                                <th>Views</th>
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
                            data = '<a target="_detail" href="/studio/catalog-add?id=' + row.file_name + '">' + data + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'category' },
                { data: 'status' },
                { data: 'views' }
            ],
            "order": [[ 0, "asc" ]]
        } );
        
    });
</script>