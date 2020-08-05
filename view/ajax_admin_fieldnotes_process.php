<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   12-07-2019 11:46:38 AM
 * @Email:  james@jmgalleries.com
 * @Filename: ajax_admin_catalog_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 12-07-2019 11:46:38 AM
 * @Last modified time: 12-07-2019 11:46:38 AM
 * @Copyright: 2019
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

// $this->console('ajax_fieldnotes().run',0);

switch($_POST['formTypeAction']) {

	case "insert":
        // $this->console('insert().run',0);
        $this->api_Admin_Insert_Fieldnotes();
		$redirect_to = '/fieldnotes';
	break;

	case "update":
        // $this->console('update().run',0);
		$this->api_Admin_Update_Fieldnotes();
		$redirect_to = '/fieldnotes';
	break;

	default:
	break;

}

header('location:/studio' . $redirect_to);

?>
