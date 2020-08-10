<?php

class Fieldnotes_Api
{
    // public $mysqli;

public function api_Admin_Get_FieldnotesImagesById($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select * from fieldnotes_images 
                where fieldnotes_id = '" . $id . "' and status='active' order by file_order ASC";
        
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } 
            
        }

        return($data);

    }

public function api_Admin_Get_Fieldnotes($status=null) {

    if(!is_null($status)) {
        $where = " WHERE f.status='published'";
        // $limit = " LIMIT 6";
    }

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            f.fieldnotes_id,
            f.title,
            f.short_path,
            f.image,
            f.caption,
            f.content,
            f.teaser,
            f.count,
            f.type,
            f.featured,
            f.created,
            f.modified,
            f.status,
            a.first_name,
            a.last_name
        FROM
            fieldnotes as f
            INNER JOIN artist as a on a.artist_id = f.user_id
            $where
            ORDER BY f.created DESC";
        
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } 
            
        }

        return($data);

    }

 public function api_Admin_Get_Fieldnotes_Item($id,$name=null) {

     if(isSet($name)) { 
         $sql = "SELECT f.fieldnotes_id, f.image FROM fieldnotes as f WHERE f.short_path='" . $name . "'";
     } else {
          $sql = "SELECT
            f.fieldnotes_id,
            f.title,
            f.short_path,
            f.image,
            f.content,
            f.caption,
            f.teaser,
            f.count,
            f.type,
            f.featured,
            f.created,
            f.modified,
            f.status,
            a.first_name,
            a.last_name
        FROM
            fieldnotes as f 
            INNER JOIN artist as a on a.artist_id = f.user_id
            WHERE f.fieldnotes_id = '" . $id . "'";
     }

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }
                
            } 
            
        }

        return($data);

    }

 public function api_Admin_Get_Fieldnotes_Tags($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

          $sql = "SELECT
           ft.tag
        FROM
            fieldnotes_tags as ft
        WHERE ft.fieldnotes_id = '" . $id . "'";
        
        $result = $this->mysqli->query($sql);

        if ($result->num_rows > 0) {
        
            while($row = $result->fetch_assoc())
	        {
	            $data[] = $row;
	        }
            
        } 
            
        }

        return($data);

    }

public function api_Admin_Update_Fieldnotes() {

        $mysql_ts = date('Y-m-d H:i:s');

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        // $this->console($_POST);
        // $this->console($_FILES);

        /* Insert into database */
        $title = $this->mysqli->real_escape_string($_POST['title']);
        $teaser = $this->mysqli->real_escape_string($_POST['teaser']);
        $file_1_caption = $this->mysqli->real_escape_string($_POST['file_1_caption']);
        $content = $this->mysqli->real_escape_string($_POST['content']);
        
        if(isSet($_FILES['file_1']['name'])) {
            // $_FILES['file_1']['name'] = $short_path . '.jpg';
            $img_path = $short_path . '_file_1.jpg';
        } 

        if(!isset($featured)) { $featured ="0"; }

        $sql = "
        UPDATE fieldnotes 
        SET 
            title = '$title',
            short_path = '$short_path',
            teaser = '$teaser',
            content = REPLACE(\"$content\", \"\\r\\n\", \"\"),
            type = '$type',
            count = '$words',
            image = '$img_path',
            caption = '$file_1_caption',
            featured = '$featured',
            created = '$date',
            modified = '$mysql_ts',
            status = '$status'
        WHERE fieldnotes_id = '$fieldnotes_id' 
        ";

        $result = $this->mysqli->query($sql,1);
        
        /* DELETE ALL catalog_collection_link records for this ID */
        $sql_d = "DELETE FROM fieldnotes_tags WHERE fieldnotes_id = '" . $fieldnotes_id . "'";
        $result_d = $this->mysqli->query($sql_d);
        
        /* Add parent collection to the array */
        if (isSet($tags)) {
            $fieldnotes_tags = explode(',', $tags);

            foreach ($fieldnotes_tags as $key => $value) {

                $value = ltrim($value, ' ');

                $sql_t = "INSERT INTO fieldnotes_tags (fieldnotes_id,tag)
                VALUES('" . $fieldnotes_id . "','" . $value . "')";

                $result_t = $this->mysqli->query($sql_t);
            }
        } 

        /* Fieldnotes_images and captions */
        $i=1;
        foreach ($_FILES as $key => $val) {
            
            if($val['size'] > 0) {
                $img_path = $short_path . '_' . $key . '.jpg';
                $idx_caption = $key . "_caption";
                $idx_path = $key . "_path";

                /* DELETE ALL image meta data from fieldnotes_images table for image being modified */
                $sql_img_d = "DELETE FROM fieldnotes_images WHERE path = '" . $img_path . "'";
                $result_img_d = $this->mysqli->query($sql_img_d);
                
                /* insert into the database */
                $_POST[$idx_caption] = $this->mysqli->real_escape_string($_POST[$idx_caption]);
                $sql_img_i = "INSERT INTO fieldnotes_images (fieldnotes_id, path, caption, file_order)
                    VALUES('" . $fieldnotes_id . "','" . $img_path . "','" . $_POST[$idx_caption] . "','" . $i . "')";
                $result_img_i = $this->mysqli->query($sql_img_i);

            } else {

                /* UPDATE captions for all images */
                if(${"file_" . $i . "_path"} != "" ) {
                    $sql_cap_u = "UPDATE `jmgaller_iesusa`.`fieldnotes_images` SET `caption` = '" . ${"file_" . $i . "_caption"} . "' WHERE `fieldnotes_id` = '" . $fieldnotes_id . "' AND `path`='" . ${"file_" . $i . "_path"} . "'";
                    $result_cap_u = $this->mysqli->query($sql_cap_u);
                }

            }
            $i++;
        }
        
         /* Check to see if files have been uploaded */
         $this->__uploadFiles(array("jpg","jpeg"), "jpg");

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "api_FieldNotes", "value" => "Updated FieldNotes " . $_POST['title'] . " (" . $_POST['fieldnotes_id'] . ") ", "type" => "success"));
        } else {
            $_SESSION['error'] = '501';
            $_SESSION['notify_msg'] = "SOMETHING WENT WRONG, e_501 " . __LINE__;
            $this->log(array("key" => "api_FieldNotes", "value" => "Failed FieldNotes " . $_POST['title'] . " (" . $_POST['fieldnotes_id'] . ") " . $sql, "type" => "failure"));
        }

}

