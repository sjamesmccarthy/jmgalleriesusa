<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   09-15-20
 * @Email:  james@jmcjmgalleries.com
 * @Filename: ajax_fieldnotes_autosave.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 09-15-2020
 * @Copyright: 2017, 2019, 2020
 */

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

/* id */
$resp = $core->api_Admin_Update_Fieldnotes();
print $resp;
