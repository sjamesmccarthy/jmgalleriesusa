<?php
/* 
component: POLARIZED 
description: returns the last 4 blog posts from medium
css: component_polarized.scss
data: data_polatized.json
created: jmccarthy
date: 8/28/19
version: 1
*/

/* Create an API call to get the Polarized listings */
$polarized_json = $this->api_Polarized_Get_Latest();

$count=0;
foreach($polarized_json as $key=>$value) {
    
    if($count === 3) { $content_border = null; } else { $content_border = 'content-border'; }

    /* For Mobile */
    /* On last two thumbnails add some css */
    if($count == 2) {
        $grid_css = 'col sm-hidden';
    } else if ($count == 3) {
        $grid_css = 'col sm-hidden md-hidden';
    } else {
        $grid_css = 'col';
    }

    $result .= '<div class="' . $grid_css . ' ' . $content_border . '">';
    $result .= '<h5><a target="_blog" href="' . $value['link']  . '">' . $value['title'] . '</a></h5>';
    $result .= '<p>' . $value['description'] . '</p>';
    $result .= '</div>';

    if($count === 3) { $count = 0; } else { $count++; }
}

/* GENERATE HTML BLOCK */
if ($this->config->components['medium_blog'] == 'true') {  
$html = <<< END
        <article>
            <div class="grid-4_sm-2_md-3">
                <div class="col-11" style="margin-bottom: 16px;">
                    <h2><a target="_new" href="https://medium.com/jmgalleriesusa">POLARIZED</a></h2>
                    <p>a Photographic Conversation & Quarterly</p>
                </div>
                
                $result

            </div>
        </article>
END;
}

return($html);

?>