public function api_Admin_Insert_Fieldnotes() {

        $user_id = $_SESSION['uid'];
        if(isSet($_POST['date'])) { $mysql_ts = $_POST['date']; } else { $mysql_ts = date('Y-m-d H:i:s'); }

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        /* Insert into database */
        $teaser = $this->mysqli->real_escape_string($_POST['teaser']);
        $title = $this->mysqli->real_escape_string($_POST['title']);
        $file_1_caption = $this->mysqli->real_escape_string($_POST['file_1_caption']);
        $content = $this->mysqli->real_escape_string($_POST['content']);
        if(!isset($featured)) { $featured ="0"; }

        if(isSet($_FILES['file_1']['name'])) {
            // $_FILES['file_1']['name'] = $short_path . '.jpg';
            $img_path = $short_path . '_file_1.jpg';
        }

         $sql = "
            INSERT INTO `jmgaller_iesusa`.`fieldnotes` (
                `user_id`, 
                `title`, 
                `image`, 
                `caption`,
                `content`, 
                `teaser`,
                `type`, 
                `featured`,
                `short_path`,
                `created`,
                `status`) 
            VALUES (
                '$user_id', 
                '$title', 
                '$img_path',
                '$file_1_caption', 
                REPLACE(\"$content\", \"\\r\\n\", \"\"), 
                '$teaser',
                '$type', 
                '$featured',
                '$short_path',
                '$mysql_ts',
                '$status'
                );";

        $result = $this->mysqli->query($sql);
        $fieldnotes_id = $this->mysqli->insert_id;

        /* Add parent collection to the array */
        if (isSet($tags)) {
            $fieldnotes_tags = explode(',', $tags);

            foreach ($fieldnotes_tags as $key => $value) {

                $value = ltrim($value, ' ');

                $sql_t = "INSERT INTO fieldnotes_tags (fieldnotes_id,tag)
                VALUES('" . $fieldnotes_id . "','" . $value . "')";

                $result_t = $this->mysqli->query($sql_t);
            }
        } 

        /* Fieldnotes_images and captions */
        $i=1;
        foreach ($_FILES as $key => $val) {

        if($val['size'] > 0) {
        $img_path = $short_path . '_' . $key . '.jpg';
        $idx_caption = $key . "_caption";
        $idx_path = $key . "_path";

        /* insert into the database */
        $_POST[$idx_caption] = $this->mysqli->real_escape_string($_POST[$idx_caption]);
        $sql_img_i = "INSERT INTO fieldnotes_images (fieldnotes_id, path, caption, file_order)
        VALUES('" . $fieldnotes_id . "','" . $img_path . "','" . $_POST[$idx_caption] . "','" . $i . "')";
        $result_img_i = $this->mysqli->query($sql_img_i);

        } 
        $i++;
        }

        /* Check to see if files have been uploaded */
        $this->__uploadFiles(array("jpg","jpeg"), "jpg");

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "api_FieldNotes", "value" => "Updated FieldNotes " . $_POST['title'] . " (" . $_POST['fieldnotes_id'] . ") ", "type" => "success"));
        } else {

            $_SESSION['error'] = '501';
            $_SESSION['notify_msg'] = "SOMETHING WENT WRONG, e_501 " . __LINE__;
            $this->log(array("key" => "api_FieldNotes", "value" => "Failed FieldNotes " . $_POST['title'] . " (" . $_POST['fieldnotes_id'] . ") " . $sql, "type" => "failure"));
        }

}

