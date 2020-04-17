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
$this->collector_data_obj = (object)$collector_data;

/* YOUR COLLECTION */
$mycollection_html = $this->component('collector_my_collection',$res_collector_id);

/* POLARIZED */
$this->config->components['polarized'] = true;
$polarized_html = $this->component('polarized');

/* MY REWARDS */
$myrewards_html = $this->component('rewards');

/* MY REWARDS */
$amazingoffer_html = $this->component('amazingoffer');

?>
