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
	
 /* CHECK THE $formType INSERT or UPDATE */
 /* PROCESS THE DATABASE BEFORE THE FILE ATTACHMENTS */

switch($_POST['formTypeAction']) {

	case "insert":
		$this->api_Admin_Insert_Collections();
		$redirect_to = '/collections';
	break;
	
	case "update":
		$this->api_Admin_Update_Collections();
		$redirect_to = '/collections';
	break;

	case "delete":
		delete();
	break;

	default:
	break;

}

header('location:/studio' . $redirect_to);

?>
