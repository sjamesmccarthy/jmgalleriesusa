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

    $date = date("F j, Y h:i:s A", strtotime($val['updated']));

    $result_html .= '<li class="item">';
    $result_html .= '<div class="photo">';
    $result_html .= '<p><img src="/catalog/__thumbnail/' . $val['file_name'] . '.jpg" /></p>';
    $result_html .= '</div>';
    $result_html .= '<div class="detail">';
    $result_html .= '<p><b>' . $val['title'] . '</b></p>';
    $result_html .= '<p>Last Viewed ' . $date . '</p>';
    $result_html .= '<p>Total Views ' . $val['count'] . '</p>';
    $result_html .= '</div>';
    $result_html .= '</li>';

}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="photosviewed--container">

<h2>Viewed Catalog Photos</h2>
    <ul style="margin-top: 32px;">  

       $result_html
       
    </ul>
</article>
END;

return($html);

?>