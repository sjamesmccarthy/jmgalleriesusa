<?php

/* Load filmstrip for popular */
    $catalog_photos = $this->api_Catalog_YouMayLike_Filmstrip();

     foreach($catalog_photos as $k => $v) {

                if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
                    $img_file = $v['file_name'];
                } else {
                    $img_file = 'image_not_found';
                }

                if($v['as_gallery'] == '1') {
                    $edition_html = 'Limited Edition';
                }

                if($v['as_open'] == '1') {
                    $edition_html = 'Open Edition';
                }

                /* For Mobile, On last two thumbnails add some css */
                if($count >= 2) {
                    $grid_css = 'col_sm-hidden';
                } else {
                    $grid_css = 'col ';
                }

                $thumb_html .= '<div style="padding: 0 10px;" class="thumb overflow-hidden ' . $grid_css . '">';
                $thumb_html .= '<a href="/' . $v['cate_path'] . "/" . $img_file . '"><img style="width: 100%" src="/catalog/__thumbnail/' .$img_file . '.jpg" alt="' . $img_file . '" /></a><p class="blue larger"><a href="/' . $v['cate_path'] . "/" . $img_file . '">' . $v['title'] . '</a></p><!--<p class="tiny">' . $v['loc_place'] . '</p>--><p class="tiny">' . $edition_html. '</p></div>';

                $count++;
            }

$html = <<<END
<!-- <article id="most-popular" class="mt-64"> -->
    <div class="grid">
        <div class="col-12" style="margin-bottom: 16px;">
        <h4 class="thin-400">YOU MAY ALSO LIKE</h4>
        <!-- <p class="uppercase text-center">&mdash; YOU MAY ALSO LIKE &mdash;</p>-->
        </div>
        $thumb_html
    </div>
<!-- </article> -->
END;

return($html);

?>
