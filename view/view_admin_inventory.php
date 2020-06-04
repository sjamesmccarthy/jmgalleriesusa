<section class="inventoryidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 inventory--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid admin-header">
                        <div class="col pb-0">
                        <h2>Index of <b>Inventory</b> (<?= $active_inventory_count ?>)</h2>
                        
                            <div class="tabs"> 
                                <div><a href="?filter=STUDIO">STUDIO</a></div>
                                <div><a href="?filter=HC">HOME COLLECTION</a></div>
                                <div><a href="?filter=DONATED">DONATED</a></div>
                                <div><a href="?filter=COLLECTOR">COLLECTOR</a></div>
                                <div><a href="?filter=tinyviews">tinyVIEWS</a></div>
                                <div><a href="?filter=DESTROYED">DESTROYED</a></div>
                                <div><a href="/studio/inventory"><i class="fas fa-times-circle"></i></a></div>
                            </div>

                        </div>
                        <div class="col-1 add-icon"><a href="/studio/inventory-add"><i class="fas fa-plus-circle"></i></a></div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Series</th>
                                <th>Edition</th>
                                <th>Max Ed.</th>
                                <th>Location</th>
                                <!-- <th>Created</th> -->
                                <!-- <th>Cost</th> -->
                                <th>Value</th>
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
            oSearch: {"sSearch": "<?= $filter ?>"},
            data: <?= $data_json ?>,
            columns: [
                { data: 'title',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/inventory-add?id=' + row.art_id + '">' + data + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'series_num' },
                { data: 'edition_num' },
                { data: 'edition_num_max' },
                { data: 'location' },
                // { data: 'created' },
                // { data: 'TOTAL_COST' },
                { data: 'TOTAL_VALUE' }
            ]
        } );
        
    });

    /*
SELECT
	A.art_id,
	A.title as art_title,
	S.supplier_id,
	S.company as supplier,
	ACS.supplier_materials_id,
	SM.material_type,
	SM.quantity as quantity_bought,
	ACS.usage as material_used,
	SM.unit_type,
	SM.material as material_desc,
	(SM.quantity - ACS.usage) AS calcd_inventory,
	if( SM.unit_type = 'single', SM.cost, (SM.quantity / (SM.quantity - ACS.usage)) ) as calcd_cost
FROM
	art AS A
	INNER JOIN art_costs_supplier AS ACS ON A.art_id = ACS.art_id
	INNER JOIN supplier_materials AS SM ON ACS.supplier_materials_id = SM.supplier_materials_id
	INNER JOIN supplier AS S ON SM.supplier_id = S.supplier_id
WHERE
	A.art_id = 110
	
-- Update SM.inventory with calcd_inventory

    */

</script>