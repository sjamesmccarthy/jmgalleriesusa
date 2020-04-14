<?php


/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
} else {
    header('location:/d/collector/signin');
}

/* LOOK UP COLLECTOR */
$collector_data = $this->api_Admin_Get_Collector($_SESSION['collector_id']);
extract($collector_data, EXTR_PREFIX_ALL, "res");

/* YOUR COLLECTION */
$mycollection_html = $this->component('collector_my_collection',$res_collector_id);

/* POLARIZED */
$this->config->components['polarized'] = true;
$polarized_html = $this->component('polarized');

/* Copied From view_newsletter_email.inc.php file */
/* Need to find a better solution for this, whcih may be to deprecate the public view of the file and store this is a config file */
/* OR put this data into a JSON object and import using the getJSON() function */

$amazingoffer_json = $this->api_AmazingOffer_Get_Latest();
extract($amazingoffer_json, EXTR_PREFIX_ALL, "res");
// $this->printp_r($amazingoffer_json);

?>
