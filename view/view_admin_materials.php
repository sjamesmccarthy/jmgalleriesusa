<section class="supplieridx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 inventory--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid">
                        <div class="col">
                        <h2>Index of <b>Materials</b> (<?= $active_materials_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <!-- <a href="/studio/suppliers-add"><i class="fas fa-plus-circle"></i></a> -->
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
                { data: 'material'},
                { data: 'material_type'},
                { data: 'company' },
                { data: 'quantity' },
                { data: 'unit_type'},
            ]
        } );
        
    });
</script>
    