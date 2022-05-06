<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   08-14-20
 * @Email:  james@jmcjmgalleries.com
 * @Filename: ajax_cheers_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 08-14-2020
 * @Copyright: 2017, 2019, 2020
 */

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

    $core->api_Admin_Update_Fieldnotes_Cheer($_POST['id']);
    print "Success";
    exit;