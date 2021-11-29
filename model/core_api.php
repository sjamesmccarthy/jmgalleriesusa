<?php

class Core_Api extends Fieldnotes_Api
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

    public function getVersion() {
        $ver = $this->mysqli->server_info;
        return($ver);
        $example = "hello";
    }

    public function api_Catalog_Category_Thumbs__Legacy($catalog_path) {
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
                SELECT
                    PH.catalog_photo_id,
                    PH.title,
                    PH.file_name,
                    PH.as_limited,
                    PH.as_studio,
                    PH.as_open
                FROM
                    catalog_photo AS PH
                    RIGHT JOIN catalog_collections AS CATE ON PH.catalog_collections_id = CATE.catalog_collections_id
                WHERE
                    CATE.path = '" . $catalog_path ."'
                AND PH.status = 'ACTIVE'
                ORDER BY PH.created DESC";

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
            SELECT
            	cp.catalog_photo_id,
            	cp.title,
                cp.file_name,
                cp.loc_place,
                cp.available_sizes,
                cp.catalog_photo_id,
                cp.as_limited,
                cp.as_studio,
                cp.as_open,
                cat.title AS cat_title,
                cat.path as catalog_path, 
                cp.available_sizes
            FROM
            	catalog_photo AS cp
            	INNER JOIN catalog_collections AS cat ON cat.catalog_collections_id = cp.parent_collections_id
            WHERE
                cp.status = 'active'
               ORDER BY cp.title";

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

    public function api_Catalog_Category_Filmstrip($category_id, $limit, $edition='ALL') {
        
        if($category_id != "ALL")  {
            $category = "cl.catalog_collections_id = " . $category_id
            . " AND cc.status = 'ACTIVE' "
            . " AND cp.status = 'ACTIVE' ";
        }  else {
            $category = "cc.status = 'ACTIVE'"
            . " AND cp.status = 'ACTIVE' ";
        }

        if($edition == "LE") {
            $category .= "AND cp.as_limited = '1'";
        } elseif($edition == "OE") {
            $category .= "AND cp.as_open = '1'";
        }

        if($limit != "ALL") {
            $limit = "ORDER BY RAND() LIMIT " . $limit;
        } else {
            $limit = "ORDER BY cp.title ASC";
        }

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            cp.catalog_photo_id,
            cp.title,
            cp.file_name,
            cp.loc_place,
            cp.available_sizes,
            cp.catalog_photo_id,
            cp.as_limited,
            cp.as_studio,
            cp.as_open,
            cc.title AS cate_title,
            cc.path as catalog_path,
            cc.status,
            cc.type
        FROM
            catalog_collections_link AS cl
            INNER JOIN catalog_photo AS cp ON cp.catalog_photo_id = cl.catalog_photo_id
            INNER JOIN catalog_collections AS cc ON cc.catalog_collections_id = cl.catalog_collections_id
        WHERE "
            . $category
            . $limit;
        
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

    public function api_Catalog_Category_Filmstrip__Legacy($category_id, $limit) {
        
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
                RIGHT JOIN catalog_collections AS CATE ON PH.catalog_collections_id = CATE.catalog_collections_id
            WHERE
                PH.catalog_collections_id = " . $category_id . " AND PH.status = 'ACTIVE' ORDER BY RAND() LIMIT " . $limit;

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

    public function api_Catalog_Get_New_Releases($limit=4, $duration=null, $rand=null) {
        
        if( !is_null($rand) ) {
            $rand = " ORDER BY RAND() ";
        }

        if( is_null($duration) ) { $duration = 12; }

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            PH.catalog_photo_id,
            PH.title,
            PH.file_name,
            PH.loc_place,
            PH.as_limited,
            PH.as_open,
            CAT.path AS catalog_path
        FROM
            catalog_photo AS PH
        	INNER JOIN catalog_collections AS CAT ON CAT.catalog_collections_id = PH.parent_collections_id
        	INNER JOIN catalog_collections_link AS CPL ON CPL.catalog_photo_id = PH.parent_collections_id
        WHERE
            PH.created > DATE_ADD(Now(), INTERVAL - " . $duration . " MONTH)
            AND PH.status = 'ACTIVE'
            AND PH.as_limited = '1'
        ORDER BY
            PH.created DESC
        LIMIT " . $limit;
    
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

    public function api_Product_Get_Item($uri_path, $id=null) {
        
        if(isSet($id)) {
            $where = "product_id = '" . $id . "'";
        } else {
            $where = "uri_path = '" . $uri_path . "'";
        }

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                *
            FROM
                product
            WHERE " . $where;
    
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }
                
            } else {
                
                $data['error'] = "No Records Found";
                $data['error_no'] = "0REC";
                $data['sql'] = $sql;
            }	
            
        }

        return($data);
    }

    public function api_Product_Get_All() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                *
            FROM
                product
            WHERE in_stock = 'true' AND status ='ACTIVE' and type != 'group' ORDER BY price ASC";
    
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

    public function api_CollectorDash_Get_Portfolio($id) {
         
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
            SELECT
            A.art_id,
            A.title,
            A.reg_num, 
            A.print_size,
            A.frame_size,
            A.edition_num,
            A.edition_num_max,
            A.edition_style,
            A.series_num,
            C.first_name,
            C.last_name,
            C.company,
            A.value,
            CERT.catalog_photo_id,
            CAT.file_name,
            CERT.serial_num,
            CERT.purchase_date,
            CERT.certificate_id
        FROM
            certificate AS CERT
            INNER JOIN collector AS C ON CERT.collector_id = C.collector_id
            INNER JOIN art AS A ON A.art_id = CERT.art_id
            LEFT JOIN catalog_photo AS CAT on CAT.catalog_photo_id = CERT.catalog_photo_id
            WHERE C.collector_id = '" . $id . "'  AND A.edition_style IN ('STUDIO','LIMITED')";
          
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

           $sql = "SELECT
           V.count AS VIEWS,
           PH.catalog_photo_id,
           PH.title,
           PH.file_name,
           PH.loc_place,
           PH.as_limited,
           PH.as_open,
           CAT.path as cate_path
       FROM
           catalog_photo_views AS V
           INNER JOIN catalog_photo AS PH ON V.catalog_photo_id = PH.catalog_photo_id
           INNER JOIN catalog_collections AS CAT ON CAT.catalog_collections_id = PH.parent_collections_id
       WHERE
           V.count >= 800
           AND PH.status = 'ACTIVE'
           AND PH.as_limited = 1
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

    public function api_Catalog_Photo($id=0,$file_name=null) {

        if($file_name == null) {
            $where = "catalog_photo_id = '" . $id . "'";
        } else {
            $where = "file_name = '" . $file_name . "'";
        }   

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql ="SELECT
                    cp.*,
                    cc.title as catalog_title
                FROM
                    catalog_photo AS cp
                    INNER JOIN catalog_collections AS cc ON cc.catalog_collections_id = cp.parent_collections_id
                WHERE " .
                    $where;

            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }

            } else {
            

                // $_SESSION['404_msg'] = '<p>No Photo Was Found By This Name (e_code: ' . __FUNCTION__ . '[' . $file_name . '])</p>';
                // $this->log(array("key" => "api", "value" => "Failed Update Catalog Photo " . $_POST['title'] . " (" . $_POST['catalog_photo_id'] . ") " . $sql, "type" => "failure"));

                /* This should go to a custom photo not found page */
                $this->record_404($_SERVER['REQUEST_URI']);
                header('location: /404');
            }	
            
        }

        return($data);
    }

    public function api_Admin_Get_CollectionsByPhoto($id, $parent_collections) {


        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            cl.catalog_photo_id,
            cl.catalog_collections_id,
            cc.title,
            cc.catalog_code
        FROM
            catalog_collections_link as cl
            inner join catalog_collections as cc on cc.catalog_collections_id = cl.catalog_collections_id
        WHERE
            cl.catalog_photo_id = '" . $id . "'
            AND cl.catalog_collections_id NOT IN (" . $parent_collections . ")";

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
                $sql = "SELECT * FROM catalog_collections WHERE type='collection' AND status='active' ORDER BY title ASC";
            } else {
                $sql = "SELECT * FROM catalog_collections WHERE path ='" . $catalog_path . "' AND status='active' ORDER BY title ASC";
            }

            // $this->console($sql);
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

        /* Skip for ignoreIP list */
        // If IP is in array skip logging 
        
        if($photo_id == 0) {
            $this->log(array("key" => "public", "value" => "Invalid PhotoId (" . $photo_id . "::" . $this->page->photo_path . "::".  __FUNCTION__ . "::" . $this->routes->URI->url . "::" . $this->routes->URI->useragent . ")", "type" => "warning"));
        }

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

    public function api_Auth_User__Legacy($username, $password) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                U.user_id,
                U.artist_id, 
                U.created as membersince,
                A.first_name,
                A.last_name,
                A.email,
                A.avatar,
                A.website
            FROM
                user as U
                INNER JOIN artist AS A ON U.artist_id = A.artist_id
            WHERE
                U.PASSWORD = md5('$password') 
                AND U.USERNAME = '$username' 
            ";

             if ($result->num_rows > 0) {
                

                while($row = $result->fetch_assoc())
		        {
                    $data[] = $row;
		        }
             
                $data['result'] = '200';
                $_SESSION['uid'] =  $data[0]['user_id'];
                if($_SERVER['REMOTE_ADDR'] != "::1") {
                    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                } else {
                    $_SESSION['ip'] = '127.0.0.1';
                }
                // $this->log(array("key" => "api", "value" => "session " . session_id() . " created", "type" => "system"));

            } else {
             
               $data['result'] = '400';
            }	
        }

        $this->log(array("key" => "api", "value" => "logged in from " . $_SESSION['ip'], "type" => "system"));
        
        return($data);
    }

    public function api_Auth_User($username, $password) {

        $pin = strtoupper($_POST['p_1'] . $_POST['p_2'] . $_POST['p_3'] . $_POST['p_4'] . $_POST['p_5'] . $_POST['p_6']);
        $hash_str = md5("[/" . strtolower($_POST['username']) . "+" . $pin . "/p]");

        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                U.user_id,
                U.username,
                U.artist_id, 
                U.created as membersince,
                U.type,
                A.artist_id,
                A.first_name,
                A.last_name,
                A.email,
                A.avatar,
                A.website,
                C.collector_id,
                C.first_name as first_name_c,
                C.last_name as last_name_c
            FROM
                user as U
                LEFT JOIN artist AS A ON U.artist_id = A.artist_id
                LEFT JOIN collector AS C ON C.collector_id = U.collector_id
            WHERE
                U.pin = '$hash_str'
                AND U.USERNAME = '$username' 
            ";

            $result = $this->mysqli->query($sql);     
            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc())
		        {
                    $data = $row;
		        }
             
                $data['result'] = '200';
                $_SESSION['dashboard'] = $data['type'];
                $_SESSION['uid'] =  $data['user_id'];
                   
                switch($data['type']) {

                    case "ARTIST":
                    $_SESSION['artist_id'] =  $data['artist_id'];
                    break;

                    case "COLLECTOR":
                    $_SESSION['collector_id'] =  $data['collector_id'];
                    break;

                    default:
                    // print "switch.break()";
                    break;

                }

                if($_SERVER['REMOTE_ADDR'] != "::1") {
                    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                } else {
                    $_SESSION['ip'] = '127.0.0.1';
                }
                // $this->log(array("key" => "api", "value" => "session " . session_id() . " created", "type" => "system"));
                
                $_SESSION['data'] = $data;

            } else {
               $data['result'] = '400';
            }	
        }

        $this->log(array("key" => "admin", "value" => "logged in from " . $_SESSION['ip'], "type" => "system"));

        return($data);
    }

    public function api_Polarized_Get_Latest() {

        $result = $this->getJSON('view/data_polarized.json', 'data_polarized');
        return($result);

    }

    public function api_AmazingOffer_Get_Latest() {

        $result = $this->getJSON('view/data_amazingoffer.json', 'data_ao');
        return($result);

    }

    public function api_MyRewards_Get_Points($id) {

         /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                	SUM(a.value) as points
                FROM
                	collector as c
                	INNER JOIN certificate AS cert ON c.collector_id = cert.collector_id
                	INNER JOIN art as a on a.art_id = cert.art_id
                WHERE
                	c.collector_id = '" . $id . "'";

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

    public function api_Hero_Get_Image() {

        // Read in Config var JSON with title and description and link.
        // Fetch from database
        
           /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {
          
        $sql = "
        SELECT
        	PH.catalog_photo_id,
        	PH.title,
        	PH.file_name,
        	PH.parent_collections_id,
        	PH.featured,
        	CAT.title AS category,
        	PH.status,
        	CAT.path,
        	PV.count AS views,
        	PV.updated AS lastview
        FROM
        	catalog_photo AS PH
        	INNER JOIN catalog_collections AS CAT ON CAT.catalog_collections_id = PH.parent_collections_id
        	LEFT JOIN catalog_photo_views AS PV ON PH.catalog_photo_id = PV.catalog_photo_id
        WHERE
        	PH.featured = '1' AND
            PH.orientation = 'landscape' AND
            PH.status = 'ACTIVE'
        ORDER BY
        	RAND()
        	DESC
        -- LIMIT 4";

            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } 
            
        }

            /* Do some randoming here */
            (int)$max= count($data)-1;
            $index = rand(0, $max);

            $this->hero_title = $data[$index]['category'];   
            $this->hero_link  = $data[$index]['path'];
            $this->hero_image = $data[$index]['file_name'] . '.jpg'; 
            $this->hero_text = 'light';
            $this->hero_position = 'top';

    }

    public function api_Admin_Component_Activity() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select value, type, created from log where user_id = " . $_SESSION['uid'] . " order by created DESC LIMIT 100";
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
                CP.catalog_photo_id,
                CP.title,
                CP.file_name,
                CP.as_limited,
                CP.as_studio,
                CP.as_open,
                CV.updated, 
                CP.featured
                FROM
                catalog_photo_views as CV
                INNER JOIN catalog_photo as CP on CV.catalog_photo_id = CP.catalog_photo_id
                WHERE CP.status = 'ACTIVE'
                ORDER BY CV.updated DESC
                LIMIT 100";
        
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

            $sql_SM = "SELECT
                SUM(ACS. `usage` * SM.`cost`) as total_costs
            FROM
                art_costs_supplier AS ACS
                INNER JOIN supplier_materials AS SM ON ACS.supplier_materials_id = SM.supplier_materials_id
            ";
        
            $result_SM = $this->mysqli->query($sql_SM);

            if ($result_SM->num_rows > 0) {
            
                while($row_SM = $result_SM->fetch_assoc())
		        {
		            $data_SM = $row_SM;
		        }
                
            } 
            
        }

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                (SUM(AC.print) + SUM(AC.frame) + SUM(AC.mat) + SUM(AC.backing) + sum(AC.packaging) + SUM(AC.shipping) + SUM(AC.ink)) AS total
            FROM
                art_costs AS AC
                INNER JOIN art AS A ON A.art_id = AC.art_id
            WHERE AC.status = 'ACTIVE'";
        
            $result = $this->mysqli->query($sql);

            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data = $row;
		        }
                
            } 
            
        }

        $data = $data_SM['total_costs'] + $data['total'];
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
            PH.catalog_photo_id,
            PH.title,
            PH.file_name,
            PH.parent_collections_id,
            PH.featured,
            PH.as_open,
            PH.as_limited,
            CAT.title AS category,
            PH.status,
            CAT.path,
            PV.count AS views,
            PV.updated AS lastview
        FROM
            catalog_photo AS PH
            INNER JOIN catalog_collections AS CAT on CAT.catalog_collections_id = PH.parent_collections_id
            LEFT JOIN catalog_photo_views AS PV ON PH.catalog_photo_id = PV.catalog_photo_id
            ORDER BY PH.title ASC";

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

    public function api_Admin_Get_Inventory() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                A.art_id,
                A.title,
                A.series_num,
                A.edition_num,
                A.edition_num_max,
                A.serial_num,
                A.print_size,
                A.print_media,
                L.location,
                C.acquired_from,
                A.value AS TOTAL_VALUE
            FROM
                art as A
                INNER JOIN art_locations as L on A.art_location_id = L.art_location_id 
                LEFT JOIN certificate as C on A.art_id = C.art_id";
        
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
    
    public function api_Admin_Get_InventoryForShop() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                A.art_id,
                A.title,
                A.art_location_id,
                A.series_num,
                A.edition_num,
                A.edition_num_max,
                A.serial_num,
                A.print_size,
                A.print_media,
                L.location,
                C.acquired_from,
                A.value AS TOTAL_VALUE
            FROM
                art as A
                INNER JOIN art_locations as L on A.art_location_id = L.art_location_id 
                LEFT JOIN certificate as C on A.art_id = C.art_id
                WHERE A.art_location_id = 12
                ORDER BY A.title ASC";
        
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

    public function api_Admin_Get_Inventory_Item($art_id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                A.*
            FROM
                art AS A
            WHERE
                A.art_id ='" . $art_id . "'";
        
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

    public function api_Admin_Get_Inventory_COA($art_id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                A.title as coa_title,
                C.collector_id,
                C.first_name as coa_first_name,
                C.last_name as coa_last_name,
                C.company as coa_company,
                A.value as coa_value,
                CERT.serial_num as coa_serial_num,
                CERT.purchase_date as coa_purchase_date,
                CERT.certificate_id as coa_certificate_id,
                CERT.acquired_from,
                CERT.purchase_date,
                CERT.catalog_photo_id
            FROM
                certificate AS CERT
                INNER JOIN collector AS C ON CERT.collector_id = C.collector_id
                INNER JOIN art AS A ON A.art_id = CERT.art_id
                WHERE A.art_id = '" . $art_id . "'
                AND CERT.status = 'ACTIVE'
            LIMIT 1";
        
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

    public function api_Admin_Get_Inventory_Supplier_Materials () {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            	SM.supplier_materials_id,
                SM.manual_entry,
            	SM.supplier_id,
            	SM.material_type,
            	SM.material as material_desc,
                SM.cost,
            	SM.quantity as quantity_bought,
            	SM.unit_type,
            	S.company as supplier
            FROM
            	supplier_materials AS SM
            	LEFT JOIN supplier AS S ON S.supplier_id = SM.supplier_id
            where SM.manual_entry = 'false'
            ORDER BY SM.material_type ASC
            ";

            $result = $this->mysqli->query($sql);
    
            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } else {
                $data[0]['material_type'] = 'SQL FAILED no-records-returned: ' . __FUNCTION__;
            }
            
        }

        return($data);

    }

    public function api_Admin_Get_Inventory_Item_Costs($art_id) {

        /* first check classic table */
        /* If results found convert to manual entires */ 
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                AC.print,
                AC.ink,
                AC.frame,
                AC.mat,
                AC.backing,
                AC.packaging,
                AC.shipping,
                AC.hanger
            FROM
                art AS A
                INNER JOIN art_costs AS AC ON AC.art_id = A.art_id
            WHERE A.art_id = '" . $art_id . "' AND STATUS='ACTIVE'
            ";
        
            $result = $this->mysqli->query($sql);
            if ($result->num_rows > 0) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
                }

                $this->api['table'] = "art_costs";
            } else {
                /* No Costs found in classic table art_costs, try new cost_supplier table */

                $sql = "SELECT
                    A.art_id,
                    A.title as art_title,
                    SM.manual_entry,
                    ACS.supplier_materials_id,
                    ACS.usage,
                    S.company as supplier,
                    SM.material_type,
                    SM.cost,
                    SM.quantity as quantity_bought,
                    ACS.usage as material_used,
                    SM.unit_type,
                    SM.material as material_desc,
                    (CASE 
                        WHEN SM.unit_type = 'hourly' THEN ACS.usage
                        ELSE (SM.quantity - ACS.usage)
                    END) AS calcd_inventory,
                    (CASE 
                        WHEN SM.unit_type = 'each' THEN SM.cost
                        WHEN SM.unit_type = 'hourly' THEN SM.cost * ACS.usage
                        WHEN SM.unit_type = 'feet' THEN (SM.cost/SM.quantity) * ACS.usage
                        ELSE (SM.cost/SM.quantity)
                    END) AS calcd_cost
                FROM
                    art AS A
                    INNER JOIN art_costs_supplier AS ACS ON A.art_id = ACS.art_id
                    LEFT OUTER JOIN supplier_materials AS SM ON ACS.supplier_materials_id = SM.supplier_materials_id
                    LEFT OUTER JOIN supplier AS S ON SM.supplier_id = S.supplier_id
                WHERE
                    A.art_id ='" . $art_id . "'";

                    $result = $this->mysqli->query($sql);

                    if ($result->num_rows > 0) {
                    
                        while($row = $result->fetch_assoc())
                        {
                            $data[] = $row;
                        }
                        $this->api['table'] = "art_costs_supplier";
                    } else {
                        /* No Costs Anywhere */
                        // $data['resp'] = '501';
                    }

            }
            
        }

        return($data);

    }

    public function api_Admin_Get_Catalog_Categories() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select catalog_collections_id, title, type, catalog_code from catalog_collections WHERE type='collection' AND status = 'active'";
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

    public function api_Admin_Get_LookUpCollectionByName($path) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT title, path from catalog_collections where path='" . $path . "' AND status='active'";

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

    public function api_Admin_Get_Locations($all=null) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            if( $all = '' ) { $addToSQL = " AND type = 'PUBLIC'"; } else { $addToSQL = ''; }

            $sql = "select art_location_id, location, type, status from art_locations WHERE status = 'ACTIVE' OR status = 'DISABLED' " . $addToSQL;
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

    public function api_Admin_Get_Collectors_List() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "select collector_id, first_name, last_name, company from collector";
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

    public function api_Admin_Get_Collector($id,$email=null) {

        if($id != "null") {
            $where_clause = "C.collector_id ='" . $id . "'";
        } else {
            $where_clause = "C.email ='" . $email . "'";
        }

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                C.*
            FROM
                collector AS C
            WHERE " . $where_clause;
                
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

    public function api_Admin_Get_Collector_Artwork($first_name, $last_name) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
            SELECT
                A.title,
                A.value,
                A.reg_num,
                A.art_id, 
                A.frame_size,
                CERT.serial_num,
                CERT.purchase_date,
                CERT.certificate_id
            FROM
                certificate AS CERT
                INNER JOIN collector AS C ON CERT.collector_id = C.collector_id
                INNER JOIN art AS A ON A.art_id = CERT.art_id
                WHERE C.first_name LIKE '{$first_name}' AND C.last_name LIKE '{$last_name}' AND CERT.status='ACTIVE'";
        
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

    public function api_Admin_Get_Collector_UserAct($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
            select user_id, username, created, last_update, last_login, last_login_ip from user where collector_id='" . $id . "'";
        
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

    public function api_Admin_Get_Locations_History($art_id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {
            
            $this->mysqli->free;
            
            $sql = "SELECT
                ALH.*,
                AL.location,
                A.art_id,
                A.title,
                A.value
            FROM
                art_locations_history AS ALH
                INNER JOIN art AS A ON A.art_id = ALH.art_id
                INNER JOIN art_locations AS AL ON ALH.art_location_id = AL.art_location_id
            WHERE
                ALH.art_id='" . $art_id . "' ORDER BY ALH.date_started";
    
            $result = $this->mysqli->query($sql);
            
            if ($result) {
            
                while($row = $result->fetch_assoc())
		        {
		            $data[] = $row;
		        }
                
            } 
            
            $this->mysqli->close;
        }
        
        return($data);

    }

    public function api_Admin_Update_Catalog() {

        /* extract Data Array */
        // $_POST = $this->mysqli->real_escape_string($_POST);
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        /* Insert into database */
        $story = $this->mysqli->real_escape_string($_POST['story']);
        $available_sizes = $this->mysqli->real_escape_string($_POST['available_sizes']);

        if( !isSet($_POST['featured']) ) { $featured = '0'; }

        /* do a little fixing on edition type */
        // if($previous_edition == "as_limited") {
        //     $as_limited = "0";
        // }

        // if($previous_edition == "as_open") {
        //     $as_open = "0";
        // }

        if($as_edition == "as_limited") {
            $as_limited = "1";
            $as_open = "0";
        }

        if($as_edition == "as_open") {
            $as_open = "1";
            $as_limited = "0";
        }

        $sql = "UPDATE catalog_photo 
        SET 
        parent_collections_id = '$parent_collections_id',
        title = '$title',
        story = '$story',
        file_name = '$file_name',
        loc_city = '$loc_city',
        loc_state = '$loc_state',
        loc_place = '$loc_place',
        loc_waypoint = '$loc_waypoint',
        camera = '$camera',
        lens_model = '$lens_model',
        aperture = '$aperture',
        shutter = '$shutter',
        focal_length = '$focal_length',
        iso = '$iso',
        date_taken = '$date_taken',
        orientation = '$orientation',
        available_sizes = '$available_sizes',
        tags = '$tags',
        created = '$created',
        status = '$status',
        on_display = '$on_display',
        as_limited = '$as_limited',
        as_open = '$as_open',
        featured = '$featured',
        `desc` = '$desc'
        WHERE catalog_photo_id = '$catalog_photo_id'";

        $result = $this->mysqli->query($sql);
        // removed this sql AND file_name = '$file_name'
        
        // if($this->mysqli->affected_rows == 0) {
        //  $result=0;   
        // } else { $result=1; }
        
        /* DELETE ALL catalog_collection_link records for this ID */
        $sql_d = "DELETE FROM catalog_collections_link WHERE catalog_photo_id = '" . $catalog_photo_id . "'";
        $result_d = $this->mysqli->query($sql_d);
        
        /* Add parent collection to the array */
        if(!isSet($_POST['collections_tags'])) {
            $collections_tags = array();
        }
        
        array_push($collections_tags, $parent_collections_id);
        
        foreach($collections_tags as $key => $value) {
        
            $sql_ci = "INSERT INTO catalog_collections_link (catalog_photo_id,catalog_collections_id,artist_id)
                VALUES('" . $catalog_photo_id . "','" . $value . "','" . $artist_id . "')";
            $result_ci = $this->mysqli->query($sql_ci);
        
        }
        
        /* Check to see if files have been uploaded */
        $this->uploadFile(array("jpg","jpeg"), "jpg");
        
        /* If file-name changes then image file names need to be updated too */
        // file_1_path, file_2_path {not writing file name in hidden input}
        // rename ("/folder/file.ext", "/folder/newfile.ext");
        
        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "api", "value" => "Updated Catalog Photo " . $_POST['title'] . " (" . $_POST['catalog_photo_id'] . ") ", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $_SESSION['notify_msg'] = 'SQL WARNING - ' . $_POST['title'] . ' - NOT UPDATED';
            $this->log(array("key" => "api", "value" => "Failed Update Catalog Photo " . $_POST['title'] . " (" . $_POST['catalog_photo_id'] . ") " . 'SQL Warning', "type" => "failure"));
        }

    }

    public function api_Admin_Insert_Catalog() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        
        /* Insert into database */
        $story = $this->mysqli->real_escape_string($_POST['story']);
        $title = $this->mysqli->real_escape_string($_POST['title']);
        $available_sizes = $this->mysqli->real_escape_string($_POST['available_sizes']);

        if( !isSet($_POST['featured']) ) { $featured = '0'; }
        if( !isSet($_POST['as_studio']) ) { $as_studio = '0'; }

        if($as_edition == "as_limited") {
            $as_limited = "1";
            $as_open = "0";
        }

        if($as_edition == "as_open") {
            $as_open = "1";
            $as_limited = "0";
        }

        $sql = "
        INSERT INTO `catalog_photo` (
        `catalog_photo_id`, 
        `artist_id`, 
        `parent_collections_id`, 
        `title`, 
        `desc`,
        `story`, 
        `file_name`, 
        `loc_city`, 
        `loc_state`, 
        `loc_place`, 
        `loc_waypoint`, 
        `camera`, 
        `lens_model`, 
        `aperture`, 
        `shutter`, 
        `focal_length`, 
        `iso`, 
        `date_taken`, 
        `orientation`,
        `available_sizes`,
        `tags`, 
        `created`, 
        `status`, 
        `on_display`, 
        `as_limited`, 
        `as_studio`, 
        `as_open`,
        `featured`
        ) VALUES ( 
            DEFAULT, 
            '$artist_id', 
            '$parent_collections_id', 
            '$title', 
            '$desc',
            '$story', 
            '$file_name', 
            '$loc_city', 
            '$loc_state', 
            '$loc_place', 
            '$loc_waypoint', 
            '$camera', 
            '$lens_model', 
            '$aperture', 
            '$shutter', 
            '$focal_length', 
            '$iso', 
            '$date_taken', 
            '$orientation', 
            '$available_sizes',
            '$tags', 
            '$created', 
            '$status', 
            '$on_display', 
            '$as_limited', 
            '$as_studio', 
            '$as_open',
            '$featured'
            )";

        $result = $this->mysqli->query($sql);
        $catalog_photo_id = $this->mysqli->insert_id;

         /* Add parent collection to the array */
        if(!isSet($_POST['collections_tags'])) {
            $collections_tags = array();
        }
        
        array_push($collections_tags, $parent_collections_id);

        foreach($collections_tags as $key => $value) {

            $sql_ci = "INSERT INTO catalog_collections_link (catalog_photo_id,catalog_collections_id,artist_id)
                VALUES('" . $catalog_photo_id . "','" . $value . "','" . $artist_id . "')";
            $result_ci = $this->mysqli->query($sql_ci);

        }

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "api", "value" => "New Photo Added (" . $_POST['title'] . ") to catalog ", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Insert of Catalog Photo (" . $_POST['title'] . ") . $sql . ", "type" => "failure"));
        }

        /* Check to see if files have been uploaded */
        $this->uploadFile(array("jpg","jpeg"), "jpg");

    }

    public function api_Admin_Update_Inventory_Location() {
        
        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        $date = date("Y-m-d H:i:s");
        
        /* There doesn't seem to be a default value set for new art */
        if($art_location == 0) { $art_location = 1; }
        
            $sql_check = "SELECT * FROM art_locations_history WHERE art_id='" . $art_id . "'";
            $result_check = $this->mysqli->query($sql_check);

            if ($result_check->num_rows == 0) {
            
                $sql_new = "
                    INSERT INTO `art_locations_history` 
                    (
                        `art_locations_history_id`, 
                        `art_id`, 
                        `art_location_id`, 
                        `date_started`
                    ) VALUES ( 
                        DEFAULT, 
                        '$art_id', 
                        '$art_location',
                        '$date'
                    )";

                $result_new = $this->mysqli->query($sql_new);
                return;
                
            }

        /* If state_ is set than update last record with end date */
        if(isSet($state_location_id) && $state_location_id != $art_location) {

            $sql_u = "
            UPDATE `art_locations_history` 
            SET
                `date_ended`='$date'
            WHERE 
                art_id='" . $art_id . "' AND art_location_id='" . $state_location_id . "'";
                
            $result_u = $this->mysqli->query($sql_u);
        } 
        
        /* Insert into database */
        if(!isSet($_POST['state_location_id']) || $state_location_id != $art_location) {
        
            $sql = "
            INSERT INTO `art_locations_history` 
            (
                `art_locations_history_id`, 
                `art_id`, 
                `art_location_id`, 
                `date_started`
            ) VALUES ( 
                DEFAULT, 
                '$art_id', 
                '$art_location',
                '$date'
            )";

            $result = $this->mysqli->query($sql);

            if($result == 1) {
                $this->log(array("key" => "api", "value" => "Location Change for Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ") ", "type" => "success"));
            } else {
                $this->log(array("key" => "api", "value" => "Failed Location Change for Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ")", "type" => "failure"));
            }
        } 

    }
   
    public function api_Admin_Update_Inventory_Collector() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        $acquired_from = $this->mysqli->real_escape_string($_POST['acquired_from']);
        $date = date("Y-m-d H:i:s");

        /* If state_ is set than update certificate record */
        if(isSet($state_collector_id) && $state_collector_id == $collector) {

            $sql_u = "
            UPDATE `certificate` 
            SET
                `serial_num`='$serial_num',
                `artwork_reg`='$reg_num',
                `acquired_from`='$acquired_from',
                `purchase_date`='$acquired_date',
                `catalog_photo_id`='$catalog_photo_id'
            WHERE 
                art_id='" . $art_id . "' AND collector_id='" . $collector . "'";

            $result_u = $this->mysqli->query($sql_u);
        } else {

            $sql_disable = "
            UPDATE `certificate` 
            SET
                `status`='DISABLED'
            WHERE 
                art_id='" . $art_id . "' AND collector_id='" . $state_collector_id . "'";

            $result_disable = $this->mysqli->query($sql_disable);
            
            if($collector != 0) {
                $collector_transfer = TRUE;
            } else {
                return;
            }
            
        }

        /* Insert into database */
        if(!isSet($_POST['state_collector_id']) || $state_collector_id != $collector || $collector_transfer == TRUE) {		

            $sql = "
            INSERT INTO `certificate` 
            (
                `certificate_id`, 
                `art_id`, 
                `collector_id`, 
                `serial_num`,
                `artwork_reg`,
                `acquired_from`,
                `purchase_date`,
                `catalog_photo_id`
            ) VALUES ( 
                DEFAULT, 
                '$art_id', 
                '$collector',
                '$serial_num',
                '$reg_num',
                '$acquired_from',
                '$acquired_date',
                '$catalog_photo_id'
            )";

            // print "<hr />$sql";

            $result = $this->mysqli->query($sql);

            if($result == 1) {
                $this->log(array("key" => "api", "value" => "Location Change for Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ") ", "type" => "success"));
            } else {
                $this->log(array("key" => "api", "value" => "Failed Location Change for Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ")", "type" => "failure"));
            }
        } 
    }

    public function api_Admin_Update_Inventory() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        
        /* Insert into database */
        $notes = $this->mysqli->real_escape_string($_POST['notes']);
        if(empty($_POST['value'])) { $value = '0.00'; }
        if(empty($_POST['listed'])) { $listed = '0.00'; }
        
        $sql = "UPDATE art 
        SET 
        `art_location_id`='$art_location',
        `serial_num`='$serial_num',
        `reg_num`='$reg_num',
        `title`='$title',
        `negative_file`='$negative_file',
        `catalog_photo_id`='$catalog_photo_id',
        `artist_proof`='$artist_proof',
        `series_num`='$series_num',
        `edition_num`='$edition_num',
        `edition_num_max`='$edition_num_max',
        `edition_style`='$edition_style',
        `print_size`='$print_size',
        `print_media`='$print_media',
        `frame_size`='$frame_size',
        `frame_material`='$frame_material',
        `frame_desc`='$frame_desc',
        `notes`='$notes',
        `born_date`='$born_date',
        `listed`='$listed',
        `value`='$value'
         WHERE art_id = '$art_id'";

        $result = $this->mysqli->query($sql);

        // $this->console("SQL:" . $sql,1);
        
        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "api", "value" => "Updated Inventory Art " . $_POST['title'] . " (" . $_POST['art_id'] . ") ", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Update Inventory Art (" . $_POST['title'] . " (" . $_POST['art_id'] . ")", "type" => "failure"));
        }

    }
    
    public function api_Admin_Insert_Inventory() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        
        /* There doesn't seem to be a default value set for new art */
        if($art_location == 0) { $art_location = 1; }
        
        /* Insert into database */
        $title = $this->mysqli->real_escape_string($_POST['title']);
        $frame_desc = $this->mysqli->real_escape_string($_POST['frame_desc']);
        $notes = $this->mysqli->real_escape_string($_POST['notes']);
        if(empty($_POST['value'])) { $value = '0.00'; }
        if(empty($_POST['listed'])) { $listed = '0.00'; }
         
        if(isSet($_POST['product_order_id'])) { 
            $sql_product_order_id = ", `product_order_id`"; 
            $sql_product_order_id_val = ", '" . $_POST['product_order_id'] . "'"; 

        } else { 
            $sql_product_order_id = null; 
        }


        $sql = "
        INSERT INTO `art` (
        `art_id`, 
        `artist_id`, 
        `art_location_id`, 
        `serial_num`,
        `reg_num`, 
        `title`, 
        `negative_file`, 
        `catalog_photo_id`, 
        `artist_proof`, 
        `series_num`, 
        `edition_num`,
        `edition_num_max`, 
        `edition_style`, 
        `print_size`, 
        `print_media`, 
        `frame_size`, 
        `frame_material`, 
        `frame_desc`, 
        `notes`, 
        `born_date`,
        `listed`,
        `value`" . $sql_product_order_id .
        ") VALUES ( 
            DEFAULT, 
            '$artist_id', 
            '$art_location',
            '$serial_num', 
            '$reg_num',
            '$title', 
            '$negative_file',
            '$catalog_photo_id',
            '$artist_proof',
            '$series_num',
            '$edition_num',
            '$edition_num_max', 
            '$edition_style',
            '$print_size',
            '$print_media',
            '$frame_size',
            '$frame_material',
            '$frame_desc',
            '$notes',
            '$born_date',
            '$listed',
            '$value'" . $sql_product_order_id_val .
            ")";

        $result = $this->mysqli->query($sql);
        $_POST['art_id'] = $this->mysqli->insert_id;

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "api", "value" => "New Inventory Added (" . $_POST['title'] . ") ", "type" => "success"));

        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Insert of Inventory Art (" . $_POST['title'] . ")", "type" => "failure"));
        }

    }

    public function api_Admin_Insert_Suppliers() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        /* Insert into database */
        $sql = "INSERT INTO `" . $this->config_env->env[$this->env]['dbname']  . ".`supplier` (`company`, `first_name`, `last_name`, `email`, `phone`, `website`, `account_no`) 
            VALUES ('{$company}', '{$first_name}', '{$last_name}', '{$email}', '{$phone}', '{$website}', '{$account}');";

        $result = $this->mysqli->query($sql);
        $_POST['suppliers_id'] = $this->mysqli->insert_id;

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $company;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $company . " Has Been Added</p>";
            $this->log(array("key" => "api", "value" => "New Supplier Added (" . $_POST['company'] . ") ", "type" => "success"));

        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Insert of Supplier (" . $_POST['company'] . ")", "type" => "failure"));
        }

    }

    public function api_Admin_Update_Suppliers() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        
        /* Insert into database */
             
        $sql = "UPDATE `" . $this->config_env->env[$this->env]['dbname']  . ".`supplier` 
            SET 
            `company` = '{$company}', 
            `first_name` = '{$first_name}', 
            `last_name` = '{$last_name}', 
            `email` = '{$email}', 
            `phone` = '{$phone}', 
            `website` = '{$website}', 
            `account_no` = '{$account}' 
            WHERE `supplier_id` = '" . $supplier_id ."'";

        $result = $this->mysqli->query($sql);
        
        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $company;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $company . " Has Been Updated</p>";
            $this->log(array("key" => "api", "value" => "Updated Supplier (" . $company . ") ", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Update To Supplier (" . $_POST['company'] . ")", "type" => "failure"));
        }
        
        
    }

    public function api_Admin_Update_Inventory_Expenses() {

        $art_id = $_POST['art_id'];
        $tbl = 'art_costs_supplier';
        $artist_id = $_POST['artist_id'];

        // print "api_Admin_Update_Inventory_Expenses()<br />";
        // print "formatting arrays into something useful<br />";

        // $this->printp_r($_POST);
        // print "<hr />";

        /* FORMAT ARRAYS INTO 1 JSON STRING */
        foreach ($_POST['material_expense_supplier_id'] as $key => $value) {
            // SUPPLIER INVENTORY COMBINED ARRAYS
            $inv_exp[$key] = '{"id":"' . $value . '", "quantity":"' . $_POST['material_quantity'][$key] . '", "cost":"' . $_POST['material_cost'][$key] . '", "manual":"FALSE" }';
        } 
        
        foreach ($_POST['hidden-material_expense_supplierid_manual-entry'] as $key_manual => $value_manual) {
            // MANUAL ENTRY INVENTORY COMBINED ARRAYS
            $inv_exp_manual[$key_manual] = '{"id":"' . $value_manual . '", "quantity":"' . $_POST['material_quantity_manual-entry'][$key_manual] . '", "cost":"' . $_POST['material_cost_manual-entry'][$key_manual] . '", "name":"' . $_POST['material_expense_supplier_manual-entry'][$key_manual] . '", "manual":"TRUE" }';
        } 
        
        // $this->printp_r($inv_exp);
        // $this->printp_r($inv_exp_manual);

        // art_costs_supplier
        // INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE name="A", age=19
        // IF id =0 then this is new; mutate the id with actually ID so it can be entered into the linking table
        foreach ($inv_exp_manual as $exp_key => $exp_val) {
            $exp = json_decode($exp_val);
            if($exp->id == 0) { 
                // mutate the json strong with auto_increment_id return
                $exp->id = null;
                $inv_exp_manual[$exp_key] = json_encode($exp);
            }
        }

        // DELETE ALL RECORDS for specific art_id
        // echo "<hr />DELETE from " . $tbl . " WHERE art_id='" . $art_id . "' AND artist_id='" . $artist_id . "'";
        /* Executes SQL and then assigns object to passed var */
        
         if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
            DELETE FROM art_costs_supplier where art_id='" . $art_id . "' AND artist_id='" . $artist_id . "'";

            $result = $this->mysqli->query($sql);

            if ($result == TRUE) {
                $data['result'] = '200';
                // $this->log(array("key" => "api", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") ", "type" => "success"));
            } else {
                $data['result'] = '501';
                $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                $data['sql'] = $sql;
                $this->log(array("key" => "api", "value" => "Failed DELETE Expenses from art_costs_supplier (" . $sql . ")", "type" => "failure"));
            }	
            
        }

        /***
         * PROBLEM AREA
         */

        // Repopulate the art_costs_supplier table for art_id
        // echo "<hr />INSERT manual expenses back into linking table<br />";

            foreach ($inv_exp_manual as $exp_key => $exp_val) {
                $exp = json_decode($exp_val);
                // $this->printp_r($exp);

                if( $this->checkDBConnection(__FUNCTION__) == true) {
                
                    if( $exp->manual == 'TRUE' && !is_null($exp->id) ) { 
                        $sql = "
                        INSERT INTO `art_costs_supplier` (`art_id`, `artist_id`, `supplier_materials_id`, `usage`)
                        VALUES('" . $art_id . "','" . $artist_id . "','" . $exp->id . "','" . $exp->quantity . "');";

                        $result = $this->mysqli->query($sql);

                            if ($result == TRUE) {
                                $data['result'] = '200';
                                // $this->log(array("key" => "api", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") ", "type" => "success"));
                            } else {
                                $data['result'] = '501';
                                $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                                $data['sql'] = $sql;
                                $this->log(array("key" => "api", "value" => "Failed Insert of Manual Expense With {$exp_id} Into Linking Table (" . $sql . ")", "type" => "failure"));
                            }	
                    
                    } else {
                        // print "something went wrong here, possible null Id: " . $exp->id . "<hr />";
                        // $this->printp_r($inv_exp_manual);
                    }
                }
        }
            

        // $this->printp_r($data['result']);
        // echo "<hr />";

        // echo "INSERT supplier-vendor expenses back into linking table<br />";
        // $this->printp_r($inv_exp);

        // Repopulate the art_costs_supplier table for art_id
        foreach ($inv_exp as $exp_key => $exp_val) {
            $exp = json_decode($exp_val);
            // $this->printp_r($exp);

            if( $this->checkDBConnection(__FUNCTION__) == true) {
            
                $sql = "
                INSERT INTO `art_costs_supplier` (`art_id`, `artist_id`, `supplier_materials_id`, `usage`)
                VALUES('" . $art_id . "','" . $artist_id . "','" . $exp->id . "','" . $exp->quantity . "');";

                $result = $this->mysqli->query($sql);

                if ($result == TRUE) {
                    $data['result'] = '200';
                    // $this->log(array("key" => "api", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") ", "type" => "success"));
                } else {
                    $data['result'] = '501';
                    $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                    $data['sql'] = $sql;
                    $this->log(array("key" => "api", "value" => "Failed Supplier-Material Expsense Insert Into Linking Table (" . $sql . ")", "type" => "failure"));
                }	
    
            }
        }
        
        // $this->printp_r($data['result']);
        // echo "<hr />";
        // echo "INSERT/UPDATE supplier_materials<br />";

        $result = FALSE;
        if( empty($inv_exp)) { $inv_exp = array(); }
        if( empty($inv_exp_manual)) { $inv_exp_manual = array(); }
        $exp_combined = array_merge($inv_exp, $inv_exp_manual);

        // $this->printp_r($inv_exp);
        // $this->printp_r($inv_exp_manual);
        // $this->printp_r($exp_combined);

        // supplier_materials
        // Insert/Update all records in supplier_materials BUT also do quantity calculations
        // Use subselect when updating quantity.

        foreach ($exp_combined as $exp_key => $exp_val) {
            $exp = json_decode($exp_val);

            if( $exp->manual == 'TRUE' && is_null($exp->id) ) { 
                $exp->id = 0; 
            }

            // echo 'INSERT INTO supplier_materials (supplier_materials_id, manual_entry, material, quantity, cost) VALUES("' . $exp->id . '","' . $exp->manual . '","' . $exp->name . '","' . $exp->quantity . '","' . $exp->cost . '") ON DUPLICATE KEY UPDATE supplier_materials_id="' . $exp->id . '", manual_entry="' . $exp->manual . '", quantity="' . $exp->quantity . '", cost="'. $exp->cost . '"<br />';
            
            /* Executes SQL and then assigns object to passed var */
            if( $this->checkDBConnection(__FUNCTION__) == true) {
    
                $sql = 'INSERT INTO supplier_materials (supplier_materials_id, manual_entry, material_type, material, quantity, unit_type,
                cost, purchased_on) VALUES("' . $exp->id . '","' . $exp->manual . '","manual_entry","' . $exp->name . '","' . $exp->quantity . '","each","' . $exp->cost . '",NOW()) ON DUPLICATE KEY UPDATE supplier_materials_id="' . $exp->id . '", manual_entry="' . $exp->manual . '", quantity="' . $exp->quantity . '", cost="'. $exp->cost . '"';
        
                $result = $this->mysqli->query($sql);

                if($exp->id == 0) {
                    $insert_id = $this->mysqli->insert_id;
                    // print $exp->id . "<br />";

                    // Repopulate the art_costs_supplier table for art_id
                    // echo "<hr />INSERT manual expenses back into linking table<br />";
                    // $this->printp_r($inv_exp_manual);

                    // foreach ($inv_exp_manual as $exp_key => $exp_val) {
                        $exp = json_decode($exp_val);
                        // $this->printp_r($exp);

                        if( $this->checkDBConnection(__FUNCTION__) == true) {
                        
                            $sql_me = "
                            INSERT INTO `art_costs_supplier` (`art_id`, `artist_id`, `supplier_materials_id`, `usage`)
                            VALUES('" . $art_id . "','" . $artist_id . "','" . $insert_id . "','" . $exp->quantity . "');";

                            // print "SQL---" . $sql_me;

                            $result_me = $this->mysqli->query($sql_me);

                            if ($result_me == TRUE) {
                                $data['result'] = '200';
                                // $this->log(array("key" => "api", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") ", "type" => "success"));
                            } else {
                                $data['result'] = '501';
                                $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                                $data['sql'] = $sql_me;
                                $this->log(array("key" => "api", "value" => "Failed Manual Entry Insert Into Linking Table (" . $sql_me . ")", "type" => "failure"));
                            }		
                            
                        }
                    // }

                    // $this->printp_r($data['result']);
                    // echo "<hr />";
                }

                if ($result == TRUE) {
                    $data['result'] = '200';
                    // $this->log(array("key" => "api", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") ", "type" => "success"));
                } else {
                    $data['result'] = '501';
                    $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                    $data['sql'] = $sql;
                    $this->log(array("key" => "api", "value" => "Failed INSERT/UPDATE Supplier Material (" . $sql . ")", "type" => "failure"));
                }		
                
            }
            // return($data);
        }

        // print "<hr />" . $data['result'];	
        // print "<hr /> Removing Supplier Materials from manual entries<hr />";
        // print "Archiving old art_cost data<br />";
        // legacy_exp
        
        foreach ($inv_exp_manual as $exp_key => $exp_val) {
            $exp = json_decode($exp_val);
            // $this->printp_r($exp);

            if( $this->checkDBConnection(__FUNCTION__) == true) {
            
                $sql = "
                UPDATE art_costs set status='ARCHIVED' where art_id='" . $art_id . "'";

                $result = $this->mysqli->query($sql);

                if ($result == TRUE) {
                    $data['result'] = '200';
                    // $this->log(array("key" => "api", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") ", "type" => "success"));
                } else {
                    $data['result'] = '501';
                    $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                    $data['sql'] = $sql;
                    $this->log(array("key" => "api", "value" => "Failed archving Expense Item (" . $exp . ")", "type" => "failure"));
                }	
                
            }
        }

        if ($result == TRUE) {
            $data['result'] = '200';
            $this->log(array("key" => "api", "value" => "Updated Expenses ", "type" => "success"));
        } else {
            $data['result'] = '501';
            $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
            $data['sql'] = $sql;
            $this->log(array("key" => "api", "value" => "Failed Update To Expenses FATAL (" . $data['error'] . ")" . __FUNCTION__, "type" => "failure"));
        }	

    }

    public function api_Admin_Get_Suppliers() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT supplier_id, company, first_name, last_name, email, phone, website FROM supplier";
        
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

    public function api_Admin_Get_Suppliers_Item($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                supplier_id,
                company,
                first_name,
                last_name,
                email,
                phone,
                website,
                account_no
            FROM
                supplier
            WHERE 
            supplier_id = '" . $id . "'";
        
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
    
    public function api_Admin_Get_Materials() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                SM.supplier_materials_id,
                SM.supplier_id,
                SM.material_type,
                SM.material,
                SM.quantity,
                SM.unit_type,
                S.company
            FROM
                supplier_materials AS SM
                LEFT JOIN supplier AS S ON S.supplier_id = SM.supplier_id
            WHERE SM.manual_entry != 'TRUE'";
        
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

    public function api_Admin_Get_Materials_Item($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                SM.supplier_materials_id,
                SM.supplier_id,
                SM.material_type,
                SM.material,
                SM.quantity,
                SM.unit_type,
                SM.sku,
                SM.cost,
                SM.shipping_cost,
                SM.purchased_on
            FROM
                supplier_materials AS SM
            WHERE
                SM.supplier_materials_id ='" . $id . "'";
        
        
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

public function api_Admin_Get_Materials_By_Supplier($id) {
    
    /* Executes SQL and then assigns object to passed var */
    if( $this->checkDBConnection(__FUNCTION__) == true) {
        
        $sql = "SELECT
        SM.supplier_materials_id,
        SM.supplier_id,
        SM.material_type,
        SM.material,
        SM.quantity,
        SM.unit_type,
        SM.cost,
        SM.purchased_on,
        S.company
    FROM
        supplier_materials AS SM
        LEFT JOIN supplier AS S ON S.supplier_id = SM.supplier_id
        WHERE
        SM.supplier_id ='" . $id . "'";
        
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

    public function api_Admin_Insert_Materials() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        if($shipping_cost == '') { $shipping_cost = '0.00';}
        if($purchased_on == '') { $purchased_on = date("Y-m-d H:i:s"); }

        /* Insert into database */
        $sql = "INSERT INTO `" . $this->config_env->env[$this->env]['dbname']  . ".`supplier_materials` (`supplier_id`, `manual_entry`, `material_type`, `material`, `sku`, `quantity`, `unit_type`, `cost`, `purchased_on`, `shipping_cost`) 
            VALUES ('{$supplier_id}', 'FALSE', '{$material_type}', '{$material}', '{$sku}', '{$quantity}', '{$unit_type}', '{$cost}', '{$purchased_on}', '{$shipping_cost}');";

        $result = $this->mysqli->query($sql);
        $_POST['suppliers_materials_id'] = $this->mysqli->insert_id;

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $material;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $material . " Has Been Added</p>";
            $this->log(array("key" => "api", "value" => "New Material Added (" . $_POST['material'] . ") ", "type" => "success"));

        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Insert of Material (" . $_POST['material'] . ")", "type" => "failure"));
        }

    }

    public function api_Admin_Update_Materials() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        if($shipping_cost == '') { $shipping_cost='0.00';}

        /* Insert into database */
        $sql = "UPDATE `" . $this->config_env->env[$this->env]['dbname']  . ".`supplier_materials` 
        SET `supplier_id` = '{$supplier_id}', 
        `manual_entry` = 'FALSE', 
        `material_type` = '{$material_type}', 
        `material` = '{$material}', 
        `sku` = '{$sku}', 
        `quantity` = '{$quantity}', 
        `unit_type` = '{$unit_type}', 
        `cost` = '{$cost}', 
        `purchased_on` = '{$purchased_on}', 
        `shipping_cost` = '{$shipping_cost}' 
        WHERE `supplier_materials_id` = '" . $supplier_materials_id ."'";

        $result = $this->mysqli->query($sql);

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $company;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $material . " Has Been Updated</p>";
            $this->log(array("key" => "api", "value" => "Updated Supplier (" . $material . ") ", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Update To Material (" . $_POST['material'] . ")", "type" => "failure"));
        }
        
        
    }

    public function api_Admin_Get_Collections() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            c.catalog_collections_id,
            c.title,
            c.path,
            c.status,
            c.type
        FROM
            catalog_collections AS c
            ORDER BY c.title DESC";
        
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

    public function api_Admin_Get_Reports() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            R.report_id,
            R.name,
            R.desc,
            R.sql,
            R.fav
        FROM
            report as R
            WHERE status='ACTIVE'
            ORDER BY R.fav DESC";
        
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
    
    public function api_Admin_Component_Reports() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            R.report_id,
            R.name,
            R.desc,
            R.sql,
            R.fav
        FROM
            report as R
            WHERE status='ACTIVE' and fav=1";
        
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
  
  public function api_Admin_Component_Orders() {
      
              /* Executes SQL and then assigns object to passed var */
              if( $this->checkDBConnection(__FUNCTION__) == true) {
      
                  $sql = "
                  SELECT
                      po.*,
                      pc.*
                  FROM
                      product_order AS po
                      INNER JOIN product_customer AS pc ON pc.product_customer_id = po.product_customer_id
                      ORDER BY po.received DESC";
              
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
     
    public function api_Admin_Get_Collections_Item($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            c.catalog_collections_id,
            c.title,
            c.path,
            c.desc,
            c.status,
            c.type,
            c.catalog_code
        FROM
            catalog_collections AS c
        WHERE c.catalog_collections_id = '" . $id . "'";
        
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

    public function api_Admin_Get_Reports_Item($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            R.report_id,
            R.name,
            R.desc,
            R.sql, 
            R.columns,
            R.fav
        FROM
            report as R
        WHERE R.report_id = '" . $id . "'";
        
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

    public function api_Admin_Insert_Collections() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        /* Insert into database */
        $sql = "INSERT INTO `" . $this->config_env->env[$this->env]['dbname']  . ".`catalog_collections` (`artist_id`, `title`, `path`, `desc`, `status`, `type`, `catalog_code`) 
        VALUES ('{$artist_id}', '{$title}', '{$path}', '{$desc}', '{$status}', '{$type}', '{$catalog_code}');";

        $result = $this->mysqli->query($sql);
        $_POST['report_id'] = $this->mysqli->insert_id;

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $name;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $title . " Has Been Added</p>";
            $this->log(array("key" => "api", "value" => "New Collection Added (" . $_POST['title'] . ") ", "type" => "success"));

        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Insert of Collection (" . $_POST['title'] . ")" . $sql, "type" => "failure"));
        }

    }

    public function api_Admin_Update_Collections() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        $title = $this->mysqli->real_escape_string($_POST['title']);
        $desc = $this->mysqli->real_escape_string($_POST['desc']);

        /* Insert into database */
        $sql = "UPDATE `" . $this->config_env->env[$this->env]['dbname']  . ".`catalog_collections` 
        SET `title` = '{$title}', 
        `path` = '{$path}', 
        `desc` = '{$desc}', 
        `status` = '{$status}', 
        `type` = '{$type}',
        `catalog_code` = '{$catalog_code}'
        WHERE `catalog_collections_id` = '" . $catalog_collections_id ."'";

        $result = $this->mysqli->query($sql);
        
        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $name;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $title . " Has Been Updated</p>";
            $this->log(array("key" => "api", "value" => "Updated Collection (" . $title . ") ", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Update to Collection (" . $_POST['title'] . ")", "type" => "failure"));
        }
        
    }

    public function api_Admin_Insert_Reports() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        if(!isSet($fav)) { $fav = '0'; }
        $sql_c =  $this->mysqli->real_escape_string($sql_c);

        /* Insert into database */
        $sql = "INSERT INTO `" . $this->config_env->env[$this->env]['dbname']  . ".`report` (`name`, `desc`, `sql`, `columns`, `last_run_by`, `fav`) 
        VALUES ('{$name}', '{$desc}', '{$sql_c}', '{$columns}', '{$artist_id}', '{$fav}');";

        $result = $this->mysqli->query($sql);
        $_POST['report_id'] = $this->mysqli->insert_id;

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $name;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $name . " Has Been Added</p>";
            $this->log(array("key" => "api", "value" => "New Report / SQL Mark Added (" . $_POST['name'] . ") ", "type" => "success"));

        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Insert of Report / SQL Mark (" . $_POST['name'] . ")" . $sql, "type" => "failure"));
        }

    }

    public function api_Admin_Update_Reports($sqlOnly=null) {
    
        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        if(!isSet($fav)) { $fav = '0'; }
        $sql_c =  $this->mysqli->real_escape_string($sql_c);

        /* Insert into database */
        $sql = "UPDATE report
        SET `name` = '{$name}', 
        `desc` = '{$desc}', 
        `sql` = '{$sql_c}', 
        `columns` = '{$columns}', 
        `last_run_by` = '{$artist_id}', 
        `fav` = '{$fav}' 
        WHERE `report_id` = '" . $report_id ."'";

        $result = $this->mysqli->query($sql);
        
        if($result == 1) {
            if($sqlOnly != 1) {
                $_SESSION['error'] = '200';
                $_SESSION['notify_msg'] = $name;
                $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $name . " Has Been Updated</p>";
                $this->log(array("key" => "api", "value" => "Updated Report (" . $name . ") ", "type" => "success"));
            } else {
                $this->log(array("key" => "api", "value" => "Updated SQL Statement via Ajax.API  (" . $name . ") ", "type" => "success"));
            }
        } else {
            $_SESSION['error'] = '400';
            $extra_debug = '<br /><span class=\"tiny\">' . $this->mysqli->real_escape_string($sql) . '</span>';
            $this->log(array("key" => "api", "value" => "Failed Update Report (" . $_POST['name'] . ") " . $extra_debug, "type" => "failure"));
        }
        
    }

    public function api_Admin_Get_Collectors() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                C.collector_id,
                C.first_name,
                C.last_name,
                C.company,
                C.email,
                C.phone,
                C.address,
                C.address_extra,
                C.city,
                C.state,
                C.postalcode,
                C.country
            FROM
                collector as C";
        
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

    public function api_Admin_Insert_Collectors() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        /* Insert into database */
        $sql = "INSERT INTO `" . $this->config_env->env[$this->env]['dbname']  . ".`collector` (`first_name`, `last_name`, `company`, `email`, `phone`, `address`, `address_extra`, `city`, `state`, `country`, `postalcode`) 
        VALUES ('{$first_name}', '{$last_name}', '{$company}', '{$email}', '{$phone}', '{$address}', '{$address_extra}', '{$city}', '{$state}', '{$country}', '{$postalcode}');
        ";

        $result = $this->mysqli->query($sql);
        $_POST['suppliers_id'] = $this->mysqli->insert_id;

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $company;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $first_name . " " . $last_name . " Has Been Added</p>";
            $this->log(array("key" => "api", "value" => "New Collector Profile Created (" . $_POST['first_name'] . " " . $_POST['last_name'] . ") ", "type" => "success"));

        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Insert of Collector Profile (" . $_POST['first_name'] . " " . $_POST['last_name'] . ")", "type" => "failure"));
        }

    }

    public function api_Admin_Update_Collectors() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        
        /* Insert into database */
             
        $sql = "UPDATE `" . $this->config_env->env[$this->env]['dbname']  . ".`collector` 
            SET `first_name` = '{$first_name}', 
            `last_name` = '{$last_name}', 
            `company` = '{$company}', 
            `email` = '{$email}', 
            `phone` = '{$phone}', 
            `address` = '{$address}', 
            `address_extra` = '{$address_extra}', 
            `city` = '{$city}', 
            `state` = '{$state}', 
            `country` = '{$country}', 
            `postalcode` = '{$postalcode}' 
                WHERE `collector_id` = '" . $collector_id . "'";

        $result = $this->mysqli->query($sql);
        
        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $company;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $first_name . " " . $last_name . " Has Been Updated</p>";
            $this->log(array("key" => "api", "value" => "Updated Collector Profile for (" .  $first_name . " " . $last_name . ") ", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed Update To Collector Profile for (" .  $first_name . " " . $last_name . ")", "type" => "failure"));
        }
        
        
    }

    public function api_Admin_Get_Users() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            U.user_id,
            U.artist_id,
            U.collector_id,
            U.type,
            U.username,
            U.last_login,
            U.last_login_ip,
            C.first_name as c_first,
            C.last_name as c_last,
            A.first_name as a_first,
            A.last_name as a_last
        FROM
            user as U
            LEFT JOIN artist as A on U.artist_id = A.artist_id
            LEFT JOIN collector as C on U.collector_id = C.collector_id           
            ";
   
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

    public function api_Admin_Get_Users_Item($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
            U.user_id,
            U.artist_id,
            U.collector_id,
            U.type,
            U.username,
            U.last_login,
            U.last_login_ip,
            U.pin,
            C.first_name as c_first,
            C.last_name as c_last,
            A.first_name as a_first,
            A.last_name as a_last
        FROM
            user as U
            LEFT JOIN artist as A on U.artist_id = A.artist_id
            LEFT JOIN collector as C on U.collector_id = C.collector_id 
        WHERE U.user_id = '" . $id . "'";
        
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

    public function api_Admin_Get_Orders() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
            SELECT
            	po.*,
            	pc.*
            FROM
            	product_order AS po
                INNER JOIN product_customer AS pc ON pc.product_customer_id = po.product_customer_id
                ORDER BY po.received DESC";
        
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

    public function api_Admin_Get_Nav_AppsByUser($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "
            SELECT
            	ua.user_apps_id,
                ua.user_role_id,
            	ua.title,
            	ua.path,
                ua.add_new,
                ua.short_code, 
                ua.icon
            FROM
            	user_apps AS ua
            	INNER JOIN user_apps_link AS uap ON ua.user_apps_id = uap.user_apps_id
            WHERE
            	uap.user_id = '1'
            	AND ua.user_role_id != '" . $id . "'
                AND ua.status = '1'
                ORDER BY ua.order ASC";
        
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

    public function api_Admin_Insert_Users() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        // $this->printp_r($_POST);

        /* Generate PIN hash */
        $hash_str = md5("[/" 
        . $username
        . "+"
        .  strtoupper($pin)
        . "/p]");

        /* str to upper */
        $type = strtoupper($type);

        /* Determine Artist or Collector */
        if($type == 'ARTIST') {
            $add_artist_id =  "artist_id,";
        } else {
            $add_collector_id =  "collector_id,";
        }

        /* Insert into database */
        $sql = "INSERT INTO user
        ({$add_artist_id} {$add_collector_id}  type, status, username, pin, last_login_ip) 
        VALUES (
            '{$ac_id}',
            '{$type}', 
            'ACTIVE', 
            '{$username}', 
            '{$hash_str}', 
            '{$_SESSION['ip']}'
            );";

        $result = $this->mysqli->query($sql);
        $new_id = $this->mysqli->insert_id;

        /* Updated Roles & Apps link table */
        $this->processUserRoles($new_id,'new_user');
        $this->processUserApps($new_id,'new_user');

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $username;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $username . " Has Been Added</p>";
            $this->log(array("key" => "api", "value" => "New User Added (" . $_POST['username'] . ") ", "type" => "success"));

        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed To Create New User (" . $_POST['username'] . ")" . $sql, "type" => "failure"));
        }

    }

    private function processUserRoles($id,$state=null) {

        /* Updated Roles link table */
        /* delete all from user_role_link, then insert */

         /* DELETE ALL user_role_link records for this ID */
        if($state != "new_user") {
            $sql_d = "DELETE FROM user_role_link WHERE user_id = '" . $id . "'";
            $result_d = $this->mysqli->query($sql_d);
        }

        foreach ($_POST['role'] as $k_role => $v_role) {

             $sql_r = "
                   INSERT INTO user_role_link (`user_id`, `user_role_id`) 
                   VALUES  ('{$id}', '{$v_role}');";
            
            $result_roles = $this->mysqli->query($sql_r);
        }

    }

    private function processUserApps($id,$state=null) {

        /* Updated Roles link table */
        /* delete all from user_role_link, then insert */

         /* DELETE ALL user_role_link records for this ID */
        if ($state != "new_user") {
            $sql_d = "DELETE FROM user_apps_link WHERE user_id = '" . $id . "'";
            $result_d = $this->mysqli->query($sql_d);
        }

        foreach ($_POST['apps'] as $k_apps => $v_apps) {

             $sql_a = "
                   INSERT INTO user_apps_link (`user_id`, `user_apps_id`) 
                   VALUES ('{$id}', '{$v_apps}');";
            
            $result_apps = $this->mysqli->query($sql_a);

        }

    }

    public function api_Admin_Update_User() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
       
       if ($pin != '') {
            /* Generate PIN hash */
            $hash_str = md5("[/"
            . $username
            . "+"
            .  strtoupper($pin)
            . "/p]");

            $pin_sql = ",`pin`= '" . $hash_str . "'";
       } else {
            $pin_sql = null;
       }


        /* Determine Artist or Collector */
        if($type == 'ARTIST') {
            $add_artist_id =  "`artist_id` = " . $artist_id . ",";
        } else {
            $add_collector_id =  "`collector_id` = " . $collector_id . ",";
        }

        /* Updated Roles & Apps link table */
        $this->processUserRoles($user_id);
        $this->processUserApps($user_id);

        /* Insert into database */
        $sql = "UPDATE `" . $this->config_env->env[$this->env]['dbname'] . "`.`user` SET 
        {$add_artist_id}
        {$add_collector_id}
        `type` = '{$type}', 
        `status` = 'ACTIVE', 
        `username` = '{$username}' 
        {$pin_sql}
        WHERE `user_id` = '{$user_id}'
        ";

        $result = $this->mysqli->query($sql);
 
        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $name;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p>" .  $username . " Has Been Updated</p>";
            $this->log(array("key" => "api", "value" => "Updated User (" . $username . ") ", "type" => "success"));
            return(true);
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed To Update User (" . $_POST['username'] . ")", "type" => "failure"));
            return(false);
        }
        
    }

    public function api_Admin_Auth_Log_Signin($uid) {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        if($_SERVER['REMOTE_ADDR'] != "::1") {
            $IP = $_SERVER['REMOTE_ADDR'];
        } else {
            $IP = '127.0.0.1';
        }

        /* Insert into database */
        $sql = "UPDATE user SET last_login='" . date ("Y-m-d H:i:s", time()) . "', last_login_ip='" . $IP . "' WHERE user_id ='" . $uid . "'";

        $result = $this->mysqli->query($sql);
        
    }

