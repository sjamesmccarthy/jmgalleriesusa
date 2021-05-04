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
        $this->initSession();

        /* Start the database */
        $this->startDB();

        /* Check URI against routes json file */
        $this->getRoute();

    }
    
    public function getEnv() {

        /* Check for environment in URI based on domain extension */
        $uri = explode('.', $_SERVER['SERVER_NAME']);

        if(!isSet($uri[1]) || $uri[1] == 'local') { $this->env = 'local'; } else { $this->env = "prod"; }
        
        /* Error reporting levels being outputted to screen and logged */
        error_reporting($this->config_env->env[$this->env]['error_reporting']);

    }

    public function initSession() {

        if (!isset($_SESSION['uid'])) {
            
            $route_check = explode("/", $_SERVER[REQUEST_URI]);
            
            if($route_check[1] == 'studio') {
                $sess_type = 'ADMIN';
                $lifetime = $this->config->session_cookie_lifetime; /* 1 Day = 86400 */
                session_set_cookie_params($lifetime,'/studio');
            } else {
                $sess_type = 'USER';
                $lifetime = $this->config->session_cookie_lifetime; /* until browser is closed */
                session_set_cookie_params($lifetime,'/');
            }
        
            session_save_path($this->config_env->env[$this->env]['session_save_path']);
            session_start();
            session_gc();

            $this->system->ip = $_SERVER['REMOTE_ADDR'];
            $_SESSION['__SYSTEM']['USERAGENT'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['__SYSTEM']['SESS_TYPE'] = $sess_type;
        } else {
            $this->console($_SESSION,1);
        }
    
    }
    
    public function checkSession() {

        if( !isset($_SESSION['uid']) ) {
            $_SESSION['error'] = 'timeout';
            // $this->console($_SESSION,1);
            return false;
        } else {
            return true;
        }

    }

    public function getRoute() {
        
        $pass_error_page = false;

        /* Parse the URI */
        $this->routes->URI = (object) parse_url($_SERVER['REQUEST_URI']);
        $this->routes->URI->url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $this->routes->URI->useragent = $_SERVER['HTTP_USER_AGENT'];
        
            /* Check for root level or trim slashes */
            if($this->routes->URI->path != '/') {
                $this->routes->URI->path = rtrim($this->routes->URI->path, '/');
            }

            /* Match the [path] of URI to the routes.json */
            if (property_exists($this->routes, $this->routes->URI->path) == true) {
                /* Direct route match URI === route path */
                $this->routes->URI->match = 'true';
                $this->page->title = $this->routes->{$this->routes->URI->path}['title'];
                $this->page->catalog_path = $this->routes->URI->path;
                $this->routes->URI->template = $this->routes->{$this->routes->URI->path}['template'];
                $this->routes->URI->page = $this->routes->{$this->routes->URI->path}['page'];

                /* Check if Template type is redirect */
                if ($this->routes->{$this->routes->URI->path}['template'] == "redirect") {
                    header('location:' . $this->routes->{$this->routes->URI->path}['page']);
                }

                /* Check if Template type is script */
                if ($this->routes->{$this->routes->URI->path}['template'] == "script") {
                    // header('location:' . $this->routes->{$this->routes->URI->path}['page']);
                    
                    if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->routes->{$this->routes->URI->path}['page'])) {
                        include_once($_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->routes->{$this->routes->URI->path}['page']);
                    } else {
                        $this->errors['script'] = 'Script Not Found : ' . __FILE__ . ' : ' . __FUNCTION__ . ' : ' . __LINE__ . ' : ' . $this->routes->{$this->routes->URI->path}['page'];
                    }
                }
            
            /* Add else if which checks for 1 wildcard string and then checks database for that collection */
            /* Problem: this could catch single path URIs and send 404 */
            } else if (preg_match_all("/^\/[^\/]+\/$/m", $this->routes->URI->path . '/') == true) {
                
                /* splitting the URI path by forward slash */
                $URIx = explode('/', $this->routes->URI->path);

                /* API look up of collection, if found load, else $pass_error_page = true */
                $check_collection = $this->api_Admin_Get_LookUpCollectionByName($URIx[1]);

                if (count($check_collection) == 1) {
                    /* Mutating the routes URI so the regEx can be found in the routes JSON object */
                    $this->routes->URI->path = "[$1]";
                    $this->routes->URI->template = $this->routes->{'[$1]'}['template'];
                    $this->routes->URI->page = $this->routes->{'[$1]'}['page'];
                
                    /* Adding data to the page index of the data object that is accessible in the templates and pages */
                    $this->page->title = ucwords(str_ireplace("-", " ", $URIx[1]));
                    $this->page->catalog_path = '/' . $URIx[1];
                    // $this->page->photo = $URIx[2];
                    $this->page->photo_path = $URIx[2];
                } 
                else { $pass_error_page = true; }

            /* Two wild card paths in URI */
            } else if (preg_match_all("/^\/[^\/]+\/[^\/]+\/$/m", $this->routes->URI->path . '/') == true) {

                /* splitting the URI path by forward slash */
                $URIx = explode('/', $this->routes->URI->path);
                unset($URIx[0]);

                switch($URIx[1]) {
                    case "fieldnotes":
                        // API look up of post title
                        $result = $this->api_Admin_Get_Fieldnotes_Item(null,$URIx[2]);

                        if(count($result) > 0) {
                            /* Mutating the routes URI so the regEx can be found in the routes JSON object */
                            $this->routes->URI->path = "/fieldnotes/[$1]";
                            $this->routes->URI->template = $this->routes->{'/fieldnotes/[$1]'}['template'];
                            $this->routes->URI->page = $this->routes->{'/fieldnotes/[$1]'}['page'];

                            /* Adding data to the page index of the data object that is accessible in the templates and pages */
                            $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
                            $this->page->catalog_path = '/' . $URIx[1] . '/' . $URIx[2];
                            $this->page->image_path = $result['image'];
                            $this->page->fieldnotes_id = $result['fieldnotes_id'];

                        } else {
                            $pass_error_page = true;
                        }
                    break;

                    case "photo":
                        /* default for /photo/[$1]; */
                        /* Mutating the routes URI so the regEx can be found in the routes JSON object */
                        $this->routes->URI->path = "[$1]/[$2]";
                        $this->routes->URI->template = $this->routes->{'[$1]/[$2]'}['template'];
                        $this->routes->URI->page = $this->routes->{'[$1]/[$2]'}['page'];
                
                        /* Adding data to the page index of the data object that is accessible in the templates and pages */
                        $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
                        $this->page->catalog_path = '/' . $URIx[1];
                        // $this->page->photo = $URIx[2];
                        $this->page->photo_path = $URIx[2];
                    break;

                    case "product":
                        /* Mutating the routes URI so the regEx can be found in the routes JSON object */
                        $this->routes->URI->path = "/" . $URIx[1] . "/[$1]";
                        $this->routes->URI->template = $this->routes->{"/" . $URIx[1] . '/[$1]'}['template'];
                        $this->routes->URI->page = $this->routes->{"/" . $URIx[1] . '/[$1]'}['page'];
                
                        /* Adding data to the page index of the data object that is accessible in the templates and pages */
                        $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
                        $this->page->catalog_path = $URIx[1];
                        $this->page->uri = $URIx[2];
                    break;
                    
                    default:
                     /* default for /photo/[$1]; */
                        /* Mutating the routes URI so the regEx can be found in the routes JSON object */
                        $this->routes->URI->path = "[$1]/[$2]";
                        $this->routes->URI->template = $this->routes->{'[$1]/[$2]'}['template'];
                        $this->routes->URI->page = $this->routes->{'[$1]/[$2]'}['page'];
                
                        /* Adding data to the page index of the data object that is accessible in the templates and pages */
                        $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
                        $this->page->catalog_path = '/' . $URIx[1];
                        // $this->page->photo = $URIx[2];
                        $this->page->photo_path = $URIx[2];
                    break;
                }
                
            } else {
                $pass_error_page = true;
            }

            if($pass_error_page == true) {
                
                $this->record_404($_SERVER['REQUEST_URI']);
                /* splitting the URI path by forward slash  *
                /
                $URIx = explode('/', $this->routes->URI->path);

                /* Error 404, page URI not found. Simply rewrite the URI as /404 */
                $this->routes->URI->path = "/404";
                $this->page->title = $this->routes->{$this->routes->URI->path}['title'];
                $this->routes->URI->requested_path = $URIx;
                $this->page->catalog_path = '404';
            } 

            /* Parse query string */
            if(isSet($this->routes->URI->query))
            {
                $this->data->routePathQuery = explode('&', $this->routes->URI->query);
                $this->routes->URI->queryvals = explode('=', $this->routes->URI->query);
            } else {
                $this->routes->URI->query = 'false';
            }

        /* Assign other vital vars needed to load teplate and page templates */
        if(isSet( $this->routes->{$this->routes->URI->path}['header'] )) { $this->page->header = $this->routes->{$this->routes->URI->path}['header']; }
        if(isSet( $this->routes->{$this->routes->URI->path}['controller'] )) { $this->routes->URI->controllerFile = $this->routes->{$this->routes->URI->path}['controller']; }
        if( $this->routes->{$this->routes->URI->path}['component'] == "true") { $this->routes->URI->component= $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}['page'] . ".inc.php"; }
        $this->routes->URI->template = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix_template . $this->routes->{$this->routes->URI->path}['template'] . ".php";
        $this->routes->URI->view = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}['page'] . ".php";

    }

    public function render() {

        /* start buffering the page */
        ob_start();

        /* include the template page specifed in the routes config if the template file is not valid then push to Route 404 */
        if(file_exists($this->routes->URI->template)) {
            include($this->routes->URI->template);
        } 
        else { 
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

                if(file_exists($this->routes->URI->component)) { 
                    include($this->routes->URI->component);
                } else { 
                    $this->errors['component'] = 'Component Not Found : ' . __FILE__ . ' : ' . __FUNCTION__ . ' : ' . __LINE__ . ' : ' . $this->routes->URI->component; 
                }

            } 
            
            /* Assign variables to be used in page content */
            // foreach($this->page as $k => $v) {
            //     $this->$k = $v;
            // }

            /* This file needs to load after the .inc file so inherits any data attributes */
            include($this->routes->URI->view);
        } else { 
            echo "<p>Roses are red, violets are blue, we are oh-so sorry we can not find your view.</p><p>This has been reported to the poet.</p>";
            $this->errors['component'] = 'View Not Found : ' . __FILE__ . ' : ' . __FUNCTION__ . ' : ' . __LINE__ . ' : ' . $this->routes->URI->view; 

        }

    }

    public function getJSON($file, $output_var) {

        /* Loads JSON filer and then assigns object to passed var */
        $dataJSON = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/"  . $file);
        $data = json_decode($dataJSON, true, JSON_UNESCAPED_SLASHES);
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

    public function console($val, $exit=0, $file=__FILE__, $method=__FUNCTION__, $line=__LINE__) {

        if ($this->config_env->env[$this->env]['show_console'] == "true") {
            echo "<div style='position: relative; padding: 10px; background-color: #ffff99; font-size: 1rem; color: #8900ff;'>";
                if (gettype($val) == "string") {
                    echo "<p>>>>>>Line: " . $line . " | ". $val . "<br ><span class=''>File: " . $file . "</span></p>";
                }

                if (gettype($val) == "array" ||
                gettype($val) == "object") {
                    echo ">>>>>Line: " . $line . " | typeof." . gettype($val) . "<br /><span class=''>File: " . $file . "</span><pre style='text-align: left; margin-left: 2rem; border-left: 1px solid #8900ff; padding-left: 1rem;'>";
                    print_r($val);
                    echo "</pre>";
                }
            echo "</div>";

            if ($exit == 1) {
                exit;
            }
        }

    }

    public function printp_r($value) {

        /* Makes a print_r dump a little easier on the brain */
        // echo "<pre style='text-align: left'>"; print_r($value); echo "</pre>";
        echo "<p style='background-color: red; color: #FFF;'>>>>>>> WARNING: " .  __FUNCTION__ . " IS DEPRECATED AS OF v1.4.1 PLEASE USE THE NEW console(msg, true) METHOD</p>";
    }

    public function debugInfo() {

        /* Outputs some objects and arrays for debugging */
        if ($this->routes->URI->query == "debug=false") {
            return 0;
        } 
        else if($this->config_env->env[$this->env]['debug'] == "true" || $this->routes->URI->query == "debug=true") {
            
            $result = get_object_vars($this);

            if($this->config_env->env[$this->env]['exclude_vars'] == "true") {
                unset($result['routes']);
                unset($result['config_env']);
                unset($result['mysqli']);
            } 

            echo "<script>
            jQuery(document).ready(function($) { 
                $('.debug_trigger').on('click', function() { 
                    console.log('debug-window-toggle');
                    $('#debug_container').toggle();
                    window.scrollBy(0,100);
                }); 
            });
            </script>";
            echo "<div class='debug_trigger' style='background-color: yellow; font-size: 1rem;'>";
            echo "<p style='font-size: 1rem;'>>>>>> " . $this->env . " CONSOLE --start | " . date('l jS \of F Y h:i:s A') . "</p> </div>";
            echo "<div id='debug_container' style='display:none;'>";
            $this->console($result);
            if(isSet($_SESSION)) { $this->console($_SESSION); }
            echo "<hr />";
            if(isSet($_POST)) { $this->console($_POST); }
            if(isSet($_FILES)) { $this->console($_FILES); }
            echo "<div style='background-color: yellow; font-size: 1rem;'><p class='debug_trigger' style='font-size: 1rem;'>>>>>> CONSOLE --end</p></div>";
            echo "</div>";
        }
    }
    
    public function record_404($error) {
        
        $to = 'system-404@jmgalleries.com';
        $header_from = "FROM: SysAdmin-jM Galleries <'system-core@jmgalleries.com'>";
        $reply_to = 'system-core@jmgalleries.com';
        $subject = '404 ' . $error;
        $message = "The following page could not be found.\n\n{\nURI: " . $error ."\nSERVER_IP: " . $_SERVER['REMOTE_ADDR'] . "\nREFERR_URI: " . $_SERVER['HTTP_REFERER'] . "\n}";
        $headers =  $header_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n" . 'X-Mailer: PHP/' . phpversion() . '/SysAdmin-jM Galleries';
        mail($to, $subject, $message, $headers);
        
    }
}
?>