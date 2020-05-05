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

/* Create an API call to get the Notices */
$data_html = $this->getJSON('view/data_notices.json', 'data_notices');

$count=0;
foreach($data_html as $key => $value) {
       
    if($value['state'] == "true") {
        extract($data_html[$key], EXTR_OVERWRITE, "dup");

        if($value['timeout'] != "0") {
           $jquery = '    
                <script>
                jQuery(document).ready(function($){
              
                    $(".notice-container").fadeIn("fast").delay(' . $value['timeout'] . ').slideUp("slow");

                });
                </script>';
        }
    }
}

/* GENERATE HTML BLOCK */
if ($this->config->component_notice == 'true') {  
$html = <<< END
    <div class="notice-container notice-{$type}">
        <p class="notice-banner white">{$content}</p>
    </div>

    {$jquery}

END;
}

return($html);

?>