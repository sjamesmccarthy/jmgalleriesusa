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
    public $layoutFile;
    public $data;

    public function __construct() {
        self::getJSON('config.json','config');
        self::getJSON('routes.json','routes');
        self::setTimeZone($this->config->package_timezone);
        self::initSession();
    }

    public function initSession() {
        session_start([
            'cookie_lifetime' => 86400,
            'cookie_domain' => 'jmgalleries.com',
            'cookie_httponly' => true,
            'cookie_secure' => true
            ]);
        $this->config->session_started = session_get_cookie_params();
        $this->data->session = (object) session_get_cookie_params();
    }

    public function getRoute() {
        $this->routes->URI = (object) parse_url(rtrim($_SERVER['REQUEST_URI'], '/'));

        /* Match the [path] of URI to the routes.json */
        if(property_exists($this->routes, $this->routes->URI->path) == true)
        {
            $this->routes->URI->match = true;
               
        } else if (preg_match("/[A-Za-z]\/photo\/[A-Za-z]/", $this->routes->URI->path) == true) {
            // current URI form: /landscapes/photo/reflections
            $URIx = explode('/', $this->routes->URI->path);
            $this->routes->URI->path = "[collection]/[photo]/[name]";
            $this->routes->URI->layout = "page";
            $this->routes->URI->page = "detail";
            $this->routes->{$this->routes->URI->path}['title'] = ucwords(str_ireplace("-", " ", $URIx[3]));
            $this->routes->{$this->routes->URI->path}['collection'] = $URIx[1];
            
            $this->data->page = (object) $this->routes->{$this->routes->URI->path};
            $this->data->page->photo = $URIx[3];
        } else {
            /* Error 404, page URI not found */
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

        // $this->data->page = (object) $this->routes->{$this->routes->URI->path};
        $this->data->page->path = $this->routes->URI->path;
        $this->routes->URI->layoutFile = __DIR__ . "/" . $this->config->prefix['layout'] . $this->routes->{$this->routes->URI->path}['layout'] . ".php";
        $this->routes->URI->pageFile = __DIR__ . "/" . $this->config->prefix['page'] . $this->routes->{$this->routes->URI->path}['page'] . ".php";

    }

    public function buildLayout() {

        $this->content = $this->data->page;

        /* start buffering the page */
        ob_start();

        /* include the layout page specifed in the routes config */
        if(!@include($this->routes->URI->layoutFile)) { /* redirect home */ }
        
        ob_flush();

    }

    public function getPhotoDetail($collection, $photo) {
        
        $path = __DIR__ . '/collections/' . $collection . "/";

        /* search negative collection file JSON data */
        self::getJSON('collections/' . $collection .  '/_collection.json','cdata');
        
        // echo "<pre>";
        // print_r($this->cdata);
        // echo "<hr />";

        /* Loop through "collection_photo". If $photo = $file_name" */

        $photo_list = (array) $this->cdata->collection_photo;

        // print_r($photo_list);

        for ($i = 0; $i < count($photo_list); $i++) {

            if($photo_list[$i]['file_name'] == $photo) {
                /* Get meta data of this photo */
                $this->data->page->meta = $photo_list[$i];
            } else {
                /* ERROR */
            }
        }

        // echo ('locating negative meta-data: ' . $path . '_collection.json <br />');
        // echo ('Looking for photo details: ' . $path . $photo  . '.jpg');
        
    }

    public function getPageContent() {
        
        /* include the layout page specifed in the routes config */
        if(!@include($this->routes->URI->pageFile)) {   
        }
        
    }
    
    public function renderPage() {
        $buffer= ob_get_contents();
        print $buffer;
        ob_end_clean();
    }

    public function loadNegativeFile($collection) {
        $nFile = 'collections' . $collection . '/' . $this->config->prefix['negatives'] . '.json';
        // echo $nFile . "<br />";
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

    public function insert($value) {
        echo "[insert: ", $this->config->prefix['partial'], $value, ".php]<br />";
    }

    public function setTimeZone($tz) {
        date_default_timezone_set($tz);
        $this->config->ini_tz = ini_get('date.timezone');
        $this->config->active_tz = date_default_timezone_get();
    }

    public function printp_r($value) {
        echo "<pre>"; print_r($value); echo "</pre>";
    }

    public function getJSON($file, $outputVar) {
        // echo "<hr />fetching JSON: " . __DIR__ . "/"  . $file . "<hr />";
        $dataJSON = file_get_contents(__DIR__ . "/"  . $file);
        $data = json_decode($dataJSON, true);
        $this->$outputVar = (object) $data;
    }

}
?>