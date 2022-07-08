<section class="reports--container">
    <div class="grid">

        <!-- insert navigation component -->
        <?= $navigation_html ?>

        <div class="col reportsidx--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

            <div class="grid admin-header">
                <div class="col">
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
                        <th>desc</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>

    </div>
</section>

<script>
    jQuery(document).ready(function($) {

        $('.notification').delay(5000).slideUp("slow").fadeOut(3000);

        $('#dataTable').DataTable({
            processing: true,
            paging: false,
            pagingType: "numbers",
            searching: false,
            // oSearch: {"sSearch": "<?= $filter ?>"},
            data: <?= $data_json ?>,
            columns: [{
                    data: 'fav',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            if (row.fav == 1) {
                                data = '<i class="fas fa-bookmark"></i>';
                            } else {
                                data = '';
                            }
                        }
                        return data;
                    }
                },
                {
                    data: 'name',
                    "render": function(data, type, row, meta) {
                        if (type === 'display') {
                            data = '<a href="/studio/reports-add?id=' + row.report_id + '">' + row.name + '</a>';
                        }
                        return data;
                    }
                },
                {
                    data: 'desc'
                }
            ],
            "columnDefs": [{
                    "width": "2%",
                    "targets": 0
                },
                {
                    "width": "40%",
                    "targets": 1
                },
                {
                    "width": "58%",
                    "targets": 2
                },
                {
                    className: "valign",
                    "targets": [0, 1]
                }
            ],
            "order": [
                [0, "desc"]
            ]
        });

    });
</script>
