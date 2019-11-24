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
<article class="photosviewed--container">

<h2>Viewed Catalog Photos</h2>
    <ul style="margin-top: 32px;">  
        <li style="margin-bottom: 16px; border-bottom: 1px solid #CCC; padding-bottom: 10px;">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/blades-of-balboa.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
        <li style="margin-bottom: 16px; border-bottom: 1px solid #CCC; padding-bottom: 10px;">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/natural-beauty.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
        <li style="margin-bottom: 16px; border-bottom: 1px solid #CCC; padding-bottom: 10px;">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/blades-of-balboa.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
        <li style="margin-bottom: 16px; border-bottom: 1px solid #CCC; padding-bottom: 10px;">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/wandering.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
        <li style="margin-bottom: 16px; border-bottom: 1px solid #CCC; padding-bottom: 10px;">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/winemaker-walkabout.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
        <li style="margin-bottom: 16px; border-bottom: 1px solid #CCC; padding-bottom: 10px;">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/rays-of-light.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
        <li style="margin-bottom: 16px; border-bottom: 1px solid #CCC; padding-bottom: 10px;">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/blades-of-balboa.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
        <li style="margin-bottom: 16px; border-bottom: 1px solid #CCC; padding-bottom: 10px;">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/run-aground.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
        <li style="margin-bottom: 16px; ">
            <div style="display: inline-block;">
                <p><img style="width: 120px;" src="/catalog/__thumbnail/stoned-lovers.jpg" /></p>
            </div>
            <div style="display: inline-block; vertical-align: top; padding-left: 20px;">
                <p><b>Blades of Balboa</b></p>
                <p>Last Viewed 11/24/2019 3:45 PM</p>
                <p>Total Views: 123</p>
            </div>
        </li>
    </ul>
</article>
END;

return($html);

?>