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
    $value['byline'] = 'James McCarthy';

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

        if ($value['type'] == "featured") {
            
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
                                    <p class="--byline">' . $value['byline'] . '<br />
                                    ' . date("F d, Y", strtotime($value['created'])) . ' - ' . $value['count'] . ' Words, ' . $read_time . '</p>
                                </div>
                        </div>
                    </div>
                    </div> 
                </div>
        ';

        } else if ($value['type'] == "filmstrip") {

            $strip_html = null;

            /* API call to get all images from fiedlnotes_images by ID */
            $image_data = $this->api_Admin_Get_FieldnotesImagesById($value['fieldnotes_id']);
            $image_count = count($image_data);

            $j=1;
            foreach ($image_data as $imgK => $imgV) {

                    /* variables to assign */
                    $file_path = $imgV['path'];
                    $file_caption = $imgV['caption'];

                    if ($j == $image_count) { $m_right = null; } else { $m_right = null; }

                    /* HTML for the images in the strip */
                    $strip_html .= '<div id="imgT_' . $j . '" style="flex: 1; text-align:center;' . $m_right . '" data-file="' . $j . '"><img style="height: 120px; border-radius: 6px;" src="/view/image/fieldnotes/' . $imgV['path'] . '" /></div>';

                    $image_large .= '<div id="img_' . $j . '_expanded" style="background-color: #000; min-height:300px;position: relative;"><img style="width: 100%;" src="/view/image/fieldnotes/' . $imgV['path'] . '" /><p id="caption_' . $j . '" style="padding: 1rem;">' . $imgV['caption'] . '</p></div>';
                    $j++;
            }

            $card_html .= '
                <div class="col-6_sm-12 storycard--background" style="background-color: #000;">
                    <div style="border-radius: 6px; padding: .5rem 3rem 1rem 3rem; background-color: rgba(0, 0, 0, 0.5);padding-top: 1rem;">
                        <p style="font-size: .7rem;">FILMSTRIP</p><h4 style="color: #FFFFFF;">' . $value['title']. '</h4><p style="font-size: .7rem;">By ' . $value['byline'] . ' — ' . date("F d, Y", strtotime($value['created'])) . '</p>
                    </div>
                    <div class="content--preview" style="display: flex; flex-wrap: wrap; justify-content: center;">                        
                    <!-- HTML for images -->' . $strip_html . 
                    '</div>
                    <div id="content--teaser"><p style="padding: .5rem 3rem 1rem 3rem;color:#FFF;">' . $value['teaser'] . '</p></div> 
                    <!-- Large Preview of Image Selected -->
                    <div id="fimlstrip--preview_' . $j . '" class="filmstrip--large-preview">
                        <p data-filmstrip="' .$j . '" class="close_filmstrip" style="border-bottom-left-radius: 69px; background-color: rgba(255,255,255,.5); text-align: right;padding: 24px;position: absolute;top: 0;right: 0;color: #000;"><i style="position:absolute; top:13px;right:10px;" class="fas fa-times-circle" aria-hidden="true"></i></p>'
                        . $image_large .                            
                    '</div>
                </div>
                ';

        } else {

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
                                    <p class="--byline">' . $value['byline'] . '<br />
                                    ' . date("F d, Y", strtotime($value['created'])) . ' - ' . $value['count'] . ' Words, ' . $read_time . '</p>
                                </div>
                            </div>
                        </div>' 
                        . $img_html . '
                    </div>
            ';
            
        }

    } else {
        $card_older_html .= '<li class="small"><a href="/polarized/' . $value['short_path'] . '">' . $value['title'] . '</a></li>';
    }

   $i++; 
}

?>