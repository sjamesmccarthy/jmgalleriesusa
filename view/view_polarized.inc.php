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
    
    $data_filter_N = null;
    $data_filter_Y = null;
    $data_filter_F = null;
    
    $content = explode('###', $value['content']);
    $sections = count($content);

    if($sections == 2) {
        $content_leadin = strip_tags($content[0]);
        $content_leadin_short = substr( $content_leadin, 0, strrpos( substr( $content_leadin, 0, 150), ' ' ) ) . '...';
        $content = nl2br($content[1]);
    } else {
        $content_leadin_short = $value['teaser']; /* null */
        $content = nl2br($content[0]);
    }

    $read_time = $this->__readTime($value['count']);
    $published_date =strtoupper ( date("M j", strtotime($value['created'])) );
    
    switch($value['type']) {

        case "article":
            $read_time_label = $read_time;
            $icon_type = 'fas fa-file-invoice';
            $value['teaser'] = $content_snip;
            $data_filter_N = 'f-notes'; 
        break;

        case "video":
            // $read_time_label = $value['count'] . ' MIN WATCH';
            $read_time_label = 'A FEW MIN WATCH';
            $icon_type = 'fab fa-youtube';
            // $content_leadin_short = $value['teaser'];
            $content_leadin_short = substr( $value['teaser'], 0, strrpos( substr( $value['teaser'], 0, 150), ' ' ) ) . '...';
            $data_filter_Y = 'f-youtube'; 
        break;

        case "filmstrip":
            $read_time_label = 'Scroll At Your Own Pace';
            // $read_time_label = $value['teaser'];
            $icon_type = 'fas fa-film';
            // $content_leadin_short = $value['teaser'];
            $content_leadin_short = substr( $value['teaser'], 0, strrpos( substr( $value['teaser'], 0, 150), ' ' ) ) . '...';
            $data_filter_F = 'f-filmstrips'; 
        break;

        default:
        $read_time = $read_time;
        $icon_type = 'invoice';
        break;
    }

    $data_filters = "$data_filter_N $data_filter_Y $data_filter_F";
    
    /* Check for image */
    if ( is_file($_SERVER['DOCUMENT_ROOT'] . "/view/image/fieldnotes/" . $value['image'] ) ) {
        $img_html = '<img src="/view/image/fieldnotes/' . $value['image'] . '" alt="' . $value['image'] . '" /></a>';
        $value['title'] = mb_strimwidth($value['title'], 0, 80, "...");
        $img_div = '1';
    } else {
        $img_html = null;
        $value['title'] = mb_strimwidth($value['title'], 0, 125, "...");
        $img_div = '0';
    }

    $card_html .= '<div class="card--wrapper ' . $data_filters . '">';
    $card_html .= '<div class="card--content">';
    $card_html .= '<div class="card--type">' . strtoupper($value['type']) . '</div>';
    $card_html .= '<div class="card--byline">user_id: ' . $value['user_id'] . '</div>';
    $card_html .= '<div class="card--title"><a href="/fieldnotes/' . $value['short_path'] . '">' . $value['title'] . '</a></div>';
    $card_html .= '<div class="card--teaser">' . $content_leadin_short . '</div>';
    $card_html .= '<!-- <div class="card--readtime">' . $published_date . ' · ' .strtoupper( $read_time_label ) . '</div> -->';
    $card_html .= '</div>';

    if($img_div == '1') {
        $card_html .= '<div class="card--image-wrapper" style="background: rgba(0,0,0,0) url(/view/image/fieldnotes/' . $value['image'] . ') no-repeat center; background-size: cover; word-break: break-word;">';
        $card_html .= '<i class="' . $icon_type . ' card--image-icon"></i>';
        $card_html .= '</div>';
    }

    $card_html .= '</div>';

}

?>