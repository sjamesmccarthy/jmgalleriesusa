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
$phpv = PHP_VERSION;
$mysqlv = $this->getVersion();

foreach($activity_data as $key=>$val) {

    switch($val['type']) {

        case "system":
            $typeClass = "system-log";
            $icon = '<i class="fas fa-server"></i>';
        break;

        case "success":
            $typeClass = "success-log";
            $icon = '<i class="fas fa-check-circle"></i>';
        break;

        case "warning":
            $typeClass = "warning-log";
            $icon = '<i class="fas fa-exclamation-circle"></i>';
        break;

        case "failure":
            $typeClass = "failure-log";
            $icon = '<i class="fas fa-bomb"></i>';
        break;

        default:
            $typeClass = "system-log";
            $icon = '<i class="fas fa-check-circle"></i>';
        break;

    }

    $date = date("F j, Y h:i:s A", strtotime($val['created']));

    $result_html .= '<li class="item ' . $typeClass . '"><div>';
    $result_html .= '<p class="small">' . $icon . ' <b style="margin-left: 1rem;">' . $date . '</b> >> ';
    $result_html .= '[' . $val['type'] . '] ' . $val['value'] . '</p>';
    $result_html .= '</div></li>';

}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="activity--container">

<div class="table--box gray">
    <h4>Recent Activity Log</h4>
    <span class="small">Health: <b>Good</b> | PHP v{$phpv} & MySQL v{$mysqlv} | <a href="/studio/settings">Settings</a></span>
</div>

    <ul>

        $result_html

    </ul>

</article>
END;

return($html);

?>
