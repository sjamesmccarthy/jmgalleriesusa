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
<article class="activity--container">

    <h2>Recent Activity</h2>
    <ul style="margin-top: 32px;">  
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li style="margin-bottom: 16px;">
            <p><b>Sun, November 24, 2019 10:23 AM</b></p>
            <p>Added new photo to Oceans, Lakes and Waterfalls catalog titled "Sunrise Song". 
        </li>
        <li><p><a href="">View More Activity</a></p></li>
    </ul>

</article>
END;

return($html);

?>