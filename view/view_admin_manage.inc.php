 <?php
 
    /* PARSE SESSION JSON DATA FROM SIGNIN INTO VARS */
    $loginInfo = json_decode( $_SESSION['data'], true );
    extract($loginInfo, EXTR_PREFIX_SAME, "dup");

    /* Alot of work to just get the year */
    $timestamp = $created;
    $datetime = explode(" ",$timestamp);
    $date = $datetime[0];
    $shortdate = explode("-", $date);
    $year = $shortdate[0];

    /* QUICKSTATS */
    $quickstats_html = $this->component('admin_quickstats');

    /* ACTIVITY */
    $activity_html = $this->component('admin_activity');

    /* PHOTOSVIEWED */
    $photosviewed_html = $this->component('admin_photosviewed');

?>