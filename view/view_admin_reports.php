<section class="reportsidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 reports--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid">
                        <div class="col">
                        <h2>Index of <b>Reports</b> (<?= $active_reports_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <!-- <a href="/studio/suppliers-add"><i class="fas fa-plus-circle"></i></a> -->
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>sql</th>
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
                { data: 'name',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="#">' + row.name + '</a><br />' + row.desc;
                        }  
                        return data;
                    } 
                },
                { data: 'sql'}
            ],
            "columnDefs": [
                { "width": "30%", "targets": 0 },
                { "width": "70%", "targets": 1 },
            ]
        } );
        
    });
</script>