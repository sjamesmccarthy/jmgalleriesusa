 <?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   04-12-2017 7:34:05
 * @Email:  james@jmcjmgalleries.com
 * @Filename: ajax_email_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 05-22-2017 6:21:02
 * @Last modified time: 09-01-2019 08:07:45
 * @Copyright: 2017, 2019
 */

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$core = new Core_Site();

if ($_POST['pin'] != '') {
    if ($_POST['pin'] === $_POST['pin_check']) {
        $result = $core->api_Admin_Update_User();
    } else {
        $result = 0;
    }
} else { $result=0; }

if($result == 1) {
    print "200";
} else {
    print "404";
}

exit;
