<section class="catalogidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog--container">

                    <h2 class="pb-32">Catalog of Online Photos</h2>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Catalog Category</th>
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
       
        $('#dataTable').DataTable( {
            paging: false,
            searching: true,
            data: <?= $data_json ?>,
            columns: [
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a target="_detail" href="/' + row.path + '/' + row.file_name + '">' + data + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'category' },
                { data: 'views' }
            ],
            "order": [[ 0, "asc" ]]
        } );
        
    });
</script>