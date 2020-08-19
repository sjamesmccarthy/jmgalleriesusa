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
$fieldsnotes_respsonses_data = $this->api_Admin_Get_Fieldnotes_Responses($this->page->fieldnotes_id);

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
    <span class="caption">' . $res_caption . '</span>
    </div>';
}

if($res_cheers == 0) { $res_cheers = 'Clink! Be the first to '; }
 $resp_count = count($fieldsnotes_respsonses_data);

if( count($fieldsnotes_respsonses_data) >= 1) {

    foreach($fieldsnotes_respsonses_data as $fK => $fV) {
        $email = explode('@', $fV['email']);

        /* Look for gravatar */
        $gravatar_url = get_gravatar($fV['email']);
        
        /* This HTML is duplicated in fieldnotes_api, api_Admin_Insert_Fieldnotes_Responses() */
        $fieldsnotes_respsonses_html .= '
        <div class="--response-data-card border--bottom">
        <p class="--avatar">
           <!-- <i class="fas fa-user-astronaut"></i> -->
           ' . $gravatar_url . '
        </p>
        <p class="--avatar-byline">' . date("l, F j, Y, g:i a", strtotime($fV['created'])) . '<br />@' . $email[0] . ' responded ...</p>
        <div class="--content">'
        . $fV['response'] . 
        '</div>
        </div>';
    }

    $res_responses = count($fieldsnotes_respsonses_data) . " Responses";
} else {
    $fieldsnotes_respsonses_html = ' <div class="--response-data-card">
    <p class="no_resp_yet" style="text-align: center; padding-top: 5%">
        No responses yet.<br />Be the first to leave one.
    </p>
    </div>
    ';

    $res_responses = "No responses yet, be the first to leave one.";

}

$read_time = $this->__readTime($res_count);
$res_created = date("F d, Y", strtotime($res_created));

/* Create social links */
$social_twitter = 'http://twitter.com/share?text=' . urlencode($res_title) . '&url=' . 'https://jmgalleries.com/polarized/' . $res_short_path . '&hashtags=jmgalleriesusa';
$social_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . 'https://jmgalleries.com/polarized/' . $res_short_path . '&hashtags=jmgalleriesusa';

function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = true, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";

    // Now check the headers...
	// $headers = @get_headers( $url );

	// If 200 is found, the user has a Gravatar; otherwise, they don't.
    // if ( preg_match( '|200|', $headers[0]) ) {
    //     echo "true";
    // } else {
    //     echo "false";
    // }
    
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }

    return $url;
}

?>