<?php
/* 
component: POLARIZED 
description: returns the last 4 blog posts from medium
css: component_polarized.scss
created: jmccarthy
date: 8/28/19
version: 1
*/

/* Create an API call to get the Polarized listings */
$fieldnotes_data = $this->api_Admin_Get_Fieldnotes_Item($this->page->fieldnotes_id);

extract($fieldnotes_data, EXTR_PREFIX_ALL, "res");

$content = explode('###', $res_content);
$sections = count($content);

if($sections == 2) {
    $res_content_leadin = $content[0];
    $res_content = $content[1];
} else {
    $res_content_leading = null;
    $res_content = $content[0];
}

$res_content = str_replace('<div><br></div>', '', $res_content);
$res_content = str_replace('<p><br></p>', '', $res_content);

/* Check for image */
if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/image/fieldnotes/" . $res_image ) ) {
    $img_html .= '<div class="image">
        <img src="/view/image/fieldnotes/' . $res_image . '" /><br />
        <span class="caption"><?= $res_caption ?></span>
        </div>';
}

$read_time = $this->__readTime($res_count);
$res_created = date("F d, Y", strtotime($res_created));

/* Create social links */
$social_twitter = 'http://twitter.com/share?text=' . $res_title . '&url=' . 'https://jmgalleries.com/polarized/' . $res_short_path . '&hashtags=jmgalleriesusa';
$social_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . 'https://jmgalleries.com/polarized/' . $res_short_path . '&hashtags=jmgalleriesusa';
?>