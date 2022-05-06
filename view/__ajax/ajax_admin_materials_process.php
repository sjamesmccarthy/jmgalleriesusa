<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   04-01-2020 10:14:38 AM
 * @Email:  james@jmgalleries.com
 * @Filename: ajax_admin_materials_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 04-01-2020 10:14:38 AM
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
		$this->api_Admin_Insert_Materials();
		if(isSet($_POST['supplier_redirect'])) { 
			$redirect_to = '/suppliers-add?id=' . $_POST['supplier_redirect'];
		}
		else {
			$redirect_to = '/materials';
		}
	break;
	
	case "update":
		$this->api_Admin_Update_Materials();
		if(isSet($_POST['supplier_redirect'])) { 
			$redirect_to = '/suppliers-add?id=' . $_POST['supplier_redirect'];
		}
		else {
			$redirect_to = '/materials';
		}
	break;

	case "delete":
		delete();
	break;

	default:
	break;

}

header('location:/studio' . $redirect_to);

?>
