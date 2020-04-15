<?php


/* Load filmstrip for popular */
    $catalog_photos = $this->api_CollectorDash_Get_Portfolio($props);

     foreach($catalog_photos as $k => $v) {

                if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
                    $img_file = $v['file_name'];
                } else {
                    $img_file = 'image_not_found';
                }

                /* For Mobile */
                /* On last two thumbnails add some css */
                if($count == 2) {
                    // $grid_css = 'col sm-hidden';
                } else if ($count == 3) {
                    // $grid_css = 'col sm-hidden md-hidden';
                } else {
                    $grid_css = 'col';
                }

                if($v['reg_num'] == '') { $reg_num = null; } else { $reg_num = '<p>Reg No. ' . $v['reg_num'] . '</p>'; }

                $thumb_html .= '<div class="col-card card-border overflow-hidden ' . $grid_css . '">';
                $thumb_html .= '<img class="filmstrip-thumb" src="/catalog/__thumbnail/' .$img_file . '.jpg" /><h6>' . $v['title'] . '</h6>';
                $thumb_html .= '<p>Purchased ' . date("F jS, Y", strtotime($v['purchase_date'])) . '</p>';
                $thumb_html .= '<p>Serial No. ' . $v['serial_num'] . '</p>';
                $thumb_html .= $reg_num;
                $thumb_html .= '<p>' . $v['print_size'] . '(' . $v['frame_size'] . ' framed)</p>';
                $thumb_html .= '<p class="more-detail border-top">More Detail Coming Soon</p>';
                $thumb_html .= '</div>';

                if($count == 3) { $count = 0; } else { $count++; }
            }

$html = <<<END
<article id="my-collection" class="mt-32">
    <div class="most-popular--title col-12">
    <h2 class="uppercase ">My Artwork</h2>
    <p><b>The below Fine-Art photographs are part of your j.McCarthy collection. </b></p>
    <p class="mt-8"></p>
    </div>
    <div class="grid-4-center mt-16" style="background-color: rgba(0,0,0,.05); padding: 35px 0 10px 20px;">
        $thumb_html
    </div>
</article>
END;

return($html);

?>
