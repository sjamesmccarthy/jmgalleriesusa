<section class="materialsidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 inventory--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col">
                        <h2>Index of <b>Suppliers</b> (<?= $active_suppliers_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <a href="/studio/suppliers-add"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Website</th>
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
                { data: 'company',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/suppliers-add?id=' + row.supplier_id + '">' + data + '</a>';
                        }  
                        return data;
                    } 
                },
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
                { data: 'email' },
                { data: 'phone' },
                { data: 'website',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="' + data + '">' + data + '</a>';
                        }  
                        return data;
                    } 
                },
            ],
            "columnDefs": [
                { "width": "20%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "20%", "targets": 2 },
                { "width": "20%", "targets": 3 },
                { "width": "20%", "targets": 4 }
            ]
        } );
        
    });
</script>