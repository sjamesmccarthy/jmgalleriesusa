<?php

class Core_Site extends Core_Api
{

    public $config; 
    public $routes;
    public $session_started;
    public $data;
    public $page;

    public function __construct() {

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

    public function initSession() {

        /* Starting the session and setting the lifetime to 1 day */
        session_start([
            'cookie_lifetime' => 86400
            ]);   

        $this->session_started = array(session_id(), $_SESSION);
        $this->startDB();
    }

    public function getRoute() {
        
        /* Parse the URI */
        $this->routes->URI = (object) parse_url($_SERVER['REQUEST_URI']);

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

                /* Error 404, page URI not found. Simply rewrite the URI as /404 */
                $this->routes->URI->path = "/404";
                $this->routes->URI->path = "/404";
            }

            /* Parse query string */
            if(isSet($this->routes->URI->query))
            {
                $this->data->routePathQuery = explode('&', $this->routes->URI->query);
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
            echo "<p>Template File Not Found, \Studio\Gallery\Core::render(" . __LINE__ . "),<br />" . $this->routes->URI->template . "</p>";
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
                else { print "<p>Component File Not Found" . $this->routes->URI->component . "</p>"; }
            } 
            
            /* Assign variables to be used in page content */
            foreach($this->page as $k => $v) {
                $this->$k = $v;
            }

            /* This file needs to load after the .inc file so inherits any data attributes */
            include($this->routes->URI->view);
        } else { 
            echo "<p>File Not Found, \Studio\Gallery\Core::getPageContent(" . __LINE__ . "," . $this->routes->URI->view . ")</p>";
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
            echo "<div style='padding: 40px; background-color: rgba(255, 249, 222, 1);'><p>DEBUG --config-true</p>";
            echo "<hr />";
            $this->printp_r($this);
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

    public function getPartial($partial) {

        /* Check to see if the partial file has an Include Component with it */
        $file = $_SERVER['DOCUMENT_ROOT'] . '/view/partial_' . $partial;
        
        if( file_exists($file . ".inc.php") ) {
            include_once($file . ".inc.php");
        } 
        
        /* Include the partial file if exists */
        if( file_exists($file . '.php')) {
            include_once($file . '.php');
        } else {
            echo "Requested Object Not Available: " . $partial;
        }
    }

}
?>