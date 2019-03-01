<?php

namespace Studio\Gallery;

class Core 
{

    public $config; 
    public $routes;
    public $ini_tz;
    public $active_tz;
    public $session;
    public $session_started;
    public $URI;
    public $match;
    public $routePathIndex;
    public $data;
    public $layoutFile;

    public function __construct() {

        /* Import the config file */
        $this->getJSON('config.json','config');

        /* Import the routing paths */
        $this->getJSON('routes.json','routes');

        /* Initialize the Session */
        $this->initSession();
    }

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

        /* Parse the URI */
        $this->routes->URI = (object) parse_url($_SERVER['REQUEST_URI']);

        /* Check for root level or trim slashes */
        if($this->routes->URI->path != '/') {
            $this->routes->URI->path = rtrim($this->routes->URI->path, '/');
        }

        /* Check for regular expressions in route from ROUTES config */
        /* Then start parsing the URI */

        /* Match the [path] of URI to the routes.json */
        if(property_exists($this->routes, $this->routes->URI->path) == true)
        {
            /* Direct route match URI === route path */
            $this->routes->URI->match = true;

        } else if (preg_match("/[\/]*[^\/]+[\/]([^\/]+)/", $this->routes->URI->path) == true) {

            /* splitting the URI path by forward slash */
            $URIx = explode('/', $this->routes->URI->path);

            $this->routes->URI->path = "[$1]/[$2]";
            $this->routes->URI->layout = $this->routes->{'[$1]/[$2]'}['layout'];
            $this->routes->URI->page = $this->routes->{'[$1]/[$2]'}['page'];

            /* Mutating the routes json file */
            $this->routes->{$this->routes->URI->path}['title'] = ucwords(str_ireplace("-", " ", $URIx[2]));
            $this->routes->{$this->routes->URI->path}['collection'] = $URIx[1];
            
            $this->data->page = (object) $this->routes->{$this->routes->URI->path};
            $this->data->page->photo = $URIx[2];
            
        } else {
            /* Error 404, page URI not found */
            /* Simply rewrite the URI as /404 */
            
            $this->routes->URI->path = "404";
            $this->routes->URI->layout = "page";
            $this->routes->URI->page = "404";
            $this->routes->URI->title = "ERROR 404";
        }

        /* Parse query string */
        if(isSet($this->routes->URI->query))
        {
            $this->data->routePathQuery = explode('&', $this->routes->URI->query);
        }

        /* Assign other vital vars needed to load layout and page templates */
        $this->data->page->route_path = $this->routes->URI->path;
        $this->data->page->title =  $this->routes->{$this->routes->URI->path}['title'];
        $this->routes->URI->layoutFile = __DIR__ . "/" . $this->config->prefix['layout'] . $this->routes->{$this->routes->URI->path}['layout'] . ".php";
        $this->routes->URI->pageFile = __DIR__ . "/" . $this->config->prefix['page'] . $this->routes->{$this->routes->URI->path}['page'] . ".php";
    }

    public function render() {

        /* Assign variables to be used in page content */
        $this->content = $this->data->page;

        /* start buffering the page */
        ob_start();

        /* include the layout page specifed in the routes config if the layout file is not valid then push to Route 404 */
        if(file_exists($this->routes->URI->layoutFile)) {
            include($this->routes->URI->layoutFile);
        } else { 
            echo "<p>Layout File Not Found, \Studio\Gallery\Core::render(" . __LINE__ . ", " . $this->routes->URI->layoutFile . ")</p>";
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

    public function getPageContent() {

        /* include the layout page specifed in the routes config */
        if(file_exists($this->routes->URI->pageFile)) {
            include($this->routes->URI->pageFile);
        } else { 
            echo "<p>File Not Found, \Studio\Gallery\Core::getPageContent(" . __LINE__ . "," . $this->routes->URI->pageFile . ")</p>";
        }
    }

    public function insert($value) {

        /* Validate file and then include in layout */
        if(file_exists(__DIR__ . "/" . $this->config->prefix['partial'] . $value . '.php')) {
           include(__DIR__ . "/" . $this->config->prefix['partial'] . $value . '.php');
        } else {
            echo "<p>File Not Found, \Studio\Gallery\Core::insert(" . __LINE__ . ", $value)</p>";
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
        echo "</div>";
        }
    }
    public function getJSON($file, $outputVar) {
        
        /* Loads JSON filer and then assigns object to passed var */
        $dataJSON = file_get_contents(__DIR__ . "/"  . $file);
        $data = json_decode($dataJSON, true);
        $this->$outputVar = (object) $data;
    }

    /* ****************************************************************************************** */
    /* Specific methods to jmgalleries */
    /* ****************************************************************************************** */

    public function loadNegativeFile($collection) {
        $nFile = 'collections' . $collection . '/' . $this->config->prefix['negatives'] . '.json';
        self::getJSON($nFile,'negatives');

        /* Loop through "collection_photo". If $photo = $file_name" */
        $photo_list = (array) $this->negatives->collection_photo;
        
        for ($i = 0; $i < count($photo_list); $i++) {
            /* Get meta data of this photo */
            $this->data->page->meta[$i]['file_name'] = $photo_list[$i]['file_name'] . '.jpg';
            $this->data->page->meta[$i]['title'] = $photo_list[$i]['title'];
            $this->data->page->meta[$i]['loc_place'] = $photo_list[$i]['loc_place'];
            $this->data->page->meta[$i]['loc_state'] = $photo_list[$i]['loc_state'];
        }
    }

    public function getPhotoDetail($collection, $photo) {
        $path = __DIR__ . '/collections/' . $collection . "/";

        /* search negative collection file JSON data */
        self::getJSON('collections/' . $collection .  '/_collection.json','cdata');
        $photo_list = (array) $this->cdata->collection_photo;

        for ($i = 0; $i < count($photo_list); $i++) {
            if($photo_list[$i]['file_name'] == $photo) {
                /* Get meta data of this photo */
                $this->data->page->meta = $photo_list[$i];
            } else {
                /* ERROR */
            }
        }
    }

}
?>