<?php

/* Load filmstrip for popular */
    $catalog_photos = $this->api_Catalog_YouMayLike_Filmstrip();

     foreach($catalog_photos as $k => $v) {

                if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $v['file_name'] . '.jpg')) {
                    $img_file = $v['file_name'];
                } else {
                    $img_file = 'image_not_found';
                }

                /* For Mobile */
                /* On last two thumbnails add some css */
                if($count >= 3) {
                    $grid_css = 'col_sm-hidden';
                // } else if ($count == 3) {
                //     $grid_css = 'col ';
                } else {
                    $grid_css = 'col ';
                }

                $thumb_html .= '<div style="padding: 0 10px;" class="thumb overflow-hidden ' . $grid_css . '">';
                $thumb_html .= '<a href="/' . $v['cate_path'] . "/" . $img_file . '"><img class="filmstrip-thumb" src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a><h4 class="blue larger"><a href="/' . $v['cate_path'] . "/" . $img_file . '">' . $v['title'] . '</a></h4><p>' . $v['loc_place'] . '</p></div>';

                // if($count == 2) { $count = 0; } else { $count++; }
                $count++;
            }

$html = <<<END
<article id="most-popular" class="mt-64">
    <div class="grid">
        <div class="col-12 center" style="margin-bottom: 16px;">
        <h2 class="blue thin">YOU MAY ALSO LIKE</h2>
        <p>More photographs based on what others are viewing</p>
        </div>
        $thumb_html
    </div>
</article>
END;

return($html);

?>
