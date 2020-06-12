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

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

$result = $core->api_Admin_Update_Reports('1');

exit;