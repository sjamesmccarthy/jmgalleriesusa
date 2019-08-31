<?php 

/* Fetch Just the New Releases filmstrip */
    $count =0;
    $new_releases = $this->api_Catalog_Get_New_Releases(4,4);

        $thumb_new_releases_html .= "<article>";
        $thumb_new_releases_html .= '<div class="grid-4_sm-2 grid-4_md-3">';
        $thumb_new_releases_html .= '<div class="col-11" style="margin-bottom: 16px;">';
        $thumb_new_releases_html .= '    <h2><a href="/new-releases/">NEW RELEASES</a></h2>';
        $thumb_new_releases_html .= '    <p>a collection of photography featuring James\' newest work in all categories.</p>';
        $thumb_new_releases_html .= '</div>';
        $thumb_new_releases_html .= '<div class="col-1-bottom" style="margin-bottom: 16px; text-align: right; padding-right: 8px;">';
        $thumb_new_releases_html .= '<a href="/new-releases">view all</a>';
        $thumb_new_releases_html .= "</div>";

    
if( !$new_releases['error']) {
    foreach($new_releases as $k => $value) {
                
        if( file_exists($_SERVER['DOCUMENT_ROOT'] . "/catalog/__thumbnail/" . $value['file_name'] . '.jpg')) {
        $img_file = $value['file_name'];
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
        $thumb_new_releases_html .= '<div style="overflow: hidden;" class="' . $grid_css . '">';
        $thumb_new_releases_html .= '<a href="/' . $value['catalog_path']  . $value['path'] . "/" . $img_file . '"><img style="width: 100%;" src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a></div>';
                
        if($count == 3) { $count = 0; } else { $count++; }
    }
} else {
        $thumb_new_releases_html .= "<p>Somebody notify Captain Marvel, our photos have disappeared.</p><p style='margin-top: 20px; padding-top: 20px; border-top: 1px solid #CCC'>" . $new_releases['sql'] . "</p>";
}

        $thumb_new_releases_html .= "</div>";
        $thumb_new_releases_html .= "</article>";

        return($thumb_new_releases_html);
?>