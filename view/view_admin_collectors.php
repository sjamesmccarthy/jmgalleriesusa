<section class="collectorsidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 collector--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid pt-32 nopad-left">
                        <div class="col nopad-left">
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