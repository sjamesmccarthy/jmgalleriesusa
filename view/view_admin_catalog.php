<section class="catalogidx--container">
    <div class="grid">

        <!-- insert navigation component -->
        <?= $navigation_html ?>

        <div class="col catalog--container">

            <div class="notification <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col pb-0">
                            <h2>Catalog of <b>Online Photos</b> (<span class="current_recs"><?= $active_photos_count ?></span>/<?= $total_photos_count ?>)</h2>

                            <div class="tabs">
                                <div class="tab-ACTIVE" ><a href="?filter=ACTIVE">ACTIVE</a></div>
                                <div class="tab-DISABLED" ><a href="?filter=DISABLED">DISABLED</a></div>
                                <div class="tab-RETIRED" ><a href="?filter=RETIRED">RETIRED</a></div>
                                <div style="min-width: 10px">|</div>
                                <div class="tab-DONATED" ><a style="text-transform: lowercase;" href="javascript: $('#dataTable').DataTable().order([3, 'asc']).draw();">^LIMITED</a></div>
                                <div class="tab-COLLECTOR" ><a style="text-transform: lowercase;" href="javascript: $('#dataTable').DataTable().order([3, 'desc']).draw();">^OPEN</a></div>
                                <div class="tab-TINYVIEWS" ><a style="text-transform: lowercase;" href="javascript: $('#dataTable').DataTable().order([0, 'desc']).draw();">^HERO</a></div>
                                <div class="tab-INVENTORY" ><a style="text-transform: lowercase;" href="/studio/catalog"><i class="fas fa-times-circle"></i></a></div>
                            </div>
                        </div>
                        <div class="col-1 add-icon"><a href="/studio/catalog-add"><i class="fas fa-plus-circle"></i></a></div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Featured</th>
                                <th>Title</th>
                                <th>Catalog Category</th>
                                <th>Edition</th>
                                <th style="display: none">Status</th>
                                <th>Views</th>
                                <th>Last View</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

        </div>

    </div>
</section>

<script>
    jQuery(document).ready(function($){

       $(document).on('keyup','input[type=search]',function(){
           updateCount();
       });

        $('.tab-<?= $filter ?>').addClass('active');

        $('.notification').delay(5000).slideUp("slow").fadeOut(3000);

        $('#dataTable').DataTable( {
            paging: false,
            lengthMenu: [[75, 100, 175, -1], [75, 100, 175, "All"]],
            searching: true,
            oSearch: {"sSearch": "<?= $filter ?>"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'featured',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            if(row.featured     == '1') { var data = '<i class="fas fa-asterisk"></i>'; } else { var data = ''; }
                        }
                        return data;
                    }
                },
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            if(row.category == "Oceans, Lakes & Waterfalls") { var cate_code = 'OLW'; }
                            if(row.category == "Flowers, Fields & Clouds") { var cate_code = 'FFC'; }
                            if(row.category == "Abstract, Architecture & People") { var cate_code = 'AAP'; }
                            if(row.category == "Mountains, Deserts & Trees") { var cate_code = 'MDT'; }
                            if(row.as_open == '1') { var ed = 'OT'; } else { var ed = 'LE'; }
                            if(row.featured     == '1') { var feat = '<i class="fas fa-asterisk"></i>'; } else { var feat = ''; }
                            data = ' <a href="/studio/catalog-add?id=' + row.catalog_photo_id + '">' + data + ' ' + '</a><br><span style="font-size: .8rem;">' + cate_code + row.catalog_photo_id + ed + '_' + data.replace(/\s+/g, '-').toUpperCase() + '</span>';
                        }
                        return data;
                    }
                },
                { data: 'category' },
                { data: 'as_open',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            if(row.as_open == '1') { var edition = 'OPEN'; } else { var edition = 'LIMITED'; }
                            data = edition;
                        }
                        return data;
                    }
                },
                { data: 'status', "bVisible":false },
                { data: 'views' },
                { data: 'lastview',
                    "render": function(data, type, row, meta){
                        return data;
                    }
                }
            ],
            "order": [ 1, "asc" ],
            'columnDefs': [
                  {
                      "targets": 0, // your case first column
                      "className": "text-center",
                      "width": "5%"
                 }
             ]
        } );

        function updateCount() {
            var info = $('#dataTable').DataTable().page.info();
            $('.current_recs').html(info.recordsDisplay);
            console.log( info.recordsDisplay );
        }

        updateCount();
    });
</script>
