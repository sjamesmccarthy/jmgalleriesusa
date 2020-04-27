<?php

class Core_Site extends Core_Api
{

    public $config; 
    public $routes;
    public $session_started;
    public $data;
    public $page;
    public $errors;

    public function __construct() {

        date_default_timezone_set('America/Los_Angeles');

        /* Import the config file */
        $this->getJSON('config.json','config');

        /* Import the auth_config file */
        $this->getJSON('config_env.json','config_env');

        /* Get and Set the environment: local or prod */
        $this->getEnv();

        /* Import the routing paths */
        $this->getJSON('routes.json','routes');

        /* Initialize the Session */
        $this->initSession('jmGalleriesPublicSession');

        /* Start the database */
        $this->startDB();

        /* Check URI against routes json file */
        $this->getRoute();

    }
    
    public function getEnv() {

        /* Check for enviroment in URI based on domain extension */
        $uri = explode('.', $_SERVER['SERVER_NAME']);


        if(!isSet($uri[1]) || $uri[1] == 'local') { $this->env = 'local'; } else { $this->env = "prod"; }
        
        /* Error reporting levels being outputted to screen and logged */
        error_reporting($this->config_env->env[$this->env]['error_reporting']);

    }

    public function initSession($name='defaultSession') {

        $session_expires = $this->config->session['expires_1w'];

        /* Starting the session and setting the lifetime to 1 day */
        session_start([
            'cookie_lifetime' => $session_expires
        ]);   

        $this->session_started = array(session_id(), $_SESSION);
    
    }
    
    public function checkSession() {

        if( !isset($_SESSION['uid']) ) {
            $_SESSION['error'] = 'timeout';
            return false;
        } else {
            return true;
        }

    }

    public function getRoute() {
        
        /* Parse the URI */
        $this->routes->URI = (object) parse_url($_SERVER['REQUEST_URI']);
        $this->routes->URI->url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $this->routes->URI->useragent = $_SERVER['HTTP_USER_AGENT'];
        
            /* Check for root level or trim slashes */
            if($this->routes->URI->path != '/') {
                $this->routes->URI->path = rtrim($this->routes->URI->path, '/');
            }

            /* Match the [path] of URI to the routes.json */
            if(property_exists($this->routes, $this->routes->URI->path) == true)
            {
                /* Direct route match URI === route path */
                $this->routes->URI->match = 'true';
                $this->page->title = $this->routes->{$this->routes->URI->path}['title'];
                $this->page->catalog_path = $this->routes->URI->path;
                $this->routes->URI->template = $this->routes->{$this->routes->URI->path}['template'];
                $this->routes->URI->page = $this->routes->{$this->routes->URI->path}['page'];

                /* Check if Template type is redirect */
                if( $this->routes->{$this->routes->URI->path}['template'] == "redirect" ) {
                    header('location:' . $this->routes->{$this->routes->URI->path}['page']);
                }

                /* Check if Template type is script */
                if( $this->routes->{$this->routes->URI->path}['template'] == "script" ) {
                    // header('location:' . $this->routes->{$this->routes->URI->path}['page']);
                    
                    if(file_exists( $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->routes->{$this->routes->URI->path}['page'] )) {
                        include_once($_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->routes->{$this->routes->URI->path}['page']);
                    } else {
                        $this->errors['script'] = 'Script Not Found : ' . __FILE__ . ' : ' . __FUNCTION__ . ' : ' . __LINE__ . ' : ' . $this->routes->{$this->routes->URI->path}['page']; 
                    }
                }
                
            } else if (preg_match_all("/^\/[^\/]+\/[^\/]+\/$/m", $this->routes->URI->path . '/') == true) {

                /* splitting the URI path by forward slash */
                $URIx = explode('/', $this->routes->URI->path);

                /* Mutating the routes URI so the regEx can be found in the routes JSON object */
                $this->routes->URI->path = "[$1]/[$2]";
                $this->routes->URI->template = $this->routes->{'[$1]/[$2]'}['template'];
                $this->routes->URI->page = $this->routes->{'[$1]/[$2]'}['page'];
            
                /* Adding data to the page index of the data object that is accessible in the templates and pages */
                $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
                $this->page->catalog_path = '/' . $URIx[1];
                // $this->page->photo = $URIx[2];
                $this->page->photo_path = $URIx[2];
            
            } else {

                 /* splitting the URI path by forward slash */
                $URIx = explode('/', $this->routes->URI->path);

                /* Error 404, page URI not found. Simply rewrite the URI as /404 */
                $this->routes->URI->path = "/404";
                $this->page->title = $this->routes->{$this->routes->URI->path}['title'];
                $this->routes->URI->requested_path = $URIx;

                /* Log error */
                
            }

            /* Parse query string */
            if(isSet($this->routes->URI->query))
            {
                // $this->printp_r($this->routes->URI->query);
                $this->data->routePathQuery = explode('&', $this->routes->URI->query);
                // $this->printp_r($this->data->routePathQuery);
                $this->routes->URI->queryvals = explode('=', $this->routes->URI->query);


            } else {
                $this->routes->URI->query = 'false';
            }

        /* Assign other vital vars needed to load teplate and page templates */
        if(isSet( $this->routes->{$this->routes->URI->path}['header'] )) { $this->page->header = $this->routes->{$this->routes->URI->path}['header']; }
        if(isSet( $this->routes->{$this->routes->URI->path}['controller'] )) { $this->routes->URI->controllerFile = $this->routes->{$this->routes->URI->path}['controller']; }
        if( $this->routes->{$this->routes->URI->path}['component'] == "true") { $this->routes->URI->component= $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix['page'] . $this->routes->{$this->routes->URI->path}['page'] . ".inc.php"; }
        $this->routes->URI->template = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix['template'] . $this->routes->{$this->routes->URI->path}['template'] . ".php";
        $this->routes->URI->view = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix['page'] . $this->routes->{$this->routes->URI->path}['page'] . ".php";
    }

