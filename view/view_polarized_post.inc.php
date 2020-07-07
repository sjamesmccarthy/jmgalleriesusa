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
$fieldnotes_data = $this->api_Admin_Get_Fieldnotes_Item($this->page->fieldnotes_id);

// $this->console($fieldnotes_data);

extract($fieldnotes_data, EXTR_PREFIX_ALL, "res");

$content = explode('###', $res_content);
$sections = count($content);

if($sections == 2) {
    $res_content_leadin = $content[0];
    $res_content= "<p>".implode("</p><p>", explode("\n", $content[1]))."</p>";
} else {
    $res_content = "<p>".implode("</p>\n<p>", explode("\n", $content[0]))."</p>";
}

$read_time = $this->__readTime($res_count);
$res_created = date("F d, Y", strtotime($res_created));

/* Create social links */
// http://twitter.com/share?text=text goes here&url=http://url goes here&hashtags=hashtag1,hashtag2,hashtag3

$social_twitter = 'http://twitter.com/share?text=' . $res_title . '&url=' . 'https://jmgalleries.com/polarized/' . $res_short_path . '&hashtags=jmgalleriesusa';
$social_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . 'https://jmgalleries.com/polarized/' . $res_short_path . '&hashtags=jmgalleriesusa';
?>