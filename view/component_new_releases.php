<?php 

/* Fetch Just the New Releases filmstrip */
    $count =0;
    $new_releases = $this->api_Catalog_Get_New_Releases(4,4);

        $thumb_new_releases_html .= "<article>";
        $thumb_new_releases_html .= '<div class="grid-4_sm-2 grid-4_md-3">';
        $thumb_new_releases_html .= '<div class="col-10" style="margin-bottom: 16px;">';
        $thumb_new_releases_html .= '    <h2><a href="/new-releases/">NEW RELEASES</a></h2>';
        $thumb_new_releases_html .= '    <p>a collection of photography featuring James\' newest work in all categories.</p>';
        $thumb_new_releases_html .= '</div>';
        $thumb_new_releases_html .= '<div class="view-all col-2-bottom">';
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
        $thumb_new_releases_html .= '<div class="thumb overflow-hidden ' . $grid_css . '">';
        $thumb_new_releases_html .= '<a href="/' . $value['catalog_path']  . $value['path'] . "/" . $img_file . '"><img src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a></div>';
                
        if($count == 3) { $count = 0; } else { $count++; }
    }
} else {
        $thumb_new_releases_html .= "<p>Somebody notify Captain Marvel, our photos have disappeared.</p><p class='new-release-error'>" . $new_releases['sql'] . "</p>";
}

        $thumb_new_releases_html .= "</div>";
        $thumb_new_releases_html .= "</article>";

        return($thumb_new_releases_html);
?>