public function api_Admin_Update_Settings() {

        
        foreach($_POST['notice_data'] as $k => $v) {
        
            $_POST['notice_key_mobile_content'][$k] = addslashes($_POST['notice_key_mobile_content'][$k]);
            $_POST['notice_key_content'][$k] = addslashes($_POST['notice_key_content'][$k]);
            
           $notice_array[$v] = array("excludes"=>"{$_POST['notice_key_excludes'][$k]}", "title"=>"{$_POST['notice_key_title'][$k]}", "content"=>"{$_POST['notice_key_content'][$k]}", "mobile_content"=>"{$_POST['notice_key_mobile_content'][$k]}","state"=>"{$_POST['notice_key_state'][$k]}", "timeout"=>"{$_POST['notice_key_timeout'][$k]}", "background_color"=>"{$_POST['notice_key_background_color'][$k]}", "color"=>"{$_POST['notice_key_color'][$k]}");
        }
        
        if ($fp_notices = fopen($_SERVER["DOCUMENT_ROOT"] . '/view/data_notices.json', 'w')) {
            fwrite($fp_notices, json_encode($notice_array));
            fclose($fp_notices);
            $result=1;
        } else {
            $result=0;
        }
        
        unset($_POST['notice_data']);
        unset($_POST['notice_key_excludes']);
        unset($_POST['notice_key_title']);
        unset($_POST['notice_key_content']);
        unset($_POST['notice_key_mobile_content']);
        unset($_POST['notice_key_state']);
        unset($_POST['notice_key_timeout']);
        unset($_POST['notice_key_background_color']);
        unset($_POST['notice_key_color']);

        $form_data = json_encode($_POST);

        if ($fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/config.json', 'w')) {
            fwrite($fp, $form_data);
            fclose($fp);
            $result=1;
        } else {
            $result=0;
        }

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['site_name'];
            $this->log(array("key" => "api", "value" => "Updated Settings " . $_POST['site_name'], "type" => "success"));
        } else {
            $_SESSION['error'] = '501';
            $this->log(array("key" => "api", "value" => "Failed Settings Update " . $_POST['site_name'], "type" => "failure"));
        }

    }

