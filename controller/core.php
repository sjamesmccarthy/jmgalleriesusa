<?php

class Core
{

    public $config; 
    public $routes;
    public $query;
    public $session;
    public $session_started;
    public $URI;
    public $match;
    public $path;
    public $data;
    public $page;
    public $title;
    public $meta;
    public $template;
    public $view;

    public function initSession() {

        /* Starting the session and setting the lifetime to 1 day */
        session_start([
            'cookie_lifetime' => 86400,
            'cookie_domain' => 'jmgalleries.com',
            'cookie_httponly' => true,
            'cookie_secure' => true
            ]);   
    }

    public function getRoute() {
        
        /* **************** LOCATION of ERROR
        FIX for
        Warning: Creating default object from empty value in /Users/james/source/jmgalleriesusa/class.core.php on line 48
         */

        $this->routes->URI = new StdClass;
        $this->data = new StdClass;
        $this->data->page = new StdClass;
        
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
                $this->data->page->title = $this->routes->{$this->routes->URI->path}['title'];
                $this->data->page->catalog = $this->routes->URI->path;
                $this->routes->URI->layout = $this->routes->{$this->routes->URI->path}['layout'];
                $this->routes->URI->page = $this->routes->{$this->routes->URI->path}['page'];
                
            } else if (preg_match("/[\/]*[^\/]+[\/]([^\/]+)/", $this->routes->URI->path) == true) {

                /* splitting the URI path by forward slash */
                $URIx = explode('/', $this->routes->URI->path);

                /* Mutating the routes URI so the regEx can be found in the routes JSON object */
                $this->routes->URI->path = "[$1]/[$2]";
                $this->routes->URI->layout = $this->routes->{'[$1]/[$2]'}['layout'];
                $this->routes->URI->page = $this->routes->{'[$1]/[$2]'}['page'];

                /* Adding data to the page index of the data object thatis accessible in the templates and pages */
                $this->data->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
                $this->data->page->catalog = '/' . $URIx[1];
                $this->data->page->photo = $URIx[2];
                 
            } else {

                /* Error 404, page URI not found. Simply rewrite the URI as /404 */
                $this->routes->URI->path = "404";
                $this->routes->URI->layout = "page";
                $this->routes->URI->page = "404";
                $this->routes->URI->title = "ERROR 404";
            }

            /* Parse query string */
            if(isSet($this->routes->URI->query))
            {
                $this->data->routePathQuery = explode('&', $this->routes->URI->query);
            } else {
                $this->routes->URI->query = 'false';
            }

        /* Assign other vital vars needed to load layout and page templates */
        if(isSet( $this->routes->{$this->routes->URI->path}['header'] )) { $this->data->page->header = $this->routes->{$this->routes->URI->path}['header']; }
        if(isSet( $this->routes->{$this->routes->URI->path}['controller'] )) { $this->routes->URI->componentFile = $this->routes->{$this->routes->URI->path}['controller']; }
        $this->routes->URI->template = $_SERVER["DOCUMENT_ROOT"] . "/view/template/" . $this->config->prefix['layout'] . $this->routes->{$this->routes->URI->path}['layout'] . ".php";
        $this->routes->URI->view = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix['page'] . $this->routes->{$this->routes->URI->path}['page'] . ".php";
    }

    public function render() {
         
        /* Assign variables to be used in page content */
        $this->content = $this->data->page;

        /* start buffering the page */
        ob_start();

        /* include the layout page specifed in the routes config if the layout file is not valid then push to Route 404 */
        if(file_exists($this->routes->URI->template)) {
            include($this->routes->URI->template);
        } else { 
            echo "<p>Layout File Not Found, \Studio\Gallery\Core::render(" . __LINE__ . ", " . $this->routes->URI->template . ")</p>";
        }

        /* Flush the output buffer */
        ob_flush();

        /* Get the layout and page data from the buffer */
        $buffer= ob_get_contents();

        /* Output the buffer contents to screen */
        print $buffer;

        /* Flush and dump the buffer */
        ob_end_clean();
    }

    public function view($view=null) {

        /* include the layout page specifed in the routes config */
        if(file_exists($this->routes->URI->view)) {
            include($this->routes->URI->view);
        } else { 
            echo "<p>File Not Found, \Studio\Gallery\Core::getPageContent(" . __LINE__ . "," . $this->routes->URI->view . ")</p>";
        }
    }

    public function partial($value) {

        /* Validate file and then include in layout */
        if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/view/partial/" . $this->config->prefix['partial'] . $value . '.php')) {
           include($_SERVER["DOCUMENT_ROOT"] . "/view/partial/" . $this->config->prefix['partial'] . $value . '.php');
        } else {
            echo "<p>File Not Found, \Studio\Gallery\Core::partial(" .  $value . ") : " . __LINE__ . "</p>";
        }
    }

    public function printp_r($value) {

        /* Makes a print_r dump a little easier on the brain */
        echo "<pre>"; print_r($value); echo "</pre>";
    }

    public function debugInfo() {

        /* Outputs some objects and arrays for debugging */
        if($this->config->package_debug == "true" || $this->routes->URI->query == "debug=true") {
        echo "<div style='padding: 40px; background-color: rgba(255, 249, 222, 1);'><p>DEBUG</p>";
        echo "<hr /><p>Object(data)", $this->printp_r($this->data), "</p>";
        echo "<p>Object(routes->URI)", $this->printp_r($this->routes->URI), "</p>";
        echo "<p>Object(config)", $this->printp_r($this->config), "</p>";
        echo "</div>";
        }
    }
    
    public function __getJSON($file, $outputVar) {

        /* Loads JSON filer and then assigns object to passed var */
        $dataJSON = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/"  . $file);
        $data = json_decode($dataJSON, true);
        $this->$outputVar = (object) $data;
    }

    public function loadc($model) {

        /* Loads an additional Class */
        $name = $model;
        require_once($_SERVER["DOCUMENT_ROOT"] . "/" . $model . ".php");
        $model = new $model($this);
        $this->$name = $model;
        
        return $this;

    }

}

?>