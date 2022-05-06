<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   11-27-2021 08:44:13 AM
 * @Email:  james@jmgalleries.com
 * @Filename: ajax_admin_products_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 11-27-2021 08:43:54 AM
 * @Last modified time: 
 * @Copyright: 2021
 */

  /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
	}

switch($_POST['formTypeAction']) {

	case "insert":
        $this->api_Admin_Insert_Fieldnotes();
		$redirect_to = '/fieldnotes';
	break;

	case "update":
		$this->api_Admin_Update_Fieldnotes();
		$redirect_to = '/fieldnotes';
	break;

	default:
	break;

}

header('location:/studio' . $redirect_to);

?>