public function api_Insert_Order($params) {

         /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        // result with non fA product
        // {"edition":null,"title":"First Light","size":"5x7","framing":null,"catalog_id":"MDT8OT"}

        // result with FA product 
        // {"edition":"tinyviews","title":"daisies-for-our-lady","size":"12x18","framing":"SNOW-WHITE( $40)","catalog_id":"FFC45OT"}

        if($formType == 'SquarePaymentForm_productOrder') {
            $edition_type = 'product';
            $framing = 'NA';
            $size = 'NA';
        } 

        $item_pack = json_encode(array(
            "edition"=>$edition_type,
            "material"=>$material_type,
            "title"=>$title,
            "size"=>$size,
            "framing"=>$frame,
            "catalog_id"=>$catalog_id
        ));

        // if payment was square, mark invoiced
        if(isSet($params->payment->id)) {
            $invoiced = date("Y-m-d H:i:s");
         } else {
             $invoiced = '1970-01-01 00:00:01';
         }
        
        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

           /* Insert into product_customer table */
            $sql = "
               INSERT INTO product_customer
               (`name`, `email`, `phone`, `address`, `address_other`, `city`, `state`, `postal_code`) 
               VALUES 
               ('{$contactname}', '{$contactemail}', '{$phone}', '{$address}', '{$address_other}', '{$city}', '{$state}', '{$postalcode}');";

            $data['sql'] = $sql;
            $result = $this->mysqli->query($sql);
            $customer_id = $this->mysqli->insert_id;

            /* Insert into product_order table */
            $promocode = strtoupper($promocode);

            // if( $ship_UPS_value == '30' ) {
            //     $shipping = 30;
            //     $shipping_provider = 'UPS';
            // } else {
            //     $shipping = null;
            //     $shipping_provider = 'USPS';
            // }

            //  $sql_po = "
            //    INSERT INTO `" . $this->config_env->env[$this->env]['dbname']  . ".`product_order` 
            //    (`product_customer_id`, `item`, `notes`, `quantity`, `price`, `tax`, `shipping`, `discount`, `invoice_number`) 
            //    VALUES 
            //    ('{$customer_id}', '{$item_pack}', '{$comments}', '1', '{$price}', '0', '0', '{$promocode}', '{$invoice_no}');";
            $sql_po = "
            INSERT INTO product_order
                (
                    `product_customer_id`, 
                    `product_id`, 
                    `item`, 
                    `notes`, 
                    `quantity`, 
                    `price`, 
                    `tax`, 
                    `shipping`, 
                    `shipping_provider`, 
                    `promo`, 
                    `promo_amount`, 
                    `invoice_number`,
                    `deposit`,
                    `invoiced`,
                    `sq_payment_id`,
                    `sq_last4`,
                    `sq_amount_money`,
                    `sq_status`,
                    `sq_order_id`,
                    `sq_receipt_number`,
                    `sq_receipt_url`
                ) 
                VALUES 
                (
                    '{$customer_id}',
                    '1',
                    '{$item_pack}', 
                    '{$comments}', 
                    '{$quantity}', 
                    '{$price}', 
                    '', 
                    '{$shipping_cost}', 
                    '{$shipping_provider}', 
                    '{$promocode}', 
                    '{$promo_amt}', 
                    '{$order_no}',
                    '{$deposit}',
                    '$invoiced',
                    '{$params->payment->id}',
                    '0000',
                    '{$params->payment->amount_money->amount}',
                    '{$params->payment->status}',
                    '{$params->payment->order_id}',
                    '{$params->payment->receipt_number}',
                    '{$params->payment->receipt_url}'
                );

            ";

            // {$params->payment->card_details->card->last_4}
            
            $data['sql_po'] = $sql_po;
            $result_po = $this->mysqli->query($sql_po);
            
            if ($result == TRUE && $result_po == TRUE) {
                $data['result'] = '200';
                 $this->log(array("key" => "api", "value" => "Order Processed for" . $contactname, "type" => "success"));
            } else {
                $data['error'] = "SQL UPDATE FAILED ";
                $data['sql'] = $sql;
                $this->log(array("key" => "api", "value" => "Failed To Process Order for " . $contactname, "type" => "failure"));
            }	
            
        } else {
            $this->console('NO-DB-CONNECTION');
        }

        return($data);
    }

