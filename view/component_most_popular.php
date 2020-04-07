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
                if($count == 2) {
                    $grid_css = 'col sm-hidden';
                } else if ($count == 3) {
                    $grid_css = 'col sm-hidden md-hidden';
                } else {
                    $grid_css = 'col';
                }

                $thumb_html .= '<div class="padding: 0 10px; overflow-hidden ' . $grid_css . '">';
                $thumb_html .= '<a href="/' . $v['cate_path'] . "/" . $img_file . '"><img class="filmstrip-thumb" src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a><p class="blue larger"><a href="/' . $v['cate_path'] . "/" . $img_file . '">' . $v['title'] . '</a></p></div>';

                if($count == 3) { $count = 0; } else { $count++; }
            }

$html = <<<END
<article id="most-popular">
    <div class="grid-4_sm-2 grid-4_md-3">
        <div class="col-10" style="margin-bottom: 16px;">
        <h2 class="blue">YOU MAY ALSO LIKE</h2>
        <p>More popular photographs based on what others are viewing</p>
        </div>
    <div class="col-2-middle" style="margin-bottom: 16px; text-align: right;padding-right: 8px;">
        <a href="/galleries">view all</a>
    </div>
        $thumb_html
    </div>
</article>
END;

return($html);

?>
