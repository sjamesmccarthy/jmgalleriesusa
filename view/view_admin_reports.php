<section class="reportsidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 reports--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid pt-32">
                        <div class="col nopad-left">
                        <h2>Index of <b>Reports / SQL Marks</b> (<?= $active_reports_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <a href="/studio/reports-add"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th></th>
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
                { data: 'fav', "render": function(data, type, row, meta){
                        if(type === 'display'){
                            if(row.fav == 1) { 
                                data = '<i class="fas fa-bookmark"></i>';
                            } else { 
                                data = '';
                            }
                        }  
                        return data;
                    } 
                },
                { data: 'name',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/reports-add?id=' + row.report_id + '">' + row.name + '</a><br />' + row.desc;
                        }  
                        return data;
                    } 
                },
                { data: 'sql'}
            ],
            "columnDefs": [
                { "width": "2%", "targets": 0 },
                { "width": "27%", "targets": 1 },
                { "width": "70%", "targets": 2 },
                { className: "valign", "targets": [ 0,1 ] }
            ],
            "order": [[ 0, "desc" ]]
        } );
        
    });
</script>