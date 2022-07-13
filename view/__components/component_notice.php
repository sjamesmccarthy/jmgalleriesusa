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
$data_html = $this->getJSON('view/__data/data_notices.json', 'data_notices');

$count=0;
foreach($data_html as $key => $value) {

    if($value['state'] == "true" && $this->config->component_notice == $key) {
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
if ($this->config->component_notice != 'false') {

$exclude_matches = explode(",", $excludes);
// if(isSet($this->data->routePathQuery[0])) { $this->page->catalog_path_tmp = $this->data->routePathQuery[0]; } else { $this->page->catalog_path_tmp = $this->page->catalog_path; }

foreach ($exclude_matches as $exclude => $excludeValue) {
    if (preg_match("/" . $excludeValue . "/i", $this->page->catalog_path)) {
        // print "preg_match: FOUND -- ";
        $match = "FOUND";
    } else {
        // print "preg_match: NO MATCH --";
        // print $this->page->catalog_path . "<br />";
        // print_r($exclude_matches);
    }
}

if($match == "FOUND") {
    $html = null;
} else {
    $content = stripslashes($content);
    $mobile_content = stripslashes($mobile_content);

    $html = <<< END
        <div class="notice-container notice-{$key}">
            <p class="notice-banner" style="background-color: {$background_color}; color:{$color}">{$content}</p>
            <p class="notice-banner-mobile" style="background-color: {$background_color}; color:{$color}">{$mobile_content}</p>
        </div>

        {$jquery}

    END;
}

}

return($html);

?>
