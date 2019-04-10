<?php

class Core_Api extends Core_Data
{
    public function getCatalog_Category_Index($category, $output_var) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $category = ltrim($category, '/');
            
            // $sql = "SELECT P.* FROM catalog_photo as P
            // WHERE P.catalog_category_id = (SELECT catalog_category_id FROM catalog_category WHERE path='" . $category . "')";

            $sql = "SELECT DISTINCT P.file_name, P.title, P.catalog_category_id FROM catalog_photo as P
            RIGHT JOIN catalog_category AS C ON P.catalog_category_id = (SELECT catalog_category_id FROM catalog_category WHERE path='" . $category . "')";


            // print $sql;
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

        // $this->printp_r($data);
        $this->$output_var = (object) $data;
    }

    public function getCatalog_Category_FilmsStrip($category_id, $limit, $output_var) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT * from catalog_photo WHERE catalog_category_id=" . $category_id . " LIMIT " . $limit;
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

        $this->$output_var = (object) $data;
    }

    public function getCatalog_Photo($file_name, $output_var) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            // $sql = "SELECT * from catalog_photo WHERE file_name='" . $file_name . "'";
            $sql = "SELECT P.*, C.title AS category_title, C.path AS catalog from catalog_photo AS P INNER JOIN catalog_category AS C ON C.catalog_category_id=(SELECT catalog_category_id FROM catalog_photo WHERE file_name='" . $file_name . "') WHERE P.file_name='" . $file_name . "'";

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

        // $this->printp_r($data);
        $this->$output_var = (object) $data;
    }

    public function getCatalog_CategoryList($output_var) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT * FROM catalog_category";
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

        $this->$output_var = (object) $data;
    }

}
?>