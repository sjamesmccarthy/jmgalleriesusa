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

$i=0;
foreach ($fieldnotes_data as $key => $value) {

    $content = explode('###', $value['content']);
    $sections = count($content);

    if($sections == 2) {
        $content_leadin = $content[0];
        $content_leadin_short = substr( $content_leadin, 0, strrpos( substr( $content_leadin, 0, 130), ' ' ) ) . '...';
        $content = nl2br($content[1]);
    } else {
        $content_leadin_short = null;
        $content = nl2br($content[0]);
    }

    $read_time = $this->__readTime($value['count']);
    $large_cards = 6;

    /* Check for image */
    if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/image/fieldnotes/" . $value['image'] ) ) {
        $img_html = 
            '<div class="col sm-hidden content__image--preview">
                <img src="/view/image/fieldnotes/' . $value['image'] . '" /><br />
            </div>';
    } else {
        $img_html = '<!-- err_code: no image found -->';
    }

    if($i < $large_cards) {

        if ($value['featured'] != "1") {
            $card_html .= '
                    <div class="col-6_sm-12 storycard">
                        <div class="content--preview">
                            <p class="--tag">' . strtoupper($value['type']) . '</p>
                            <h4><a href="/polarized/' . $value['short_path'] . '">' . $value['title'] . '</a></h4>
                            <div class="--teaser">' . $content_leadin_short . '</div>
                            
                            <div class="" style="display: flex; position: relative; margin-top: 1rem;">
                                <div style="width: 30px; margin-top: 2px;">
                                    <img src="/view/image/avatar/jamesmccarthy_1.jpg" style="border-radius: 100px; width: 100%;"/>
                                </div>
                                <div class="" style="width: 100%; padding-left: .5rem;">
                                    <p class="--byline">James McCarthy<br />
                                    ' . date("F d, Y", strtotime($value['created'])) . ' - ' . $value['count'] . ' Words, ' . $read_time . '</p>
                                </div>
                            </div>
                        </div>' 
                        . $img_html . '
                    </div>
            ';


        } else {
            $card_html .= '
                <div class="col-6_sm-12 storycard--background" style="background: rgba(0,0,0,1) url(/view/image/fieldnotes/' . $value['image'] . ') no-repeat center; background-size: auto;">
                    <div class="content--preview">
                        <div style="padding-top: inherit;">
                        <p class="--tag">' . strtoupper($value['type']) . '</p>
                        <h4><a href="/polarized/' . $value['short_path'] . '">' . $value['title'] . '</a></h4>
                        
                        <div class="mt-8" style="display: flex; position: relative;">
                                <div style="width: 30px; margin-top: 2px;">
                                    <img src="/view/image/avatar/jamesmccarthy_1.jpg" style="border-radius: 100px; width: 100%;"/>
                                </div>
                                <div class="byline" style="width: 100%;">
                                    <p class="--byline">James McCarthy<br />
                                    ' . date("F d, Y", strtotime($value['created'])) . ' - ' . $value['count'] . ' Words, ' . $read_time . '</p>
                                </div>
                        </div>
                    </div>
                    </div> 
                </div>
        ';
        }

    } else {
        $card_older_html .= '<li class="small"><a href="/polarized/' . $value['short_path'] . '">' . $value['title'] . '</a></li>';
    }

   $i++; 
}

?>