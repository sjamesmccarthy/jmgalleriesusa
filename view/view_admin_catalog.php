<section class="catalogidx--container">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col">
                            <h2 class="">Catalog of <b>Active Online Photos</b> (<?= $active_photos_count ?>)</h2></div>
                        <div class="col-1 add-icon"><a href="/studio/catalog-add"><i class="fas fa-plus-circle"></i></a></div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
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
       
        $('.notification').delay(5000).slideUp("slow").fadeOut(3000);

        $('#dataTable').DataTable( {
            paging: false,
            lengthMenu: [[75, 100, 175, -1], [75, 100, 175, "All"]],
            searching: true,
            oSearch: {"sSearch": "ACTIVE"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            if(row.category == "Oceans, Lakes & Waterfalls") { var cate_code = 'OLW'; }
                            if(row.category == "Flowers, Fields & Clouds") { var cate_code = 'FFC'; }
                            if(row.category == "Abstract, Architecture & People") { var cate_code = 'AAP'; }
                            if(row.category == "Mountains, Deserts & Trees") { var cate_code = 'MDT'; }
                            if(row.as_open == '1') { var ed = 'OT'; } else { var ed = 'LE'; }
                            if(row.featured     == '1') { var feat = '<i class="fas fa-asterisk"></i>'; } else { var feat = ''; }
                            data = feat + ' <a href="/studio/catalog-add?id=' + row.catalog_photo_id + '">' + data + ' ' + '(' + cate_code + row.catalog_photo_id + ed + ')</a>';
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
            "order": [[ 0, "asc" ]]
        } );
        
    });
</script>