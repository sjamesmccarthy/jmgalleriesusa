<?php
/* 
component: POLARIZED 
description: returns the last 4 blog posts from medium
css: component_polarized.scss
created: jmccarthy
date: 8/28/19
version: 1
*/

/* API call to get the Polarized listings*/
$fieldnotes_data = $this->api_Admin_Get_Fieldnotes_Item($this->page->fieldnotes_id);
extract($fieldnotes_data, EXTR_PREFIX_ALL, "res");

/* API call to get Responses */
$fieldsnotes_respsonses_data = $this->api_Admin_Get_Fieldnotes_Responses($this->page->fieldnotes_id);

/* API call to get all images from fiedlnotes_images by ID */
$image_data = $this->api_Admin_Get_FieldnotesImagesById($this->page->fieldnotes_id);
$image_count = count($image_data);

$content = explode('###', $res_content);
$sections = count($content);

if($sections == 2) {
    $res_content_leadin = $content[0];
    $res_content_leadin = str_replace('div', 'p', $res_content_leadin, $count);
    $res_content = $content[1];
    $res_content = str_replace('div', 'p', $res_content, $count);
    $res_content = preg_replace('/<span[^>]+\>/i', '', $res_content);
} else {
    $res_content_leading = null;
    $res_content = $content[0];
    $res_content = str_replace('div', 'p', $res_content, $count);
    $res_content = preg_replace('/<span[^>]+\>/i', '', $res_content);
}

$res_content = str_replace('<div><br></div>', '', $res_content);
$res_content = str_replace('<p><br></p>', '', $res_content);

/* format date */
$res_date_written = date("F j, Y", strtotime($res_created));

/* Check for image */
if($res_type == "article") {
    if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/image/fieldnotes/" . $res_image ) ) {
        $img_html = '<div class="col image filmstrip--carousel">
        <img src="/view/image/fieldnotes/' . $res_image . '" /><br />
        <span class="caption">' . $res_caption . '</span>
        </div>';
    }
} else if($res_type == "video") {
        $img_html = null;
} else { 

    /* FILMSTRIP LAYOUT THUMBNAILS */
    $j=1;
    foreach ($image_data as $imgK => $imgV) {

        if($j == 1) { 
            $show_large = 'display: block;'; 
            $underline_thumb = 'border-bottom: 32px solid #000; padding-bottom: 0; margin-bottom: 0;';
            $opacity_default = '1';
        } else { 
            $show_large = null; 
            $underline_thumb = null;
            $opacity_default = '.8';
        }

        if ($j == $image_count) { $m_right = null; } else { $m_right = null; }

        $img_html .= '<div id="imgT_' . $j . '" data-file="' . $j . '" style="' . $underline_thumb . ' ' . $m_right . '" class="">';
        $img_html .= '<img style="opacity: ' . $opacity_default . '; width: 25%; margin: auto;" src="/view/image/fieldnotes/' . $imgV['path'] . '" />';
        $img_html .= '</div>';

        $image_large .= '<div id="img_' . $j . '_expanded" style="' . $show_large . ' background-color: #000; min-height:300px; position: relative;"><p id="caption_' . $j . '" style=" padding: 2rem 1rem 1rem 2rem; color: #FFF; background-color: rgba(0,0,0,.4); font-size: 1.3rem; font-weight: 200;">' . $imgV['caption'] . '</p><img style="width: 100%;" src="/view/image/fieldnotes/' . $imgV['path'] . '" /></div>';
        $j++;
    }

    $res_content = '<div id="filmstrip--preview" class="filmstrip--large-preview show">'
                        . $image_large .                            
                    '</div>';
}

/* Build Comments */
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