public function api_Admin_Get_InventoryByOrderId($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

           /* Insert into product_customer table */
            $sql = "
            SELECT
            	art_id
            FROM
            	art
            WHERE
            	art.product_order_id = '" .$id . "'";

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

public function api_Admin_Get_CollectorByName($first,$last) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

           /* Insert into product_customer table */
            $sql = "
            SELECT
            	collector_id
            FROM
            	collector
            WHERE
            	collector.first_name = '" .$first . "' AND collector.last_name='" . $last . "'";

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

public function api_Admin_Get_Order_Customer($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

           /* Insert into product_customer table */
            $sql = "
            SELECT
            	pc.*
            FROM
            	product_customer AS pc
            WHERE
            	pc.product_customer_id = '" .$id . "'";

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

public function api_Admin_Get_Order($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

           /* Insert into product_customer table */
            $sql = "
            SELECT
            	pc.*,
            	po.*
            FROM
            	product_customer AS pc
            	INNER JOIN product_order AS po ON po.product_customer_id = pc.product_customer_id
            WHERE
            	po.product_order_id = '" .$id . "'";

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

 public function api_Admin_Update_Order() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        $timestamp = date ("Y-m-d H:i:s", time());

        /* Items Array */
        $item_pack = json_encode(array(
            "edition"=>$item_edition,
            "title"=>$item_title,
            "size"=>$item_size,
            "framing"=>$item_framing,
            "catalog_id"=>$item_catalog_id
        ));

        $sql_accepted = null;
        $sql_invoiced = null;
        $sql_printed = null;
        $sql_packaged = null;
        $sql_shipped = null;
        $sql_closed = null;

        /* Sort through workflow */
        if($order_accepted == "1") { 
            $sql_accepted = ", accepted = '" . $timestamp . "'"; 
            $to = $email;
			$subject = 'Order ' . $invoice_no . ' Received & Processing';
			$header_from = "FROM: jM Galleries " . $this->config->email . " <'" . $this->config->site_name . "'>";
			$reply_to = $this->config->email;
        	$headers =  $header_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n" . 'X-Mailer: PHP/' . phpversion() . '/jmGForm';
            $message = "Hello " . $name . ",\nThis is an automated message to let you know that your fine-art, " . strtoupper($item_title) . ", order has been received and is in the works. While your artwork is being created, you will be receiving periodic email updates from me, so please make sure these messages are not being flagged as spam/junk. If you have any questions please call or text me at 951-708-1831 or email at james@jmgalleries.com \n\nThank you for supporting the Arts!\n\n--j.McCarthy\n\n";
        	mail($to, $subject, $message, $headers);
            $close_count++;
        }

        if($order_invoiced == "1") { 
            $sql_invoiced = ", invoiced = '" . $timestamp . "'"; 
            $to = $email;
			$subject = 'Order ' . $invoice_no . ' Invoice Sent';
			$header_from = "FROM: jM Galleries " . $this->config->email . " <'" . $this->config->site_name . "'>";
			$reply_to = $this->config->email;
        	$headers =  $header_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n" . 'X-Mailer: PHP/' . phpversion() . '/jmGForm';
            $message = "Hello " . $name . ",\nThis is an automated message to let you know that your fine-art, " . strtoupper($item_title) . ", has been invoiced through our payment processor Square. If you haven't received an email from Square please check your junk/spam box. If you see an error in the invoice please contact me at 951-708-1831 or email at james@jmgalleries.com.\n\nThank you for supporting the Arts!\n\n--j.McCarthy\n\n";
        	mail($to, $subject, $message, $headers);
            $close_count++; 
        }

        if($order_printed == "1") { 
            $sql_printed = ", printed = '" . $timestamp . "'"; 
            $to = $email;
			$subject = 'Order ' . $invoice_no . ' Printing Complete';
			$header_from = "FROM: jM Galleries " . $this->config->email . " <'" . $this->config->site_name . "'>";
			$reply_to = $this->config->email;
        	$headers =  $header_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n" . 'X-Mailer: PHP/' . phpversion() . '/jmGForm';
            $message = "Hello " . $name . ",\nThis is an automated message to let you know that your fine-art, " . strtoupper($item_title) . ", has been printed and is getting prepped from any other work necessary before shipping. Once the product has shipped you will be receiving another message with tracking information.\n\nThank you for supporting the Arts!\n\n--j.McCarthy\n\n";
        	mail($to, $subject, $message, $headers);
            $close_count++; 
        }

        if($order_packaged == "1") { 
            $sql_packaged = ", packaged = '" . $timestamp . "'"; 
            $close_count++; 
        }

        if($order_shipped == "1") { 
            $sql_shipped = ", shipped = '" . $timestamp . "'"; 
            $sql_printed = ", printed = '" . $timestamp . "'"; 
            $to = $email;
			$subject = 'Order ' . $invoice_no . ' Has Shipped';
			$header_from = "FROM: jM Galleries " . $this->config->email . " <'" . $this->config->site_name . "'>";
			$reply_to = $this->config->email;
        	$headers =  $header_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n" . 'X-Mailer: PHP/' . phpversion() . '/jmGForm';
            $message = "Hello " . $name . ",\nThis is an automated message to let you know that your fine-art, " . strtoupper($item_title) . ", has been shipped via UPS. The tracking number is:\n\n" . $tracking . "\nhttps://www.ups.com/track?loc=en_US&tracknum=" . $tracking . "\n\nPlease allow 24 hours for tracking information to intially update with the carrier.\n\nThank you for supporting the Arts!\n\n--j.McCarthy\n\n";
        	mail($to, $subject, $message, $headers);
            $close_count++; 
        }

        if( !isSet($_POST['added_newsletter']) ) { $added_newsletter = 0; }

        if($close_count == 5) { $closed = $sql_closed = ", closed ='1'"; }

        /* Update product_customer */
        $sql = "
        UPDATE `" . $this->config_env->env[$this->env]['dbname']  . ".`product_customer` SET 
            name = '{$name}',
            email = '{$email}',
            phone = '{$phone}',
            address = '{$address}',
            address_other = '{$address_other}',
            city = '{$city}',
            state = '{$state}',
            postal_code = '{$postal_code}',
            added_newsletter = '{$added_newsletter}'
            WHERE product_customer_id = '{$product_customer_id}'
        ";

        $result = $this->mysqli->query($sql);

        /* Update product_order */
        $discount = strtoupper($discount);
        $sql_o = "
        UPDATE `" . $this->config_env->env[$this->env]['dbname']  . ".`product_order` SET 
            item = '{$item_pack}', 
            quantity = '{$quantity}',
            price = '{$price}', 
            tax = '{$tax}', 
            shipping = '{$shipping}',
            discount = '{$discount}', 
            tracking_number = '{$tracking}' " . $sql_accepted . $sql_invoiced . $sql_printed . $sql_packaged . $sql_shipped . $sql_closed .
            "WHERE product_order_id = '{$order_id}'
        ";
        
        $result_o = $this->mysqli->query($sql_o);
        
        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $name;
            $_SESSION['notification_msg'] = "<p class='heading'>success</p><p> Order Has Been Updated</p>";
            $this->log(array("key" => "api", "value" => "Updated Order (id:" . $order_id . ") for " . $name, "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "api", "value" => "Failed To Update Order (id:" . $order_id . ") for " . $name, "type" => "failure"));
        }
        
    }

    public function api_Admin_Get_Reports_Sql($sql) {

    /* Executes SQL and then assigns object to passed var */
    if( $this->checkDBConnection(__FUNCTION__) == true) {

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

    public function api_Admin_Get_Apps() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                user_apps_id,
                user_role_id,
                title,
                short_code
            FROM
                user_apps
            WHERE
                status='1'
                ORDER BY title ASC";
        
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

    public function api_Admin_Get_Roles() {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                user_role_id,
                role
            FROM
                user_role
            WHERE status = '1'";
        
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

    public function api_Admin_Get_RolesByUser($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                user_id,
                user_role_id
            FROM
                user_role_link
            WHERE user_id = '" . $id . "'";

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

    public function api_Admin_Get_AppsByUser($id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                user_id,
                user_apps_id
            FROM
                user_apps_link
            WHERE user_id = '" . $id . "'";

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

public function api_Admin_Get_Products() {
    
            /* Executes SQL and then assigns object to passed var */
            if( $this->checkDBConnection(__FUNCTION__) == true) {
    
                $sql = "SELECT
                    product_id, 
                    title,
                    price,
                    quantity,
                    in_stock,
                    on_sale,
                    status
                FROM
                    product";
            
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


public function api_Admin_Insert_Products() {

        if(isSet($_POST['date'])) { $mysql_ts = $_POST['date']; } else { $mysql_ts = date('Y-m-d H:i:s'); }

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        
        /* Insert into database */
        $title = $this->mysqli->real_escape_string($_POST['title']);
        $desc_short = $this->mysqli->real_escape_string($_POST['desc_short']);
        $details = $this->mysqli->real_escape_string($_POST['details']);
        
        /* Check to see if files have been uploaded */
        $image_files_mutated = $this->api_Admin_Products_Upload_Images(array("jpg","jpeg"), "jpg");
        $image_files_mutated = json_encode($image_files_mutated);
        
        if($on_sale == '') {
          $on_sale = 0;
        }
        
         $sql = "
            INSERT INTO product (
                `artist_id`, 
                `art_id`, 
                `title`, 
                `desc`,
                `desc_short`,
                `details`,
                `tags`,
                `image`, 
                `price`,
                `taxable`,
                `created`,
                `on_sale`,
                `in_stock`,
                `quantity`,
                `ship_tier`,
                `type`,
                `uri_path`,
                `status`
            ) 
            VALUES (
                '$artist_id', 
                '$art_id', 
                '$title',
                '$desc', 
                '$desc_short',
                '$details',
                '$tags',
                '$image_files_mutated', 
                '$price',
                '$taxable',
                '$created',
                '$on_sale',
                '$in_stock',
                '$quantity',
                '$ship_tier',
                'single',
                '$uri_path',
                '$status'
                );";

        $result = $this->mysqli->query($sql);
        $products_id = $this->mysqli->insert_id;

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "api_Admin_Insert_Products", "value" => "INSERT Product " . $_POST['title'] . " (" . $_POST['products_id'] . ") ", "type" => "success"));
        } else {
            $_SESSION['error'] = '501';
            $_SESSION['notify_msg'] = "SOMETHING WENT WRONG, e_501 " . __LINE__;
            $this->log(array("key" => "api_Admin_Insert_Products", "value" => "Failed INSERT Product " . $_POST['title'] . " (" . $_POST['products_id'] . ") " . $sql, "type" => "failure"));
        }

}

public function api_Admin_Products_Upload_Images($fileTypes=array("jpeg"), $ext="jpg") {

    $uploadReady=0;
        foreach($_FILES as $key => $value) {

            $_FILES[$key]['path'] = '/view/image/product/';
            
            if($key == "file_6") { $key_fn = "thumb"; } else { $key_fn = $key; }
            
            if($value['size'] != 0) {
                // $_FILES[$key]['path'] = $_POST[$key . '_path'];
                $uploadReady=1;
                // $this->console($value);
            } else { $uploadReady=0; }

            // if($_FILES[$key]['path'] == "/catalog/__thumbnail/") { $log_loc = 'Thumbnail'; } else { $log_loc = 'Main'; }
            $target_file = $_SERVER["DOCUMENT_ROOT"] . $_FILES[$key]['path'] . $_POST['uri_path'] . '_' . $key_fn . '.' . $ext;
            
            
            if(file_exists( $target_file )) {
                $_FILES[$key]['name'] = $_POST['uri_path'] . '_' . $key_fn . '.' . $ext;
                $uploadReady = 1;

                // need to throw an overwrite flag only if $_FILES[$key]['name']
                if( isSet($_FILES[$key]['name'])) {
                    $uploadOverwrite = 1;
                } 

            } else { $uploadReady=1; $uploadOverwrite = 0; unset($_FILES[$key]['path']); }

            // Check if $uploadReady is set to 0 by an error
            if($value['size'] != '0') {

                if ($uploadReady == 0) {
                    $this->log(array("key" => "api_Admin_Products_Upload_Images", "value" => "Failed to Upload / uploadReady=0", "type" => "failure"));
                } else {
                    
                    // $this->console($target_file);

                    if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
                        if ($uploadOverwrite == 0) {
                            $this->log(array("key" => "api_Admin_Products_Upload_Images", "value" => "Upload of " . $log_loc . " Image File (" . $_POST['uri_path'] . '_' . $key . '.' . $ext . ")", "type" => "success"));
                        } else {
                            $this->log(array("key" => "api_Admin_Products_Upload_Images", "value" => "Overwriting " . $log_loc . " Photo (" . $_POST['uri_path'] . '_' . $key . '.' . $ext . ")", "type" => "warning"));
                        }
                    } else {
                        // $this->log(array("key" => "system", "value" => "move_uploaded_file() FAILURE on line " . __LINE__, "type" => "failure"));
                    }
                }
            }
          
        unset($_FILES[$key]['tmp_name']);
        unset($_FILES[$key]['error']);
        }
        
        return($_FILES);
}

 public function api_Admin_Get_Products_Item($id) {

          $sql = "SELECT
                     *
                  FROM
                      product
                  WHERE product_id = '" . $id . "'";

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


} /* End Class Core_Api */
?>