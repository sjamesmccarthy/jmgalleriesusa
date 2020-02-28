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
                -- created < Now() AND 
                created > DATE_ADD(Now(), INTERVAL - " . $duration . " MONTH)
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
            P.status,
            C.path,
            PV.count as views
        FROM
            catalog_photo AS P
            INNER JOIN catalog_category AS C ON P.catalog_category_id = C.catalog_category_id
            RIGHT JOIN catalog_photo_views AS PV ON P.catalog_photo_id = PV.catalog_photo_id";
        
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
                L.location,
                A.value AS TOTAL_VALUE
            FROM
                art as A
                INNER JOIN art_locations as L on A.art_location_id = L.art_location_id";
        
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
                -- C.collector_id,
                -- C.acquired_from,
                -- C.purchase_date
            FROM
                art AS A
                -- left outer join certificate as C on A.art_id = C.art_id
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
                CERT.purchase_date
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
                S.supplier_id,
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
                    ELSE (SM.cost/SM.quantity)
                END) AS calcd_cost
            FROM
                art AS A
                INNER JOIN art_costs_supplier AS ACS ON A.art_id = ACS.art_id
                RIGHT OUTER JOIN supplier_materials AS SM ON ACS.supplier_materials_id = SM.supplier_materials_id
                LEFT OUTER JOIN supplier AS S ON SM.supplier_id = S.supplier_id
                WHERE S.supplier_id NOT IN (0)
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

    public function api_Admin_Get_Locations($all=null) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            if( $all = '' ) { $addToSQL = " AND type = 'PUBLIC'"; }

            $sql = "select art_location_id, location, type from art_locations WHERE status = 'ACTIVE'" . $addToSQL;
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

    public function api_Admin_Get_Locations_History($art_id) {

        /* Executes SQL and then assigns object to passed var */
        if( $this->checkDBConnection(__FUNCTION__) == true) {

            $sql = "SELECT
                ALH.*,
                AL.location,
                A.art_id,
                A.title
                -- CERT.collector_id,
                -- COL.last_name
            FROM
                art_locations_history AS ALH
                INNER JOIN art AS A ON A.art_id = ALH.art_id
                INNER JOIN art_locations AS AL ON ALH.art_location_id = AL.art_location_id
                -- RIGHT JOIN certificate AS CERT ON CERT.art_id = ALH.art_id
                -- RIGHT JOIN collector AS COL ON COL.collector_id = CERT.collector_id
            WHERE
                ALH.art_id='" . $art_id . "' ORDER BY ALH.date_started";
    
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

    public function api_Admin_Update_Catalog() {

        /* extract Data Array */
        // $_POST = $this->mysqli->real_escape_string($_POST);
        extract($_POST, EXTR_PREFIX_SAME, "dup");

        /* Insert into database */
        $story = $this->mysqli->real_escape_string($_POST['story']);

        $sql = "UPDATE catalog_photo 
        SET 
        -- catalog_photo_id,
        -- artist_id,
        catalog_category_id = '$catalog_category_id',
        title = '$title',
        -- desc = $desc,
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
        -- available_sizes = $available_sizes,
        print_media = '$print_media',
        tags = '$tags',
        created = '$created',
        status = '$status',
        on_display = '$on_display',
        in_shop = '$in_shop',
        as_tinyview = '$as_tinyview',
        as_gallery = '$as_gallery',
        as_studio = '$as_studio',
        as_open = '$as_open'
        WHERE catalog_photo_id = '$catalog_photo_id' AND file_name = '$file_name'";

        $result = $this->mysqli->query($sql);

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "admin", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") Successsfully", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "admin", "value" => "Failed Update Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ")", "type" => "success"));
        }

        /* Check to see if files have been uploaded */
        $this->uploadFile(array("jpg","jpeg"), "jpg");
    }

    public function api_Admin_Insert_Catalog() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        
        /* Insert into database */
        $story = $this->mysqli->real_escape_string($_POST['story']);
        $title = $this->mysqli->real_escape_string($_POST['title']);

        $sql = "
        INSERT INTO `catalog_photo` (
        `catalog_photo_id`, 
        `artist_id`, 
        `catalog_category_id`, 
        `title`, 
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
        `print_media`, 
        `tags`, 
        `created`, 
        `status`, 
        `on_display`, 
        `in_shop`, 
        `as_tinyview`, 
        `as_gallery`, 
        `as_studio`, 
        `as_open`
        ) VALUES ( 
            DEFAULT, 
            '$artist_id', 
            '$catalog_category_id', 
            '$title', 
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
            '$print_media', 
            '$tags', 
            '$created', 
            '$status', 
            '$on_display', 
            '$in_shop', 
            '$as_tinyview', 
            '$as_gallery', 
            '$as_studio', 
            '$as_open'
            )";

        $result = $this->mysqli->query($sql);

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "admin", "value" => "New Photo Added (" . $_POST['title'] . " to catalog id: " . $_POST['catalog_category_id'] . ") Successsfully", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "admin", "value" => "Failed Insert of Catalog Photo (" . $_POST['title'] . ")", "type" => "failure"));
        }

        /* Check to see if files have been uploaded */
        $this->uploadFile(array("jpg","jpeg"), "jpg");

    }

    public function api_Admin_Update_Inventory_Location() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        $date = date("Y-m-d H:i:s");

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
                $this->log(array("key" => "admin", "value" => "Location Change for Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ") Successsfully", "type" => "success"));
            } else {
                $this->log(array("key" => "admin", "value" => "Failed Location Change for Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ")", "type" => "failure"));
            }
        } 

    }
   
    public function api_Admin_Update_Inventory_Collector() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        $acquired_from = $this->mysqli->real_escape_string($_POST['acquired_from']);
        $date = date("Y-m-d H:i:s");

        // $this->printp_r($_POST);
        /* If state_ is set than update certificate record */
        if(isSet($state_collector_id) && $state_collector_id == $collector) {

            $sql_u = "
            UPDATE `certificate` 
            SET
                `serial_num`='$serial_num',
                `artwork_reg`='$reg_num',
                `acquired_from`='$acquired_from',
                `purchase_date`='$acquired_date'
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
                `purchase_date`
            ) VALUES ( 
                DEFAULT, 
                '$art_id', 
                '$collector',
                '$serial_num',
                '$reg_num',
                '$acquired_from',
                '$acquired_date'
            )";

            // print "<hr />$sql";

            $result = $this->mysqli->query($sql);

            if($result == 1) {
                $this->log(array("key" => "admin", "value" => "Location Change for Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ") Successsfully", "type" => "success"));
            } else {
                $this->log(array("key" => "admin", "value" => "Failed Location Change for Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ")", "type" => "failure"));
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

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "admin", "value" => "Updated Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ") Successsfully", "type" => "success"));
        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "admin", "value" => "Failed Update Inventory Art (" . $_POST['art_id'] . "+" . $_POST['title'] . ")", "type" => "failure"));
        }

        // $this->printp_r($_POST);
        
    }
    
    public function api_Admin_Insert_Inventory() {

        /* extract Data Array */
        extract($_POST, EXTR_PREFIX_SAME, "dup");
        
        /* Insert into database */
        $title = $this->mysqli->real_escape_string($_POST['title']);
        $frame_desc = $this->mysqli->real_escape_string($_POST['frame_desc']);
        $notes = $this->mysqli->real_escape_string($_POST['notes']);
        if(empty($_POST['value'])) { $value = '0.00'; }
        if(empty($_POST['listed'])) { $listed = '0.00'; }

        $sql = "
        INSERT INTO `art` (
        `art_id`, 
        `artist_id`, 
        `art_location_id`, 
        `serial_num`,
        `reg_num`, 
        `title`, 
        `negative_file`, 
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
        `value`
        ) VALUES ( 
            DEFAULT, 
            '$artist_id', 
            '$art_location',
            '$serial_num', 
            '$reg_num',
            '$title', 
            '$negative_file',
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
            '$value'
            )";

        $result = $this->mysqli->query($sql);
        $_POST['art_id'] = $this->mysqli->insert_id;

        if($result == 1) {
            $_SESSION['error'] = '200';
            $_SESSION['notify_msg'] = $_POST['title'];
            $this->log(array("key" => "admin", "value" => "New Inventory Added (" . $_POST['title'] . ") Successsfully", "type" => "success"));

        } else {
            $_SESSION['error'] = '400';
            $this->log(array("key" => "admin", "value" => "Failed Insert of Inventory Art (" . $_POST['title'] . ")", "type" => "failure"));
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
                // $this->log(array("key" => "admin", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") Successsfully", "type" => "success"));
            } else {
                $data['result'] = '501';
                $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                $data['sql'] = $sql;
                $this->log(array("key" => "admin", "value" => "Failed DELETE Expenses from art_costs_supplier (" . $sql . ")", "type" => "failure"));
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
                                // $this->log(array("key" => "admin", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") Successsfully", "type" => "success"));
                            } else {
                                $data['result'] = '501';
                                $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                                $data['sql'] = $sql;
                                $this->log(array("key" => "admin", "value" => "Failed Insert of Manual Expense With {$exp_id} Into Linking Table (" . $sql . ")", "type" => "failure"));
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

                // print $sql;

                $result = $this->mysqli->query($sql);

                if ($result == TRUE) {
                    $data['result'] = '200';
                    // $this->log(array("key" => "admin", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") Successsfully", "type" => "success"));
                } else {
                    $data['result'] = '501';
                    $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                    $data['sql'] = $sql;
                    $this->log(array("key" => "admin", "value" => "Failed Supplier-Material Expsense Insert Into Linking Table (" . $sql . ")", "type" => "failure"));
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
                                // $this->log(array("key" => "admin", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") Successsfully", "type" => "success"));
                            } else {
                                $data['result'] = '501';
                                $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                                $data['sql'] = $sql_me;
                                $this->log(array("key" => "admin", "value" => "Failed Manual Entry Insert Into Linking Table (" . $sql_me . ")", "type" => "failure"));
                            }		
                            
                        }
                    // }

                    // $this->printp_r($data['result']);
                    // echo "<hr />";
                }

                // print $sql . "<br />";

                if ($result == TRUE) {
                    $data['result'] = '200';
                    // $this->log(array("key" => "admin", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") Successsfully", "type" => "success"));
                } else {
                    $data['result'] = '501';
                    $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                    $data['sql'] = $sql;
                    $this->log(array("key" => "admin", "value" => "Failed INSERT/UPDATE Supplier Material (" . $sql . ")", "type" => "failure"));
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

                // print $sql;

                $result = $this->mysqli->query($sql);

                if ($result == TRUE) {
                    $data['result'] = '200';
                    // $this->log(array("key" => "admin", "value" => "Updated Catalog Photo (" . $_POST['catalog_photo_id'] . "+" . $_POST['file_name'] . ") Successsfully", "type" => "success"));
                } else {
                    $data['result'] = '501';
                    $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
                    $data['sql'] = $sql;
                    $this->log(array("key" => "admin", "value" => "Failed archving Expense Item (" . $exp . ")", "type" => "failure"));
                }	
                
            }
        }

        if ($result == TRUE) {
            $data['result'] = '200';
            $this->log(array("key" => "admin", "value" => "Updated Expenses Successsfully", "type" => "success"));
        } else {
            $data['result'] = '501';
            $data['error'] = "SQL DELETE" . $tbl . " FAILED " . $art_id;
            $data['sql'] = $sql;
            $this->log(array("key" => "admin", "value" => "Failed Update To Expenses FATAL " . __FUNCTION__, "type" => "failure"));
        }	

    }

}
?>