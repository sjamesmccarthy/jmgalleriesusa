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
    if($val['as_limited'] == '1') { $edition = 'Limited'; }
    if($val['as_studio'] == '1') { $edition = 'Studio'; }
    if($val['as_open'] == '1') { $edition = 'Open'; }
    if($val['featured'] == '1') { $featured_icon = '<i class="fas fa-star-of-life"></i>'; $featured = '<p class="featured">' . $featured_icon . '</p>'; } else { $featured = null; $featured_icon = null; }
 
    $result_html .= '<li class="item">';
    $result_html .= '<div class="photo">';
    $result_html .= '<p><img src="/catalog/__thumbnail/' . $val['file_name'] . '.jpg"  alt="' . $val['file_name'] . '" /></p>';
    $result_html .= '</div>';
    $result_html .= '<div class="detail">';
    $result_html .= '<p><b>' . $featured_icon . '<a href="/studio/catalog-add?id=' . $val['catalog_photo_id'] . '"> ' . $val['title'] . '</a> (' . $edition . ' Edition)</b></p>';
    $result_html .= '<p class="small">Last viewed  @ ' . $date . ' (' . $val['count'] . ')</p>';
    // $result_html .= '<p class="small">' .  . ' Edition</p>';
    $result_html .= '</div>';
    $result_html .= '</li>';

}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="photosviewed--container">

<div class="table--box gray">
    <h4>Viewed Catalog Photos</h4>
    <span class="small"><a target="_ga" href="https://analytics.google.com/analytics/web/#/report-home/a73077319w120066830p125611649">View Google Analytics</a></span>
    <div class="add-icon">
        <a href="/studio/catalog-add"><i class="fas fa-plus-circle"></i></a>
    </div>
</div>
    
    <ul style="margin-top: 32px;">  

       $result_html
       
    </ul>
</article>
END;

return($html);

?>