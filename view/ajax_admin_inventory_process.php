<?php
/**
 * @Author: James McCarthy <sjamesmccarthy>
 * @Date:   01-02-2019 11:46:38 AM
 * @Email:  james@jmgalleries.com
 * @Filename: ajax_admin_inventory_process.php
 * @Last modified by:   sjamesmccarthy
 * @Created  date: 01-02-2019 11:46:38 AM
 * @Last modified time: 11-26-2021 08:05:35 AM
 * @Copyright: 2019, 2021
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
		$this->api_Admin_Insert_Inventory();
		$this->api_Admin_Update_Inventory_Location();
		
		/* If this is LIMITED, STUDIO edition AND lcoation_id is COLLECTOR add collector data */
		if($_POST['edition_style'] == 'LIMITED' || $_POST['edition_style'] == 'STUDIO' && $_POST['art_location'] == 3) {
			$this->api_Admin_Update_Inventory_Collector();
		}
		
		$this->api_Admin_Update_Inventory_Expenses();
        if(isSet($_POST['orders_redirect'])) { 
			$redirect_to = '/orders-add?id=' . $_POST['orders_redirect'];
		}
		else {
			$redirect_to = '/inventory';
		}

	break;
	
	case "update":
		$this->api_Admin_Update_Inventory();
		$this->api_Admin_Update_Inventory_Location();
		
		/* If this is LIMITED, STUDIO edition AND lcoation_id is COLLECTOR add collector data */
		if($_POST['edition_style'] == 'LIMITED' || $_POST['edition_style'] == 'STUDIO' && $_POST['art_location'] == 3) {
			$this->api_Admin_Update_Inventory_Collector();
		}
		
		$this->api_Admin_Update_Inventory_Expenses();
		$redirect_to = '/inventory';
	break;

	case "delete":
		delete();
	break;

	default:
	break;

}

header('location:/studio' . $redirect_to);

?>
