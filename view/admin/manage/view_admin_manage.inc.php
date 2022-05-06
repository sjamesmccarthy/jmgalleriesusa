 <?php

// $this->console($_SESSION,1);

/* Check for Session, Parse Session into vars */
if($this->checkSession()) {
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    // print "TRUE";
} else {
    // print "FALSE";
    header('location:/studio/signin');
}

    $today = date("F j, Y, g:i a");
    
    /* NAVIGATION */
    $navigation_html = $this->component('admin_navigation');

    /* QUICKSTATS */
    $quickstats_html = $this->component('admin_quickstats');
    
    /* ORDERS */
    $orders_html = $this->component('admin_orders');

    /* ACTIVITY */
    $activity_html = $this->component('admin_activity');

    /* PHOTOSVIEWED */
    $photosviewed_html = $this->component('admin_photosviewed');
    
    /* PHOTOSVIEWED */
    $reports_html = $this->component('admin_reports');

?>
