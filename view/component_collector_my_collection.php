<?php


    /* Load filmstrip for popular */
    $catalog_photos = $this->api_CollectorDash_Get_Portfolio($props);
    
    $img_count = count($catalog_photos);
    $max_row = 4;
    $value = 0;
    $col_first_name = $this->collector_data_obj->first_name;
    
    $count=0;
    foreach($catalog_photos as $k => $v) {

        /* Fetch locations history data */
        $locationsHistory_data = $this->api_Admin_Get_Locations_History($v['art_id']);
        $location_history_html = null;
            
        if( count($locationsHistory_data) > 0) {
            
            foreach( $locationsHistory_data as $key_lh => $val_lh) {
    
                if(isSet($val_lh['date_ended'])) {
                    $location_history_html .= "<p class='tiny provenance--record'>" .  date("m/d/Y", strtotime($val_lh['date_started'])) . " - " . date("m/d/Y", strtotime($val_lh['date_ended'])) . " @" . strtoupper($val_lh['location']) . "</p>";
                } else {
                    if($val_lh['location'] == "COLLECTOR") {
                        // $val_lh['location'] = $val_lh['location'] . ' (' . $val_lh['last_name'] . ')';
                    }
                    // $location_history_html .= "<p><b>Currently @" . $val_lh['location'] . " as of " . date("F d, Y", strtotime($val_lh['date_started'])) . "</b></p>";
                    $location_history_html .= "<p class='tiny text-left'>" . date("F d, Y", strtotime($val_lh['date_started'])) . " Owned By You. ($" . $val_lh['value'] . ")</b></p>";
                    $value =  $value +  $val_lh['value'];
                } 
            }
    
            $value_f = "$" . number_format($value);
        } 
            
            
        if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
            $img_file = $v['file_name'];
        } else {
            $img_file = 'image_not_found';
        }


        if($v['reg_num'] == '') { $reg_num = null; } else { $reg_num = '<p>Reg No. ' . $v['reg_num'] . '</p>'; }
        if($v['frame_size'] != '') { $add_frame_meta = ', (' . $v['frame_size'] . ' framed)'; } else { $add_frame_meta = null; }

        $thumb_html .= '<div class="col-4_md-6_sm-12  text-center">';
        $thumb_html .= '<img class="image" src="/catalog/__thumbnail/' .$img_file . '.jpg" alt="' . $img_file . '" /><h4 class="text-center">' . $v['title'] . '<!-- (' . $v['art_id'] . ')--> </h4>';
        $thumb_html .= '<p>Purchased ' . date("F jS, Y", strtotime($v['purchase_date'])) . ' | <a data-id="' . $v['art_id'] . '" href="" class="provenance">Provenance</a></p>';
        $thumb_html .= '<div id="' . $v['art_id'] . '" class="grid provenance--block"><div class="col">' . $location_history_html . '</div><!--<div class="col text-right"><a data-id="' . $v['art_id'] . '" href="" class="provenance--close"><i class="fas fa-times"></i></a></div>--><!--<p class="text-left tiny ml-8"><a target="_new" href="/contact">Transfer Ownership</a>--></p></div>';
        $thumb_html .= '<p>Serial No. ' . $v['serial_num'] . '</p>';
        $thumb_html .= $reg_num;
        $thumb_html .= '<p>' . $v['print_size'] . ' print ' . $add_frame_meta . '</p>';
        $thumb_html .= '<p>' . $v['edition_style'] . ' EDITION #' . $v['edition_num'] . '/' .  $v['edition_num_max'] . '</p>';
        // $thumb_html .= '<p class="more-detail border-top">More Detail Coming Soon</p>';
        $thumb_html .= '</div>';
        
        $count++;
    }

$html = <<<END
<article id="my-collection">
    <div class="col-12">
    <h2 class="uppercase text-center">Your Artwork <i class="fab fa-angellist" aria-hidden="true"></i> $col_first_name</h2>
    <p><b>The below Fine-Art collectibles are part of your j.McCarthy collection valued at $value_f </b></p>
    <p class="mt-8"></p>
    </div>
    <!-- style="background-color: rgba(0,0,0,.05); padding: 35px 0 10px 20px;" -->
    <div class="grid">
        $thumb_html
    </div>
</article>
END;

return($html);

?>
