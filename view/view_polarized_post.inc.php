<?php
/*
component: POLARIZED
description: returns the last 4 blog posts from medium
css: component_polarized.scss
created: jmccarthy
date: 8/28/19
update: Fri, 29 Jan 2021
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

/* API call to fetch tags */
$tags_data = $this->api_Admin_Get_Fieldnotes_Tags($this->page->fieldnotes_id);


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

$res_content = str_replace('<a', '<a target="_blank" ', $res_content);

$res_content = preg_replace('@\[(http|https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)\]@', '<a target="_blank"  href="$1">$1</a>', $res_content);
$res_content = str_replace('[','',$res_content);
$res_content = str_replace(']','',$res_content);

/* format date */
$res_date_written = date("F j, Y", strtotime($res_created));

/* Split headline to 6 words per line */
$res_title_arr = explode(' ', $res_title);
if (empty($res_title) == false) {
    $res_title_tmp = array_chunk($res_title_arr, '6');
}
// $res_title = implode(' ', $res_title_tmp[0]);
// $res_title .= '<br />' . implode(' ', $res_title_tmp[1]);
// $res_title .= '<br />' . implode(' ', $res_title_tmp[2]);
// $this->console($res_title_tmp);

/* format tags */
// $tag_array = explode(',', $tags_data);

if(count($tags_data) > 1 ) {
    foreach($tags_data as $tK => $tV) {
        $tags_html .= '<p class="__container--tags">' . $tV['tag'] . '</p>';
    }
}

/* Check for image */
if($res_type == "article") {
    if ( is_file($_SERVER['DOCUMENT_ROOT'] . "/view/image/fieldnotes/" . $res_image ) ) {
        $img_html = '<div class="col image filmstrip--carousel">
        <img src="/view/image/fieldnotes/' . $res_image . '"  alt="' . $res_image . '" /><br />
        <span class="caption">' . $res_caption . '</span>
        </div>';
    }
} else if($res_type == "video") {

        $img_html = null;
        $res_teaser = "";
        if (preg_match('/\biframe width\b/', $res_content)) {
           $res_content = $res_content;
           // $res_content = 'true';
        } else {
            // $res_content = 'false';
            $res_content = str_replace("https://youtu.be/", "https://youtube.com/embed/", $res_content);
            $res_content = '<iframe width="100%" height="515" src="' . $res_content . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }

} else {

    /* FILMSTRIP LAYOUT THUMBNAILS */
    $j=1;
    foreach ($image_data as $imgK => $imgV) {

        preg_match('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i',$imgV['caption'],$url, PREG_UNMATCHED_AS_NULL);

        if($url[0][0] != '') {
            $add_url = '<p class="filmstrip_img_zoom"><a target="_new" href="' . $url[0] . '"><i class="fas fa-expand"></i></a></p>';
        } else {
            $add_url = null;
        }

        $imgV['caption'] = preg_replace('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', '', $imgV['caption']);

           $res_content .= '
                <div id="img_' . $j . '_wrapper" class="grid">

                    <div class="col-12_sm-12" style="position: relative;">
                        <img id="img_' . $j . '_photo" style="width: 100%; border-radius: 6px;" src="/view/image/fieldnotes/' . $imgV['path'] . '" alt="' . $imgV['path'] . '" />' . $add_url . '
                    </div>

                    <div class="col-12_sm-12" id="img_' . $j . '_caption" style="display: block; position: relative;">
                        <p style="padding: 0rem 0 1rem 0; font-size: 1rem; margin-bottom:0; margin-top: 5px;"><span style="font-size: 1.25rem; font-weight: 800;">' . $j . '</span> / ' . $imgV['caption'] . '</p>
                    </div>

                </div>';
        $j++;
    }
}

/* Build Comments */
if($res_cheers == 0) {
    // $res_cheers = 'Clink! Be the first to ';
    $res_cheers = null;
}

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

    $res_responses = count($fieldsnotes_respsonses_data);
} else {
    $fieldsnotes_respsonses_html = ' <div class="--response-data-card">
    <p class="no_resp_yet" style="text-align: center; padding-top: 5%">
        <!-- No responses yet.<br />Be the first to leave one. -->
    </p>
    </div>
    ';

    // $res_responses = "No responses yet, be the first to leave one.";

}

$read_time = $this->__readTime($res_count);
$res_created = date("F d, Y", strtotime($res_created));

/* Create social links */
$social_twitter = 'http://twitter.com/share?text=' . urlencode($res_title) . '&url=' . 'https://jmgalleries.com/fieldnotes/' . $res_short_path . '&hashtags=jmgalleriesusa';
$social_linkedin = 'https://www.linkedin.com/sharing/share-offsite/?url=' . 'https://jmgalleries.com/fieldnotes/' . $res_short_path . '&hashtags=jmgalleriesusa';

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
        $url .= ' alt="avatar" />';
    }

    return $url;
}

?>
