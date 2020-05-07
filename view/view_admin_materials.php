<section class="supplieridx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 inventory--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid pt-32">
                        <div class="col nopad-left">
                        <h2>Index of <b>Materials</b> (<?= $active_materials_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <a href="/studio/materials-add"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>material</th>
                                <th>material type</th>
                                <th>supplier</th>
                                <th>quantity</th>
                                <th>unit type</th>
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
                { data: 'material', 
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data =  '<a href="/studio/materials-add?id=' + row.supplier_materials_id + '">' + data + '</a>';
                        }  
                        return data;
                    }
                },
                { data: 'material_type'},
                { data: 'company',
                    "render": function(data, type, row, meta){
                        if(row.company === null) { row.company = "Manual Entry"; var ahref = ''; var ahref_c = ''; } 
                        else { var ahref = '<a href="/studio/suppliers-add?id=' + row.supplier_id + '">'; var ahref_c = '</a>'; }

                        if(type === 'display'){
                            data =  ahref + row.company + ahref_c;
                        }  
                        return data;
                    } 
                },
                { data: 'quantity' },
                { data: 'unit_type'},
            ]
        } );
        
    });
</script>
    