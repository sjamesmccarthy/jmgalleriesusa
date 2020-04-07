<?php

/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
} else {
    header('location:/studio/signin');
}

/* CHECK TO SEE IF THIS IS AN EDIT OR ADD NEW */
if(isSet($this->routes->URI->queryvals)) {
    
    $edit_id = $this->routes->URI->queryvals[1];

    $edit_data = $this->api_Admin_Get_Collections_Item($edit_id);
    extract($edit_data, EXTR_PREFIX_ALL, "res");

    $this->page->title = "Editing Collection: <b>" . $res_title . "</b>";
    $formTypeAction = "update";
    $button_label="update collection";
    // $button_archive_cancel = '<button class="btn-delete mt-32" id="archive" value="ARCHIVE">archive supplier</button>';
    $button_archive_cancel = '<a class="cancel-button" href="/studio/collections">cancel</a>';
    $id_field = '<input type="hidden" name="catalog_collections_id" value="' . $res_catalog_collections_id . '" />';
} else {
    $formTypeAction = "insert";
    $button_label = "add new collection";
    $legacy_exp_field = null;
    $this->page->title = "Adding <b>New Collection</b>";
    $button_archive_cancel = '<a class="cancel-button" href="/studio/collections">cancel</a>';
}

/* NAVIGATION LOAD */
$navigation_html = $this->component('admin_navigation');

?>