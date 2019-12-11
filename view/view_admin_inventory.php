<section class="catalogidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <h2>Index of <b>Inventory</b> (<?= $active_inventory_count ?>)</h2>
                    <p>Filter By: <a href="?filter=STUDIO">Studio</a>, <a href="?filter=HC">Home Collection</a>, <a href="?filter=DONATED">Donated</a>, <a href="?filter=COLLECTOR">Collector</a>, <a href="?filter=tinyviews">tinyViews</a>, <a href="?filter=DESTROYED">Destroyed</a>, <a href="/studio/inventory">reset</a></p>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Series</th>
                                <th>Edition</th>
                                <th>Max Ed.</th>
                                <th>Location</th>
                                <th>Created</th>
                                <th>Cost</th>
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
                { data: 'created' },
                { data: 'TOTAL_COST' },
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