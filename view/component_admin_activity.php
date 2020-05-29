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
            $typeClass = "system-log";
        break;

        case "success":
            $typeClass = "success-log";
        break;

        case "warning":
            $typeClass = "warning-log";
        break;

        case "failure":
            $typeClass = "failure-log";
        break;

        default:
            $typeClass = "system-log";
        break;

    }

    $date = date("F j, Y h:i:s A", strtotime($val['created']));

    $result_html .= '<li class="item ' . $typeClass . '">';
    $result_html .= '<b>' . $date . '</b><br />';
    $result_html .= '[' . $val['type'] . '] ' . $val['value'];
    $result_html .= '</li>';

}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="activity--container">

    <h4>Recent Activity Log</h4>

        <ul class="mt-32">  

            $result_html
        
        </ul>

</article>
END;

return($html);

?>