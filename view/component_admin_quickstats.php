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

/* GENERATE HTML BLOCK */
$html = <<< END
<article class="quickstats--container">

    <!-- <p class="title">Total Numbers As Of {$date}</p> -->

    <div class="grid table">
        <div class="col">
            <p class="table--title">CATALOG</p>
            <p class="table--count">$tCat</p>
            <p class="table--subline">Active Online Photos</p>
        </div>
        <div class="col">
            <p class="table--title">COLLECTORS</p>
            <p class="table--count">$tCollectors</p>
            <p class="table--subline">Individual Only</p>
        </div>
        <div class="col">
            <p class="table--title">ALL-TIME COSTS</p>
            <p class="table--count">$$tCosts</p>
            <p class="table--subline">YoY</p>
        </div>
        <div class="col">
            <p class="table--title">REVENUE</p>
            <p class="table--count">$$tRevenue</p>
            <p class="table--subline">YoY</p>
        </div>

    </div>
</article>
END;

return($html);

?>