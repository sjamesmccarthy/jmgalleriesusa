<?php 

    $catalog_path_cleaned = ltrim($this->page->catalog_path, '/');
    
    /* Load all photo meta data */
    $photo_meta = $this->api_Catalog_Photo($this->photo_path);
    $this->catalog_title = ucwords( $photo_meta['category_title'] );
    $this->page->title = $photo_meta['title'];

    if($photo_meta['orientation'] == "portrait") {
        $img_w = '90%';
        $grid = '10';
        $col_left = 'col-5';
        $col_right = 'col-5';
    } else {
        $img_w = '100%';
        $grid='11-center';
        $col_left = 'col-7';
        $col_right = 'col-4';
    }

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

                $thumb_html .= '<div style="overflow: hidden; height: 130px;" class="' . $grid_css . '">';
                $thumb_html .= '<a href="' . $this->page->catalog_path .'/' . $img_file . '"><img style="margin-top: -35%;" src="/catalog/__thumbnail/' .$img_file . '.jpg" /></a></div>';
                
                if($count == 3) { $count = 0; } else { $count++; }
            }

?>

<script>
    var title = document.title;
    var dbTitle = "<?= $photo_meta['title'] ?>";
    if (document.title != dbTitle) {
        document.title = dbTitle;
    }
</script>
