<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   04-01-2020 07:10:38 AM
 * @Email:  james@jmgalleries.com
 * @Filename: ajax_admin_suppliers_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 04-01-2020 07:10:38 AM
 * @Last modified time: 
 * @Copyright: 2020
 */

  /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
	}
	
/* backup Existing config.json file */
include_once($_SERVER['DOCUMENT_ROOT'] . '/view/__ajax/ajax_settingsbackup.php');

/* apply settings update */
$this->api_Admin_Update_Settings();

$redirect_to = '/settings';
header('location:/studio' . $redirect_to);


?>