public function __readTime($count) {

    if($count > "100" &&  $res_count  < "350") {
        $read_time = "1 min read";
    }
    if($count > "351" &&  $res_count  < "500") {
        $read_time = "2 min read";
    }
    if($count > "501" &&  $res_count  < "750") {
        $read_time = "3 min read";
    }
    if($count > "751") {
        $read_time = "5 min read";
    }
    if($count > "999") {
        $read_time = "7 min read";
    }
    
    return($read_time);
}

public function __uploadFiles($fileTypes=array("jpeg"), $ext="jpg") {

    $uploadReady=0;
        foreach($_FILES as $key => $value) {

            $_FILES[$key]['path'] = '/view/image/fieldnotes/';
            
            if($value['size'] != 0) {
                // $_FILES[$key]['path'] = $_POST[$key . '_path'];
                $uploadReady=1;
                // $this->console($value);
            } else { $uploadReady=0; }

            // if($_FILES[$key]['path'] == "/catalog/__thumbnail/") { $log_loc = 'Thumbnail'; } else { $log_loc = 'Main'; }
            $target_file = $_SERVER["DOCUMENT_ROOT"] . $_FILES[$key]['path'] . $_POST['short_path'] . '_' . $key . '.' . $ext;

            if(file_exists( $target_file )) {
                // $this->log(array("key" => "core", "value" => "Overwriting " . $log_loc . " Photo (" . $_POST['file_name'] . '.' . $ext . ")", "type" => "warning"));
                $uploadReady = 1;

                // need to throw an overwrite flag only if $_FILES[$key]['name']
                if( isSet($_FILES[$key]['name'])) {
                    $uploadOverwrite = 1;
                } 

            } else { $uploadReady=1; $uploadOverwrite = 0; }

            // Check if $uploadReady is set to 0 by an error
            if($value['size'] != '0') {

                if ($uploadReady == 0) {
                    $this->log(array("key" => "api_FieldNotes", "value" => "Failed to Upload / uploadReady=0", "type" => "failure"));
                } else {
                    
                    // $this->console($target_file);

                    if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
                        if ($uploadOverwrite == 0) {
                            $this->log(array("key" => "api_FieldNotes", "value" => "Upload of " . $log_loc . " Image File (" . $_POST['short_path'] . '_' . $key . '.' . $ext . ")", "type" => "success"));
                        } else {
                            $this->log(array("key" => "api_FieldNotes", "value" => "Overwriting " . $log_loc . " Photo (" . $_POST['short_path'] . '_' . $key . '.' . $ext . ")", "type" => "warning"));
                        }
                    } else {
                        // $this->log(array("key" => "system", "value" => "move_uploaded_file() FAILURE on line " . __LINE__, "type" => "failure"));
                    }
                }
            }

        }
}

public function x__uploadFile($fileTypes=array("jpeg"), $ext="jpg") {

        $uploadReady=0;

        if( !$_POST['file_1_hidden'] || isSet($_FILES['file_1']['name']) ) {


            foreach($_FILES as $key => $value) {
                
                $_FILES[$key]['path'] = '/view/image/fieldnotes/';
                
                if($value['size'] != 0) {
                    // $_FILES[$key]['path'] = $_POST[$key . '_path'];
                    $uploadReady=1;
                } else { $uploadReady=0; }

                // if($_FILES[$key]['path'] == "/catalog/__thumbnail/") { $log_loc = 'Thumbnail'; } else { $log_loc = 'Main'; }
                $target_file = $_SERVER["DOCUMENT_ROOT"] . $_FILES[$key]['path'] . $_POST['short_path'] . '.' . $ext;

                if(file_exists( $target_file )) {
                    // $this->log(array("key" => "core", "value" => "Overwriting " . $log_loc . " Photo (" . $_POST['file_name'] . '.' . $ext . ")", "type" => "warning"));
                    $uploadReady = 1;

                    // need to throw an overwrite flag only if $_FILES[$key]['name']
                    if( isSet($_FILES[$key]['name'])) {
                        $uploadOverwrite = 1;
                    } 

                } else { $uploadReady=1; $uploadOverwrite = 0; }

                // Check if $uploadReady is set to 0 by an error
                if ($uploadReady == 0) {
                    $this->log(array("key" => "api_FieldNotes", "value" => "Failed to Upload / uploadReady=0", "type" => "failure"));
                } else {

                    if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
                        if ($uploadOverwrite == 0) {
                            $this->log(array("key" => "api_FieldNotes", "value" => "Upload of " . $log_loc . " Image File (" . $_POST['file_name'] . '.' . $ext . ")", "type" => "success"));
                        } else {
                            $this->log(array("key" => "api_FieldNotes", "value" => "Overwriting " . $log_loc . " Photo (" . $_POST['file_name'] . '.' . $ext . ")", "type" => "warning"));
                        }
                    } else {
                        // $this->log(array("key" => "system", "value" => "move_uploaded_file() FAILURE on line " . __LINE__, "type" => "failure"));
                    }
                }

            }
        } else {
            $this->log(array("key" => "api_FieldNotes", "value" => "__uploadFile() FAILURE", "type" => "failure"));
        }

    }

}