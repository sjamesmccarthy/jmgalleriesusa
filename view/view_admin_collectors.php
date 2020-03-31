<section class="collectorsidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 collector--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid">
                        <div class="col">
                        <h2>Index of <b>Collectors</b> (<?= $active_collectors_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <!-- <a href="/studio/suppliers-add"><i class="fas fa-plus-circle"></i></a> -->
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
                            data = row.first_name + ' ' + row.last_name;
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