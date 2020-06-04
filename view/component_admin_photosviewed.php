<?php
/* 
component: admin/photosviewed 
description: returns results of photos being viewed (not google analytics) 
css: component_admin_photosviewed.scss
data: db
created: jmccarthy
date: 11/24/19
version: 1
*/

/* Create an API call to get the Polarized listings */
$photosviewed_data = $this->api_Admin_Component_Photos_Viewed();

foreach($photosviewed_data as $key=>$val) {

    $date = date("h:i A, F j, Y", strtotime($val['updated']));
    if($val['as_gallery'] == '1') { $edition = 'Limited'; }
    if($val['as_studio'] == '1') { $edition = 'Studio'; }
    if($val['as_open'] == '1') { $edition = 'Open'; }

    $result_html .= '<li class="item">';
    $result_html .= '<div class="photo">';
    $result_html .= '<p><img src="/catalog/__thumbnail/' . $val['file_name'] . '.jpg" /></p>';
    $result_html .= '</div>';
    $result_html .= '<div class="detail">';
    $result_html .= '<p><b>' . $val['title'] . '</b></p>';
    $result_html .= '<p>' . $val['count'] . ' views @ ' . $date . '</p>';
    $result_html .= '<p>' . $edition . ' Edition</p>';
    $result_html .= '</div>';
    $result_html .= '</li>';

}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="photosviewed--container">

<div class="table--box gray">
    <h4>Viewed Catalog Photos</h4>
    <a target="_ga" href="https://analytics.google.com/analytics/web/#/report-home/a73077319w120066830p125611649">View Google Analytics</a>
</div>

    <ul style="margin-top: 32px;">  

       $result_html
       
    </ul>
</article>
END;

return($html);

?>