<?php


/* Load filmstrip for popular */
    $catalog_photos = $this->api_CollectorDash_Get_Portfolio($props);
    $img_count = count($catalog_photos);
    $max_row = 4;

    $count=0;
    foreach($catalog_photos as $k => $v) {

        if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
            $img_file = $v['file_name'];
        } else {
            $img_file = 'image_not_found';
        }

        /* For Mobile */
        /* On last two thumbnails add some css */
        // if($count == 2) {
            // $grid_css = 'col sm-hidden';
        // } else if ($count == 3) {
            // $grid_css = 'col sm-hidden md-hidden';
        // } else {
            // $grid_css = 'col';
        // }

        if($v['reg_num'] == '') { $reg_num = null; } else { $reg_num = '<p>Reg No. ' . $v['reg_num'] . '</p>'; }
        if($v['frame_size'] != '') { $add_frame_meta = ', (' . $v['frame_size'] . ' framed)'; } else { $add_frame_meta = null; }

        $thumb_html .= '<div class="col-card card-border ' . $grid_css . '">';
        $thumb_html .= '<img class="filmstrip-thumb" src="/catalog/__thumbnail/' .$img_file . '.jpg" /><h6>' . $v['title'] . ' #' . $v['edition_num'] . '/' .  $v['edition_num_max'] .'</h6>';
        $thumb_html .= '<p>Purchased ' . date("F jS, Y", strtotime($v['purchase_date'])) . '</p>';
        $thumb_html .= '<p>Serial No. ' . $v['serial_num'] . '</p>';
        $thumb_html .= $reg_num;
        $thumb_html .= '<p>' . $v['print_size'] . ' print ' . $add_frame_meta . '</p>';
        $thumb_html .= '<p>' . $v['edition_style'] . ' EDITION</p>';
        // $thumb_html .= '<p class="more-detail border-top">More Detail Coming Soon</p>';
        $thumb_html .= '</div>';
        
        $count++;
    }

    for($i=$count; $i <= ($max_row -1); $i++) {

            if($i == 1) {
                $number = '2';
                $number_long = 'second';
                $pcode =  'ART15';
                $poffer = '15% OFF';
                $img = NULL;
            }
            if($i == 2) {
                $number = '3';
                $number_long = 'third';
                $pcode =  'WEBDEAL';
                $poffer = '$20 OFF';
                $img = '_alt';
            }
            if($i == 3) {
                $number = '4';
                $number_long = 'fourth';
                $pcode =  'COLLECTME';
                $poffer = '25% OFF';
                $img = '_alt_last';
            }
            
            $thumb_html .='<div class="col-card type-promo card-border"><img class="filmstrip-thumb" src="/catalog/__thumbnail/image_filler' . $img . '.jpg"><p class="mb-16">Your Next (No. ' . $number . ') Limited Edition Art</p><p>Use promo-code: ' . $pcode . ' and</p><p>receive <b>' . $poffer . ' your ' . $number_long . '</p><p>fine art limited-edition purchase</b></p><p></p><p class="more-detail mt-16"><a target="_shop" href="/galleries">Browse The Catalog</a></p></div>'; 
    }

$html = <<<END
<article id="my-collection" class="mt-32">
    <div class="most-popular--title col-12">
    <h2 class="uppercase ">Your Artwork</h2>
    <p><b>The below Fine-Art collectibles are part of your j.McCarthy collection. </b></p>
    <p class="mt-8"></p>
    </div>
    <!-- style="background-color: rgba(0,0,0,.05); padding: 35px 0 10px 20px;" -->
    <div class="grid-4 mt-16">
        $thumb_html
    </div>
</article>
END;

return($html);

?>
