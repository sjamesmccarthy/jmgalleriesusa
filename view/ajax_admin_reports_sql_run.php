<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   06-09-2020
 * @Email:  james@jmcjmgalleries.com
 * @Filename: ajax_admin_reports_sql_run.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 06-09-2020
 * @Last modified time: 
 * @Copyright: 2020
 */

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

$result = $core->api_Admin_Get_Reports_Sql($_POST['sql_t']);
$result_json = json_encode($result);
$columns = array_keys($result[0]);

foreach ($columns as $key => $val) {
    $table_keys .= "<th>" . $val . "</th>";
    $dataTableColumns .= "{ data:'" . $val . "'},"; 
}

 $html = <<< END
     <table id="dataTable" class="display">
        <thead>
            <tr>
               {$table_keys}
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    END;

// print $html;

print $result_json;
print "<hr />";
print_r($columns);

exit;