    public function render() {

        /* Assign variables to be used in page content */
        foreach($this->page as $k => $v) {
            $this->$k = $v;
        }

        /* start buffering the page */
        ob_start();

        /* include the template page specifed in the routes config if the template file is not valid then push to Route 404 */
        if(file_exists($this->routes->URI->template)) {
            include($this->routes->URI->template);
        } else { 
            $this->errors['component'] = 'Template Not Found : ' . __FILE__ . ' : ' . __FUNCTION__ . ' : ' . __LINE__ . ' : ' . $this->routes->URI->template; 
        }

        /* Flush the output buffer */
        ob_flush();

        /* Get the template and page data from the buffer */
        $buffer= ob_get_contents();

        /* Output the buffer contents to screen */
        print $buffer;

        /* Flush and dump the buffer */
        ob_get_clean();
    }

    public function view($view=null) {


        /* include the template page specifed in the routes config */
        if(file_exists($this->routes->URI->view)) {
            
            /* Check to see if a component file for this view is enabled and then if exists */
            if($this->routes->{$this->routes->URI->path}['component'] == "true") {
                if(file_exists($this->routes->URI->component)) { include($this->routes->URI->component); }
                else { 
                    $this->errors['component'] = 'Component Not Found : ' . __FILE__ . ' : ' . __FUNCTION__ . ' : ' . __LINE__ . ' : ' . $this->routes->URI->component; 
                }
            } 
            
            /* Assign variables to be used in page content */
            foreach($this->page as $k => $v) {
                $this->$k = $v;
            }

            /* This file needs to load after the .inc file so inherits any data attributes */
            include($this->routes->URI->view);
        } else { 
            echo "<p>Roses are red, violets are blue, we are oh-so sorry we can not find your view.</p><p>This has been reported to the poet.</p>";
            $this->errors['component'] = 'View Not Found : ' . __FILE__ . ' : ' . __FUNCTION__ . ' : ' . __LINE__ . ' : ' . $this->routes->URI->view; 

        }
    }

