<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   08-19-20
 * @Email:  james@jmcjmgalleries.com
 * @Filename: ajax_fieldnotes_responses_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 08-19-2020
 * @Copyright: 2017, 2019, 2020
 */

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

$resp = $core->api_Admin_Insert_Fieldnotes_Responses();
// $core->console($_POST);
print $resp;
