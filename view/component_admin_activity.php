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
    
    switch($val['type']) {

        case "system":
            $typeClass = "system";
        break;

        case "success":
            $typeClass = "success";
        break;

        case "failure":
            $typeClass = "failure";
        break;

        default:
            $typeClass = "system";
        break;

    }

    $date = date("F j, Y h:i:s A", strtotime($val['created']));

    $result_html .= '<li class="item">';
    $result_html .= '<p class="' . $typeClass . '"><b>' . $date . '</b></p>';
    $result_html .= '<p class="' . $typeClass . '">[' . $val['type'] . ' event] ' . $val['value'] . '</p>';
    $result_html .= '</li>';

}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="activity--container">

    <h2>Recent Activity</h2>

        <ul class="mt-32">  

            $result_html
        
        </ul>

</article>
END;

return($html);

?>