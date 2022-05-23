<?php

require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/fieldnotes_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/model/core_api.php');
require_once( $_SERVER["DOCUMENT_ROOT"] . '/controller/core_site.php');
$ajax = new Core_Site();

    // $data = json_decode(file_get_contents("php://input"),true);

    // print_r($_POST);

    if(isSet($_POST['include_all'])) {
        $include_all = 1;
    } else {
        $include_all = 0;
    }      
    
    if($_POST['serialreg'] != '') {
       $serialreg = $_POST['serialreg'];
    } else {
        $serialreg = 0;
    }   

    /* Load filmstrip for popular */
    $catalog_photos = $ajax->api_CollectorDash_Get_Portfolio($_POST['email'],$serialreg,$include_all);
    

if(isSet($catalog_photos['error'])) {
    $thumb_html = "<h2>No records found, please try again.</h2>";
} else {

    $thumb_html = "<div class='col-12_md-12_sm-12 text-center'>
    <!-- RESULTS START -->
    <p class='mb-32'><a id='clr_results' href=''>CLEAR RESULTS</a></p>
    </div>";

    $img_count = count($catalog_photos);
    $max_row = 4;
    $value = 0;
    
    $count=0;
    foreach($catalog_photos as $k => $v) {

        /* Fetch locations history data */
        $locationsHistory_data = $ajax->api_Admin_Get_Locations_History($v['art_id']);
        $location_history_html = null;

        if( count($locationsHistory_data) > 0) {
            
            foreach( $locationsHistory_data as $key_lh => $val_lh) {
                
                if(isSet($val_lh['date_ended'])) {
                    $location_history_html .= "<p class='small provenance--record'>" .  date("m/d/Y", strtotime($val_lh['date_started'])) . " - " . date("m/d/Y", strtotime($val_lh['date_ended'])) . " @" . strtoupper($val_lh['location']) . "</p>";
                } else {
                    $location_history_html .= "<p class='small text-left mt-16'>On " . date("F d, Y", strtotime($v['purchase_date'])) .  ", " . $v['first_name'] . " " . $v['last_name'] . " acquired this fine-art.<!--$" . $val_lh['value'] . "--></b></p>";
                    $value =  $value +  $val_lh['value'];
                } 
            }
    
            $value_f = "$" . number_format($value);
        } else {
            $location_history_html .= "<p class='small provenance--record'>SOLD (legacy location, limited data available)</p>";
        }
            
            
        if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/__catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
            $img_file = $v['file_name'];
        } else {
            $img_file = 'image_not_found';
        }


        if($v['reg_num'] == '') { $reg_num = null; } else { $reg_num = '<p>Reg No. ' . $v['reg_num'] . '</p>'; }
        if($v['frame_size'] != '') { $add_frame_meta = ', (' . $v['frame_size'] . ' framed)'; } else { $add_frame_meta = null; }

        $thumb_html .= '<div class="col-5_md-5_sm-12 text-center" style="border: 1px solid #e9e9e9;
        padding: 20px;
        border-radius: 6px;
        margin: 4px;">';
        $thumb_html .= '<img class="image" src="/view/__catalog/__thumbnail/' .$img_file . '.jpg" alt="' . $img_file . '" /><p class="tiny text-left">*Image displayed is from online catalog and not of actual artwork.</p><h4 class="text-center">' . $v['title'] . '<!--(' . $v['art_id'] . ')--></h4>';
        $thumb_html .= '<p>Serial No. ' . $v['serial_num'] . '</p>';
        $thumb_html .= $reg_num;
        $thumb_html .= '<p>' . $v['print_size'] . ' print ' . $add_frame_meta . '</p>';
        $thumb_html .= '<p>' . $v['edition_style'] . ' EDITION #' . $v['edition_num'] . '/' .  $v['edition_num_max'] . '</p>';
        $thumb_html .= '<!--<p>Purchased ' . date("F jS, Y", strtotime($v['purchase_date'])) . '--> <!-- | <a data-id="' . $v['art_id'] . '" href="#" class="provenance">Historical Provenance</a>--></p>';
        // $thumb_html .= '<p class="more-detail border-top">More Detail Coming Soon</p>';
        $thumb_html .= '<p style="text-align: left; font-weight:bold;" class="mt-32">Created on ' .  date("F jS, Y", strtotime($v['born_date'])) . '</p><div id="' . $v['art_id'] . '" class="grid provenance--block"><div class="col">' . $location_history_html . '</div><!--<div class="col text-right"><a data-id="' . $v['art_id'] . '" href="" class="provenance--close"><i class="fas fa-times"></i></a></div>--><!--<p class="text-left small ml-8"><a target="_new" href="/contact">Transfer Ownership</a>--></p></div>';
        $thumb_html .= '</div>';
        
        $count++;
    }
}

$html = <<<END
<article id="my-collection">
    <div class="grid-noGutter-center">
        $thumb_html
    </div>
</article>
<!-- js code -->
<script>
jQuery(document).ready(function($){
    jQuery.noConflict();

    $('.provenance').on("click", function(e) {
        e.preventDefault();
        console.log('.provenance.click');
        let id = $(this).attr('data-id');
        $('#' + id).toggle();
        // $('.provenance--close').toggle();
    });

    $('#clr_results').on('click', function(e) {
        e.preventDefault();
        $('#email').val('');
        $('#serial').val('');
        $('#include_all').prop('checked', false);
        $('.provenance-section--results').hide();
    });

});
</script>
END;

 echo $html;

?>
