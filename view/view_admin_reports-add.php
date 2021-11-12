<section class="admin--reports-add">
    <div class="grid">
       
        <!-- insert navigation component -->
        <?= $navigation_html ?>
    
        <div class="col reports-add--container">

            <div class="notification success <?= $notification_state ?>"><?= $_SESSION['notification_msg'] ?></div>

            <div class="grid admin-header">
                <div class="col pb-0">
                    <h2><?= $this->page->title ?></h2>
                    <p class="close-x"><i class="fas fa-times-circle"></i></p>
                    
                    <div class="tabs"> 
                        <div class="tab-SQL <?= $active_filter ?>">SQL</div>
                        <div class="tab-RESULT" ><a href="?id=<?= $res_report_id ?>&report=true">RESULT</a></div>
                    </div>
                </div>
            </div>

        <div id='form_sql' class="<?= $form_sql_state ?>">

                <form id="reports-add" action="/studio/api/update/reports" method="POST">
                <input type="hidden" id="formTypeAction" name="formTypeAction" value="<?= $formTypeAction ?>" />
                <?= $id_field ?>
                <input type="hidden" id="artist_id" name="artist_id" value="1" />

                <div>
                    <label>name</label>
                    <input class="half-size" maxlength="255" type="text" id="name" name="name" placeholder="NAME (eg, ALL DONATED ARTWORK)" value="<?= $res_name ?>" required>
                    <label>description</label>
                    <input class="half-size" maxlength="255" type="text" id="desc" name="desc" placeholder="DESCRIPTION (eg, Report showing all donated artwork to date)" value="<?= $res_desc ?>">
                </div>

                <div>
                    <p style="width:75%; float: left;">
                    <label>columns</label>
                    <input class="" type="text" id="columns" name="columns" placeholder="COLUMNS (eg, id,firstname,lastname,email,phone)" value="<?= $res_columns ?>" />
                    </p>

                    <p class="pt-16" style="width: 24%; float:right; margin-left: 8px;">
                      <input type="checkbox" id="fav" name="fav" value="1" <?= ($res_fav == "1" ? "CHECKED" : ""); ?> /> 
                      <label for="fav" style="font-size: 1.2rem; background-color: transparent;">Mark As Favorite</label>
                    </p>

                </div>

                <div style="clear: both">
                    <label>sql</label>
                    <textarea id="sql_c" name="sql_c"><?= $res_sql ?></textarea>
                </div>
                
                <div>
                    <div class="half-size valign-top green"><span class="sql_e_banner tiny ml-16">SQL Saved (</span><span class="sql_e_banner_count tiny">0</span><span class="sql_e_banner tiny">)</span></div>
                    <div class="half-size"><p id="sql_e" class="btn_small_gray pull-right ml-8 active">Edit SQL</p>
                    </div>
                </div>

                <div class="clear">
                    <button class="mt-32 <?= $button_state ?>" id="sendform" value="SEND"><?= $button_label ?></button>
                    <!-- <p class="mt-8 small">*Saving the report will not run the query. It will return you back to the Reports Index.</p> -->
                </div>

                </form>

                <p id="form_response"> </p>
        </div>

        <div id="form_result" class="<?= $form_result_state ?>">
             
             <table id="dataTable" class="display">
                <thead>
                    <tr>
                        <?= $table_keys ?>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <div class="sql_res pb-32">
                <p class="pt-32">SQL.statement</p>
                <p><?= $res_sql ?></p>

                <p class="pt-32">SQL.headers</p>
                <p><?= $dataTableColumns ?></p>

                <p class="pt-32">SQl.data</p>
                <p><?= $result_json ?></p>

            </div>

            <script>
               $('#dataTable').DataTable( {
                    processing: true,
                    paging: false,
                    pagingType: "numbers",
                    searching: false,
                    data: <?= $result_json ?>,
                    columns: [
                       <?= $dataTableColumns ?>
                    ]
                } );
            </script>
       </div>

    </div>
</section>

<script>
jQuery(document).ready(function($){

    $('.close-x').on("click", function() {
        window.location.href = '/studio/reports';
    });

    $('.tab-<?= $filter ?>').addClass('active');

    $('input').on("keypress", function() {
        $('#sendform').show();
    });

    $('#sql_c').on("keypress, keydown", function() {
        $('#sql_e').removeClass('active');
        $('#sql_e').html('Save SQL');
    });

    $('#sql_e').on("click", function() {

        if( $('#sql_e').text() == "Save SQL" ) {
        $('#sql_e').addClass('active').html("Edit SQL");

            var url = "/view/ajax_admin_reports_sql_update.php";

            $.ajax({
              type: "POST",
              url: url,
              data: $('#reports-add').serialize(),
              async: true,
              success: function(data)
              {
                  console.log(data);
                      var edit_count = parseInt( $('.sql_e_banner_count').text() );
                    ++edit_count;
                    $('.sql_e_banner_count').html(edit_count);
                    $('.sql_e_banner, .sql_e_banner_count').show();
                    // $('.notification').show().delay(5000).slideUp("slow").fadeOut(3000);
              },
              error : function(request,error) {
                  console.log("FAIL-Request: "+JSON.stringify(request));
              }
            });
            
        }

    });

    // $('#sql_r').on("click", function() {
    //     $('#form_sql').hide();
    //     $('#form_result').show();
    //     $('.tab-SQL').removeClass('active');
    //     $('.tab-RESULT').addClass('active');

    //     var url = "/view/ajax_admin_reports_sql_run.php";
    //     var sql_t = $('#sql_c').val();

    //     $.ajax({
    //       type: "POST",
    //       url: url,
    //       data: { sql_t },
    //       async: true,
    //       success: function(data)
    //       {
    //           console.log(data);
    //           $('.sql_res').html(data);
    //       },
    //       error : function(request,error) {
    //           console.log("Request: "+JSON.stringify(request));
    //       }
    //     });

    // });
    
    $('.tab-SQL').on("click", function() {
        console.log('tab-SQL-click');
        $('#form_result').hide();
        $('#form_sql').removeClass('noshow');
        $('#form_sql').show();
        $('.tab-RESULT').removeClass('active');
        $('.tab-SQL').addClass('active');
    });
    
    $('.tab-menu').on("click", function() {
       $('.tab-menu').removeClass("active");
       $('.tab-' + $(this).attr("data-name") ).addClass('active');
       console.log('changing tab active: ' + '.tab-' + $(this).attr("data-name"));
    });

    $('#sendform').on("click", function() {
        $(":input[required]").each(function () {                     
        var myForm = $('#sendform');
        if (!$myForm[0].checkValidity()) 
          {                
            $('#suppliers-add').submit();               
          } 
        });
    });

    $('#archive').on("click", function(e) {
        e.preventDefault();
        alert('This Feature Not Available At This Time');
    });

});

</script>