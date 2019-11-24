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

/* Create an API call to get the Polarized listings 
$polarized_json = $this->api_Polarized_Get_Latest();

$count=0;
foreach($polarized_json as $key=>$value) {
    
    if($count === 3) { $content_border = null; } else { $content_border = 'content-border'; }

    $result .= '<div class="' . $grid_css . ' ' . $content_border . '">';
    $result .= '<h5><a target="_blog" href="' . $value['link']  . '">' . $value['title'] . '</a></h5>';
    $result .= '<p>' . $value['description'] . '</p>';
    $result .= '</div>';

    if($count === 3) { $count = 0; } else { $count++; }
}
*/

$date = date("F j, Y");

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="quickstats--container">

    <!-- <p class="title">Total Numbers As Of {$date}</p> -->

    <div class="grid table">
        <div class="col">
            <p class="table--title">CATALOG</p>
            <p class="table--count">54</p>
        </div>
        <div class="col">
            <p class="table--title">COLLECTORS</p>
            <p class="table--count">14</p>
        </div>
        <div class="col">
            <p class="table--title">ALL-TIME COSTS</p>
            <p class="table--count">2,345.89</p>
        </div>
        <div class="col">
            <p class="table--title">REVENUE</p>
            <p class="table--count">$4,987.12</p>
        </div>

    </div>
</article>
END;

return($html);

?>