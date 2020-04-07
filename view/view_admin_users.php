<section class="usersidx--container">
    <div class="grid-12">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col-9 users--container">

            <div class="notification success <?= $notification_state ?>"><?= $notification_msg ?></div>

                    <div class="grid">
                        <div class="col">
                        <h2>Index of <b>Users</b> (<?= $active_users_count ?>)</h2>
                        </div>
                        <div class="col-1 add-icon">
                            <a href="/studio/users-add"><i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>

                    <table id="dataTable" class="display">
                        <thead>
                            <tr>
                                <th>username</th>
                                <th>name</th>
                                <th>act.type</th>
                                <th>lastlogin</th>
                                <th>ip</th>
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
                { data: 'username', 
                    "render": function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<a href="/studio/users-add?id=' + row.user_id + '">' + data + '</a>';
                        }  
                        return data;
                    } 
            },
                { data: 'a_first',
                    "render": function(data, type, row, meta){
                        if(type === 'display'){

                            if(row.c_first != null) { var name = row.c_first + ' ' + row.c_last; var id = row.collector_id; var p = 'collectors'; }
                            if(row.a_first != null) { var name = row.a_first + ' ' + row.a_last; var id = row.artist_id; var p = 'users'}

                            data = '<a href="/studio/' + p + '-add?id=' + id + '">' + name + '</a>';
                        }  
                        return data;
                    } 
                },
                { data: 'type'},
                { data: 'last_login'},
                { data: 'last_login_ip'}
            ]
        } );
        
    });
</script>