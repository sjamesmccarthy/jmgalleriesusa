<?php

class Core_Api
{
    public $mysqli;
    
    public function startDB() 
	{

        /* Database Authentication */
        $hostname = $this->config_env->env[$this->env]['host'];
        $username = $this->config_env->env[$this->env]['user'];
		$password = $this->config_env->env[$this->env]['password'];
		$dbname = $this->config_env->env[$this->env]['dbname'];
		
		// Create connection
        $this->mysqli  = new mysqli ($hostname, $username, $password, $dbname);
	}
    
    public function checkDBConnection($function='Null') {

		if ($this->mysqli->connect_errno) {
		    printf("Connect failed: %s\n", $this->mysqli->connect_error);
            return false;
        } else {
            // print $function . ".mysqli.success(" . $this->config_env->env[$this->env]['dbname'] . "/" . $this->env . ")<br />";
            return true;
        }
    }

	public function closeDB() {

		/* close connection */
		$this->mysqli->close();
    }

    public function api_Catalog_Category_Thumbs($catalog_path) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
                SELECT
                    PH.catalog_photo_id,
                    PH.title,
                    PH.file_name,
                    PH.as_gallery,
                    PH.as_studio,
                    PH.as_open,
                    PH.as_tinyview
                FROM
                    catalog_photo AS PH
                    RIGHT JOIN catalog_category AS CATE ON PH.catalog_category_id = CATE.catalog_category_id
                WHERE
                    CATE.path = '" . $catalog_path ."'
                AND PH.status = 'ACTIVE'";

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

    public function api_Catalog_Category_Thumbs_All() {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
            -- ALL PHOTOS WITH CATEGORY
            SELECT
                PH.catalog_photo_id,
                PH.title,
                PH.file_name,
                PH.as_gallery,
                PH.as_studio,
                PH.as_open,
                PH.as_tinyview,
                CATE.title AS cate_title,
                CATE.path
            FROM
                catalog_photo AS PH
                RIGHT JOIN catalog_category AS CATE ON PH.catalog_category_id = CATE.catalog_category_id
                WHERE PH.status = 'ACTIVE' AND CATE.type = 'CATALOG' and CATE.status = 'ACTIVE'
            ORDER BY PH.title";

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
                PH.status,
                CATE.title AS cate_title
            FROM
                catalog_photo AS PH
                RIGHT JOIN catalog_category AS CATE ON PH.catalog_category_id = CATE.catalog_category_id
            WHERE
                PH.catalog_category_id = " . $category_id . " AND PH.status = 'ACTIVE' ORDER BY RAND() LIMIT " . $limit;

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

    public function api_Catalog_Get_New_Releases($limit, $duration=null, $rand=null) {
        
        if( !is_null($rand) ) {
            $rand = " ORDER BY RAND() ";
        }

        if( is_null($duration) ) { $duration = 4; }

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                P.*,
                C.path as catalog_path
            FROM
                catalog_photo AS P
            INNER JOIN catalog_category AS C ON C.catalog_category_id = P.catalog_category_id
            WHERE
                created < Now()
                AND created > DATE_ADD(Now(), INTERVAL - " . $duration . " MONTH)
           " . $rand . " AND P.status = 'ACTIVE'
            ORDER BY created DESC LIMIT " . $limit;
	
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } else {
                
                $data['error'] = "No Records Found";
                $data['sql'] = $sql;
            }	
            
        }

