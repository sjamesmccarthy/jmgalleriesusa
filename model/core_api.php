<?php

class Core_Api extends Core_Data
{

    public function api_Catalog_Category_Thumbs($catalog_path) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
                SELECT
                    PH.catalog_photo_id,
                    PH.title,
                    PH.file_name
                FROM
                    catalog_photo AS PH
                    RIGHT JOIN catalog_category AS CATE ON PH.catalog_category_id = CATE.catalog_category_id
                WHERE
                    CATE.path = '" . $catalog_path ."'";

            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } else {
                
                $data[] = "No Records Found @ $sql";
            }	
            
        }

        return($data);
    }

    public function api_Catalog_Category_Filmstrip($category_id, $limit) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                PH.catalog_photo_id,
                PH.title,
                PH.file_name,
                CATE.title AS cate_title
            FROM
                catalog_photo AS PH
                RIGHT JOIN catalog_category AS CATE ON PH.catalog_category_id = CATE.catalog_category_id
            WHERE
                PH.catalog_category_id = " . $category_id . " ORDER BY RAND() LIMIT " . $limit;

            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } else {
                
                $data[] = "No Records Found @ $sql";
            }	
            
        }

        return($data);
    }

    public function api_Catalog_Photo($file_name) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            // $sql = "SELECT * from catalog_photo WHERE file_name='" . $file_name . "'";
            // $sql = "SELECT P.*, C.title AS catalog_title, C.path AS catalog from catalog_photo AS P INNER JOIN catalog_category AS C ON C.catalog_category_id=(SELECT catalog_category_id FROM catalog_photo WHERE file_name='" . $file_name . "') WHERE P.file_name='" . $file_name . "'";

            $sql = "SELECT
                P.*,
                C.title as category_title
            FROM
                catalog_photo AS P
                INNER JOIN catalog_category AS C ON C.catalog_category_id = (
                    SELECT
                        catalog_category_id
                    FROM
                        catalog_photo
                    WHERE
                        file_name = '" . $file_name . "')
                WHERE
                    file_name = '" . $file_name . "'";
        
            print $sql;
            print "<hr />";

            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }
                
            } else {
                
                /* This should go to a custom photo not found page */
                header('location: /404');
                $data[] = "No Records Found";
            }	
            
        }

        return($data);
    }

    public function api_Catalog_Category_List($catalog_path=null) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            if(is_null($catalog_path)) {
                $sql = "SELECT * FROM catalog_category";
            } else {
                $sql = "SELECT * FROM catalog_category WHERE path ='" . $catalog_path . "'";
            }

            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } else {
                
                $data[] = "No Records Found";
            }	
            
        }

        return($data);
    }

}
?>