    public function printp_r($value) {

        /* Makes a print_r dump a little easier on the brain */
        echo "<pre style='text-align: left'>"; print_r($value); echo "</pre>";
    }

    public function debugInfo() {

        if( $this->routes->URI->query == "debug=false" ) {
            /* Only used for override of default state if set to true */
             echo "<div style='padding: 40px; background-color: rgba(255, 249, 222, 1);'><p>DEBUG --forced-false</p></div>";

        } else {
            /* Outputs some objects and arrays for debugging */
            if($this->config_env->env[$this->env]['debug'] == "true" || $this->routes->URI->query == "debug=true") {
            echo "<div style='position: relative; padding: 40px; background-color: rgba(255, 249, 222, 1);'><p>DEBUG --config-true</p>";
            echo "<hr />";
            $this->printp_r($this);
            // echo "<hr />";
            // print phpinfo();
            echo "</div>";
            }
        }
    }

    public function getJSON($file, $output_var) {

        /* Loads JSON filer and then assigns object to passed var */
        $dataJSON = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/"  . $file);
        $data = json_decode($dataJSON, true);
        $this->$output_var = (object) $data;

        return( $data );
    }

    public function component($component, $props=null) {

        $file = $_SERVER['DOCUMENT_ROOT'] . '/view/component_' . $component;

        if( file_exists($file . ".php") ) {
            $result = include_once($file . ".php");
        }

        return($result);
    }

    public function getPartial($partial) {

        /* Check to see if the partial file has an Include Component with it */
        $file = $_SERVER['DOCUMENT_ROOT'] . '/view/partial_' . $partial;
        
        if( file_exists($file . ".inc.php") ) {
            include_once($file . ".inc.php");
        } 

        /* Include the partial file if exists */
        if( file_exists($file . '.php')) {
            include_once($file . '.php');
        } 
    }

    public function log($log_data) {

        /* extract Data Array */
        extract($log_data, EXTR_PREFIX_SAME, "dup");
        
        /* Insert into database table: log 
        /* Executes SQL and then assigns object to passed var */

            $sql = "INSERT INTO log (`user_id`, `key`, `value`, `type`) VALUES ('" . $_SESSION['uid'] . "','" . $key . "','" . $value . "','" . $type . "');";
            $result = $this->mysqli->query($sql);

            if ($result == TRUE) {
                $data['result'] = '200';
            } else {
                $data['result'] = '400';
            }	

        return($data);

    }

    public function uploadFile($fileTypes=array("jpeg"), $ext="jpg") {

        $uploadReady=0;

        if( !$_POST['file_1_hidden'] || isSet($_FILES['file_1']['name']) ) {

            foreach($_FILES as $key => $value) {
                
                if($value['size'] != 0) {
                    $_FILES[$key]['path'] = $_POST[$key . '_path'];
                    $uploadReady=1;
                } else { $uploadReady=0; }

                if($_FILES[$key]['path'] == "/catalog/__thumbnail/") { $log_loc = 'Thumbnail'; } else { $log_loc = 'Main'; }
                $target_file = $_SERVER["DOCUMENT_ROOT"] . $_FILES[$key]['path'] . $_POST['file_name'] . '.' . $ext;

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
                    $this->log(array("key" => "core", "value" => "Failed to Upload / uploadReady=0", "type" => "failure"));
                } else {

                    if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
                        if ($uploadOverwrite == 0) {
                            $this->log(array("key" => "core", "value" => "Upload of " . $log_loc . " Image File (" . $_POST['file_name'] . '.' . $ext . ")", "type" => "success"));
                        } else {
                            $this->log(array("key" => "core", "value" => "Overwriting " . $log_loc . " Photo (" . $_POST['file_name'] . '.' . $ext . ")", "type" => "warning"));
                        }
                    } else {
                        // $this->log(array("key" => "system", "value" => "move_uploaded_file() FAILURE on line " . __LINE__, "type" => "failure"));
                    }
                }

            }
        } else {
            $this->log(array("key" => "core", "value" => "uploadFile() SCRIPT FAILURE", "type" => "failure"));
        }

    }
}
?>