        return($data);
    }

    public function api_Catalog_YouMayLike_Filmstrip() {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
                SELECT
                    V.count AS VIEWS,
                    PH.title,
                    PH.file_name
                FROM
                    catalog_photo_views AS V
                    RIGHT JOIN catalog_photo AS PH ON V.catalog_photo_id = PH.catalog_photo_id
                WHERE
                    V.count >= 5
                AND PH.status = 'ACTIVE'
                ORDER BY
                    RAND()
                    DESC
                    LIMIT 4";

            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } else {
                
                $data['error'] = "No Records Found";
                $data['sql'] = $sql;
            }	
            
        }

        return($data);
    }

    public function api_Catalog_Photo($file_name) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                P.*,
                C.title as category_title
                -- AL.*
            FROM
                catalog_photo AS P
                INNER JOIN catalog_category AS C ON C.catalog_category_id = (
                    SELECT
                        catalog_category_id
                    FROM
                        catalog_photo
                    WHERE
                        file_name = '" . $file_name . "')
                    -- INNER JOIN art_locations AS AL ON P.on_display = AL.art_location_id
                WHERE
                    file_name = '" . $file_name . "'";
        
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

        return($data);
    }

    public function api_Catalog_Photo_Meta_Location($on_display) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                AL.location,
                AL.city,
                AL.state
            FROM
                art_locations AS AL
                WHERE
                    art_location_id = '" . $on_display . "'";
        
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

    public function api_Catalog_Category_List($catalog_path=null) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            if(is_null($catalog_path)) {
                $sql = "SELECT * FROM catalog_category WHERE type='CATALOG' AND status='ACTIVE'";
            } else {
                $sql = "SELECT * FROM catalog_category WHERE path ='" . $catalog_path . "' AND type='CATALOG'";
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

    public function api_Update_Photo_Viewed($photo_id) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
            INSERT INTO catalog_photo_views (catalog_photo_id, count)
                VALUES('" . $photo_id . "', '1') ON DUPLICATE KEY UPDATE count = count + 1";

            $result = $this->mysqli->query($sql);

            if ($result == TRUE) {
                $data['result'] = '200';
            } else {
                $data['error'] = "SQL UPDATE FAILED " . $photo_id;
                $data['sql'] = $sql;
            }	
            
        }

        return($data);
    }

    public function api_Auth_User($username, $password) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                U.user_id,
                U.artist_id, 
                U.created,
                A.first_name,
                A.last_name,
                A.email,
                A.avatar,
                A.website
            FROM
                USER as U
                INNER JOIN artist AS A ON U.artist_id = A.artist_id
            WHERE
                U.PASSWORD = md5('$password') 
                AND U.USERNAME = '$username' 
            ";

            $result = $this->mysqli->query($sql);
            
             if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
                    $data[] = $row;
		        }
             
                $data['result'] = '200';
                $_SESSION['uid'] =  $data[0]['user_id'];
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $this->log(array("key" => "admin", "value" => "session " . session_id() . " created", "type" => "system"));

            } else {
             
               $data['result'] = '400';
            }	
            
        }

        $this->log(array("key" => "admin", "value" => "logged in successfully from " . $_SESSION['ip'], "type" => "system"));
        
        return($data);
    }

    public function api_Polarized_Get_Latest() {

        // Read in Json file with title and description and link. 
        return($this->getJSON('view/data_polarized.json', 'data'));

    }

    public function api_Hero_Get_Image() {

        // Read in Config var JSON with title and description and link.

        if($this->config->heroimage['random'] == "false") {

            $this->hero_title = $this->config->heroimage[$this->config->heroimage['always_use']]['title'];   
            $this->hero_link  = $this->config->heroimage[$this->config->heroimage['always_use']]['link'];
            $this->hero_image = $this->config->heroimage[$this->config->heroimage['always_use']]['image'];
            $this->hero_text = $this->config->heroimage[$this->config->heroimage['always_use']]['text'];
            $this->hero_position = $this->config->heroimage[$this->config->heroimage['always_use']]['position'];

        } else {
            /* Do some randoming here */
            (int)$max= sizeOf($this->config->heroimage)-2;
            $index = rand(1, $max);

            $this->hero_title = $this->config->heroimage[$index]['title'];   
            $this->hero_link  = $this->config->heroimage[$index]['link'];
            $this->hero_image = $this->config->heroimage[$index]['image'];
            $this->hero_text = $this->config->heroimage[$index]['text'];
            $this->hero_position = $this->config->heroimage[$index]['position'];

        }

    }

    public function api_Admin_Component_Activity() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select value, type, created from log where user_id = " . $_SESSION['uid'] . " order by created DESC LIMIT 20";
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

    public function api_Admin_Component_Photos_Viewed() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                CV.count,
                CP.title,
                CP.file_name,
                CV.updated
                FROM
                catalog_photo_views as CV
                INNER JOIN catalog_photo as CP on CV.catalog_photo_id = CP.catalog_photo_id
                ORDER BY CV.count DESC
                LIMIT 12";
        
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

    public function api_Admin_Component_QuickView_tCat() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select count(catalog_photo_id) AS total from catalog_photo where status = 'ACTIVE'";
        
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }
                
            } 
            
        }

        $data = $data['total'];
        return($data);

    }

    public function api_Admin_Component_QuickView_tCollectors() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select count(first_name) AS total from collector where first_name != ''";
        
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }
                
            } 
            
        }

        $data = $data['total'];
        return($data);

    }

    public function api_Admin_Component_QuickView_tCosts() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                (SUM(AC.print) + SUM(AC.frame) + SUM(AC.mat) + SUM(AC.backing) + sum(AC.packaging) + SUM(AC.shipping) + SUM(AC.ink) + SUM(AC.commission)) AS total
            FROM
                art_costs AS AC";
        
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }
                
            } 
            
        }

        $data = $data['total'];
        return($data);

    }

    public function api_Admin_Component_QuickView_tRevenue() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                sum(A.value) as total FROM art as A
                WHERE
                    A.serial_num IS NOT NULL
                    AND A.art_location_id IN(3,11)";
        
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }
                
            } 
            
        }

        $data = $data['total'];
        return($data);

    }

    public function api_Admin_Get_Photo_Catalog() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            P.catalog_photo_id,
            P.title,
            P.file_name,
            C.title as category,
            C.path,
            PV.count as views
        FROM
            catalog_photo AS P
            INNER JOIN catalog_category AS C ON P.catalog_category_id = C.catalog_category_id
            INNER JOIN catalog_photo_views AS PV ON P.catalog_photo_id = PV.catalog_photo_id
        WHERE P.status = 'ACTIVE'";
        
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
                $this->log(array("key" => "admin", "value" => "Displayed Catalog Index (" . $result->num_rows . ")", "type" => "system"));
            } 
            
        }

        return($data);

    }

    public function api_Admin_Get_Catalog_Categories() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select catalog_category_id, title, type from catalog_category WHERE status = 'ACTIVE'";
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

    public function api_Admin_Get_Locations() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select art_location_id, location, type from art_locations WHERE status = 'ACTIVE' AND type = 'PUBLIC'";
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
}
?>