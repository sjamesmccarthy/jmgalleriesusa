<section class="collectorsidx--container">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col collectors--container">

            <div class="notification <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col pb-0">
                        <h2>Index of <b>Collector</b> Profiles(<?= $active_collectors_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <a href="/studio/collectors-add"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>company</th>
                                <th>email</th>
                                <th>city</th>
                                <th>state</th>
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
                { data: 'first_name',
                    "render": function(data, type, row, meta){
                        if(row.first_name === null) { row.first_name = ''; }
                        if(row.last_name === null) { row.last_name = ''; }

                        if(type === 'display'){
                            data = '<a href="/studio/collectors-add?id=' + row.collector_id + '">' + row.first_name + ' ' + row.last_name + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'company'},
                { data: 'email'},
                { data: 'city'},
                { data: 'state'}
            ]
        } );
        
    });
</script>