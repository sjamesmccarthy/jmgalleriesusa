<?php
/* 
component: admin/activity 
description: returns results of all activity in the admin tool 
css: component_admin_activity.scss
data: db
created: jmccarthy
date: 11/24/19
version: 1
*/

/* Create an API call to get the Polarized listings */
$activity_data = $this->api_Admin_Component_Activity();

foreach($activity_data as $key=>$val) {
    
    /*
    <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
    */
    $date = date("F j, Y h:i:s A", strtotime($val['created']));

    $result_html .= '<li class="item">';
    $result_html .= '<p><b>' . $date . '</b></p>';
    $result_html .= '<p>[' . $val['type'] . ' event] ' . $val['value'] . '</p>';
    $result_html .= '</li>';

}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="activity--container">

    <h2>Recent Activity</h2>

        <ul style="margin-top: 32px;">  

            $result_html
        
        </ul>

</article>
END;

return($html);

?>