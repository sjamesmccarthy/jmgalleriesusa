<section class="fieldnotes--container">
    <div class="grid-">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col fieldnotesidx--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col">
                        <h2>Index of <b>Field Notes</b> (<?= $active_fieldnotes_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <a href="/studio/fieldnotes-add"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>type</th>
                                <th>modified</th>
                                <th>created</th>
                                <th>status</th>
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
            // oSearch: {"sSearch": "draft"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/fieldnotes-add?id=' + row.fieldnotes_id + '">' + row.title + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'type'},
                { data: 'modified'},
                { data: 'created'},
                { data: 'status'}
            ],
            "order": [[ 2, "desc" ]],
            "columnDefs": [
                { "width": "45%", "targets": 0 }
              ]
        } );
        
    });
</script>