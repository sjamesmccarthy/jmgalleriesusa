<?php
/*
component: admin/reports
description: displays quick links to reports module
css: component_admin_reports.scss
data: db
created: jmccarthy
date: 11/24/19
version: 1
*/

/* Create an API call to get the Reports listings */
$reports_data = $this->api_Admin_Component_Reports();
// $this->console($reports_data);

foreach($reports_data as $key=>$val) {

    $result_html .= '<li class="item">';
    $result_html .= '<div class="detail">';
    $result_html .= '<p><i class="fas fa-project-diagram"></i> <a style="margin-left: .5rem;"  href="/studio/reports-add?id=' . $val['report_id'] . '"> ' . $val['name'] . '</a> (' . $val['desc'] . ')</p>';
    $result_html .= '<p class="tiny">' . $val['sql'] . '</p>';
    $result_html .= '</li>';

}

/* GENERATE HTML BLOCK */

$html = <<< END
<article class="reports-component--container">

<div class="table--box gray">
    <h4>Favorite Reports</h4>
</div>

    <ul>

        $result_html

    </ul>

</article>
END;

return($html);

?>
