<section class="admin--section">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 catalog--container">

                    <h2 class="pb-32">Catalog of Online Photos</h2>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Catalog Category</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

        </div>

    </div>
</section>

<script>
    jQuery(document).ready(function($){
       
        var dataTables_sample = [
            [
                "Never Ending Story",
                "Oceans, Lakes & Waterfalls",
                "230"
            ],
            [
                "Happy Hour Club",
                "Architecture, Abstract & People",
                "400"
            ]
        ]
    
        $('#dataTable').DataTable( {
            paging: false,
            searching: false,
            data: dataTables_sample
        } );
        
    });
</script>