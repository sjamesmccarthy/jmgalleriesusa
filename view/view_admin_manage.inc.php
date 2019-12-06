 <?php


    /* Check for Session, Parse Session into vars */
    if($this->checkSession()) {
        $loginInfo = json_decode( $_SESSION['data'], true );
        extract($loginInfo, EXTR_PREFIX_SAME, "dup");
    } else {
        header('location:/studio/signin');
    }

    /* Alot of work to just get the year */
    $shortdate = explode("-", $created);
    $year = $shortdate[0];

    /* NAVIGATION */
    $navigation_html = $this->component('admin_navigation');

    /* QUICKSTATS */
    $quickstats_html = $this->component('admin_quickstats');

    /* ACTIVITY */
    $activity_html = $this->component('admin_activity');

    /* PHOTOSVIEWED */
    $photosviewed_html = $this->component('admin_photosviewed');

?>
