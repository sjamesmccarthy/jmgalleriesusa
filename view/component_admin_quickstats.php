<?php
/* 
component: admin/quickstats 
description: returns high level numbers 
css: component_admin_quickstats.scss
data: db
created: jmccarthy
date: 11/24/19
version: 1
*/

/* Create an API call to get the Polarized listings */
$tCat = number_format($this->api_Admin_Component_QuickView_tCat());
$tCollectors = number_format($this->api_Admin_Component_QuickView_tCollectors());
$tCosts = number_format($this->api_Admin_Component_QuickView_tCosts());
$tRevenue = number_format($this->api_Admin_Component_QuickView_tRevenue());

foreach ($this->data_notices as $key => $val) {
    if ($val['state'] == "true") {

        if($this->config->component_notice == "false") {
                $config_notice_set = '<br />Also, the config->component_notice =' . $this->config->component_notice . ', this needs updating. ';
        } 

        $notice_alert = '    
        <div class="grid table">
            <div class="col table--box sunset-bkg mt-16">
                <p class="table--msg">The <b>' . $val['title'] . ' Notification</b> is currently in active, or flag set to true. ' . $config_notice_set . '</p>
                <p class="table--msg pull-right link"><a href="/studio/settings#components">change</a></p>
            </div>
        </div>';
    } else {
        // $notice_alert = null;
    }
}

/* GENERATE HTML BLOCK */
$html = <<< END
<article class="quickstats--container">

    <!-- <p class="title">Total Numbers As Of {$date}</p> -->

    <div class="grid table">
        <div class="col table--box gray">
            <p class="table--title gray-bkg">Catalog</p>
            <p class="table--count">$tCat</p>
            <p class="table--subline">Active Online Photos</p>
        </div>
        <div class="col  table--box gold">
            <p class="table--title gold-bkg">Collectors</p>
            <p class="table--count">$tCollectors</p>
            <p class="table--subline">Does Not Include Corporate</p>
        </div>
        <div class="col  table--box red">
            <p class="table--title red-bkg">Expenses</p>
            <p class="table--count">$$tCosts</p>
            <p class="table--subline">Excludes Damaged, Donated</p>
        </div>
        <div class="col  table--box green">
            <p class="table--title green-bkg">Revenue</p>
            <p class="table--count">$$tRevenue</p>
            <p class="table--subline">From Beginning of Time</p>
        </div>

    </div>

    {$notice_alert}

</article>
END;

return($html);

?>