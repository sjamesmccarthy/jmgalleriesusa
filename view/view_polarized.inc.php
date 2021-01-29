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
$fieldnotes_data = $this->api_Admin_Get_Fieldnotes("published");
// extract($fieldnotes_data, EXTR_PREFIX_ALL, "res");

$i=0;
foreach ($fieldnotes_data as $key => $value) {

    $content = explode('###', $value['content']);
    $sections = count($content);

    if($sections == 2) {
        $content_leadin = strip_tags($content[0]);
        $content_leadin_short = substr( $content_leadin, 0, strrpos( substr( $content_leadin, 0, 130), ' ' ) ) . '...';
        $content = nl2br($content[1]);
    } else {
        $content_leadin_short = null;
        $content = nl2br($content[0]);
    }

    $read_time = $this->__readTime($value['count']);

    switch($value['type']) {

        case "article":
            $read_time_label = $read_time;
            $icon_type = 'fas fa-file-invoice';
        break;

        case "video":
            $read_time_label = $value['count'] . ' MIN WATCH';
            $icon_type = 'fab fa-youtube';
        break;

        case "filmstrip":
            $read_time_label = $value['teaser'];
            $icon_type = 'fas fa-film';
        break;

        default:
        $read_time = $read_time;
        $icon_type = 'invoice';
        break;
    }

    /* Check for image */
    if ( is_file($_SERVER['DOCUMENT_ROOT'] . "/view/image/fieldnotes/" . $value['image'] ) ) {
        $img_html = '<img src="/view/image/fieldnotes/' . $value['image'] . '" alt="' . $value['image'] . '" /></a>';
        $value['title'] = mb_strimwidth($value['title'], 0, 65, "...");
        $img_div = '1';
    } else {
        $img_html = null;
        $value['title'] = mb_strimwidth($value['title'], 0, 125, "...");
        $img_div = '0';
    }

    $card_html .= '<div class="card--wrapper">';
    $card_html .= '<div class="card--content">';
    $card_html .= '<div class="card--type">' . strtoupper($value['type']) . '</div>';
    $card_html .= '<div class="card--byline">user_id: ' . $value['user_id'] . '</div>';
    $card_html .= '<div class="card--title"><a href="/polarized/' . $value['short_path'] . '">' . $value['title'] . '</a></div>';
    $card_html .= '<div class="card--readtime">' . $read_time_label . '</div>';
    $card_html .= '</div>';

    if($img_div == '1') {
        $card_html .= '<div class="card--image-wrapper" style="background: rgba(0,0,0,0) url(/view/image/fieldnotes/' . $value['image'] . ') no-repeat center; background-size: cover; word-break: break-word;">';
        $card_html .= '<i class="' . $icon_type . ' card--image-icon"></i>';
        $card_html .= '</div>';
    }

    $card_html .= '</div>';

}

?>