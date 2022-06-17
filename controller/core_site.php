<?php

/**
 * Core_Site
 * Site functions for gloab environment
 */
class Core_Site extends Core_Api
{
  public $config;
  public $routes;
  public $session_started;
  public $data;
  public $page;
  public $alias;
  public $template;
  public $catalog_path;
  public $title;
  public $errors;

  public function __construct() {

    date_default_timezone_set("America/Los_Angeles");
    $this->system = (object) [];
    $this->page   = (object) [];
    $this->data   = (object) [];

    /* Import the config file */
    $this->getJSON("config.json", "config");

    /* Import the auth_config file */
    $this->getJSON("config_env.json", "config_env");

    /* Get and Set the environment: local or prod */
    $this->getEnv();

    /* Import the routing paths */
    $this->getJSON("routes.json", "routes");

    /* Initialize the Session */
    $this->initSession();

    /* Start the database */
    $this->startDB();

    /* Check URI against routes json file */
    $this->getRoute();
  }

  public function getEnv()
  {
    /* Check for environment in URI based on domain extension */
    $uri = explode(".", $_SERVER["SERVER_NAME"]);

    if (!isset($uri[1]) || $uri[1] == "local") {
      $this->env = "local";
    } else {
      $this->env = "prod";
    }

    /* Error reporting levels being outputted to screen and logged */
    // Level 0 = None
    // level 1 = E_ALL 
    // level 2 = E_ALL & ~E_NOTICE & ~E_WARNING

    if($this->config_env->env[$this->env]['error_reporting'] == 1) {
      error_reporting(E_ALL);
    } else if ($this->config_env->env[$this->env]['error_reporting'] == 2) {
      error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
    } else {
      error_reporting(0);
    }
  }

  public function initSession()
  {
    if (!isset($_SESSION["uid"])) {
      $route_check = explode("/", $_SERVER["REQUEST_URI"]);

      if ($route_check[1] == "studio") {
        $sess_type = "ADMIN";
        $lifetime = $this->config->session_cookie_lifetime; /* 1 Day = 86400 */
        session_set_cookie_params($lifetime, "/studio");
      } elseif ($route_check[1] == "d") {
        $sess_type = "COLLECTOR";
        $lifetime =
          $this->config->session_cookie_lifetime; /* until browser is closed */
        session_set_cookie_params($lifetime, "/d");
      } else {
        $sess_type = "USER";
        $lifetime =
          $this->config->session_cookie_lifetime; /* until browser is closed */
        session_set_cookie_params($lifetime, "/");
      }

      session_save_path(
        $this->config_env->env[$this->env]["session_save_path"]
      );
      session_start();
      session_gc();

      $this->system->ip = $_SERVER["REMOTE_ADDR"];
      $_SESSION["__SYSTEM"]["USERAGENT"] = $_SERVER["HTTP_USER_AGENT"];
      $_SESSION["__SYSTEM"]["SESS_TYPE"] = $sess_type;
    } else {
      $this->console($_SESSION, 1);
    }
  }

  public function checkSession() {

    if (!isset($_SESSION["uid"]) || $_SESSION["dashboard"] != "ARTIST") {
      $_SESSION["error"] = "timeout";
      return false;
    } else {
      return true;
    }
  }

  public function checkSessionCollector()
  {
    if (!isset($_SESSION["uid"]) || $_SESSION["dashboard"] != "COLLECTOR") {
      $this->console($_SESSION);
      $_SESSION["error"] = "timeout";
      return false;
    } else {
      return true;
    }
  }

public function getRoute()
{
    $pass_error_page = false;
    $wildcard = 0;
    $wild_needles = array("/[$1]","[$1]","[$1]/[$2]");

    /* If URI in request contains two slashes in a row, make 1 slash */
    $URI_path_tmp = $_SERVER['REQUEST_URI'];
    $URI_path = str_replace("//", "/", $URI_path_tmp);
    
    $this->routes->URI = (object) parse_url($URI_path);
    $this->routes->URI->url = "//{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
    $this->routes->URI->useragent = $_SERVER["HTTP_USER_AGENT"];
    
    /* Check for root level or trim slashes */
    if ($this->routes->URI->path != "/") {
      $this->routes->URI->path = rtrim($this->routes->URI->path, "/");
    } else {
      $this->routes->URI->path = '/home';
    }

  /* Match the [path] of URI to the routes.json */
if (property_exists($this->routes, $this->routes->URI->path) == true) {

      $this->routes->URI->match    = "true";
      $this->page->title           = $this->routes->{$this->routes->URI->path}["title"];
      $this->page->catalog_path    = $this->routes->URI->path;
      $this->routes->URI->template = $this->routes->{$this->routes->URI->path}["template"];
      $this->routes->URI->page     = $this->routes->{$this->routes->URI->path}["page"];
      $this->routes->URI->alias    = $this->routes->{$this->routes->URI->path}["alias"];

       /* Check if Template type is REDIRECT */
      if ($this->routes->{$this->routes->URI->path}["template"] == "redirect") {
        header("location:" . $this->routes->{$this->routes->URI->path}["page"]);
        exit;
      } 

      /* Check if Template type is SCRIPT */
      /* Update: Perhaps this needs to be moved somewhere above checkign if it exists as a route */
      if ($this->routes->{$this->routes->URI->path}["template"] == "script") {
        // header('location:' . $this->routes->{$this->routes->URI->path}['page']);

        if (file_exists($_SERVER["DOCUMENT_ROOT"] ."/view/__ajax/" . $this->routes->{$this->routes->URI->path}["page"])) {
          include_once $_SERVER["DOCUMENT_ROOT"] . "/view/__ajax/" . $this->routes->{$this->routes->URI->path}["page"];
        } else {
          $this->errors["script"] = "Script Not Found : " . __FILE__ . " : " . __FUNCTION__ . " : " . __LINE__ . " : " . $this->routes->{$this->routes->URI->path}["page"];
        }

      }

/* One wildcard [$1] path and then checks database for that collection */
} elseif (preg_match_all("/^\/[^\/]+\/$/m", $this->routes->URI->path . "/") == true) {

      /* splitting the URI path by forward slash */
      $URIx = explode("/", $this->routes->URI->path);

      // $this->console($URIx,1);

      /* API look up of collection, if found load, else $pass_error_page = true */
      $check_collection = $this->api_Admin_Get_LookUpCollectionByName($URIx[1]);

      if (count($check_collection) == 1) {
        /* Mutating the routes URI so the regEx can be found in the routes JSON object */
        $this->routes->URI->path = "[$1]";
        $this->routes->URI->template = $this->routes->{'[$1]'}["template"];
        $this->routes->URI->page = $this->routes->{'[$1]'}["page"];
        $this->routes->URI->alias    = $this->routes->{$this->routes->URI->path}["alias"];

        /* Adding data to the page index of the data object that is accessible in the templates and pages */
        $this->page->title = ucwords(str_ireplace("-", " ", $URIx[1]));
        $this->page->catalog_path = "/" . $URIx[1];
        // $this->page->photo = $URIx[2];
        $this->page->photo_path = $URIx[2];
      } else {
        $pass_error_page = true;
      }

/* Two wild card [$1]/[$2] paths in URI */
} elseif (preg_match_all("/^\/[^\/]+\/[^\/]+\/$/m",$this->routes->URI->path . "/") == true) {

      /* splitting the URI path by forward slash */
      $URIx = explode("/", $this->routes->URI->path);
      unset($URIx[0]);

      switch ($URIx[1]) {
        case "fieldnotes":
          // API look up of post title
          $result = $this->api_Admin_Get_Fieldnotes_Item(null, $URIx[2]);

          if (count($result) > 0) {
            /* Mutating the routes URI so the regEx can be found in the routes JSON object */
            $this->routes->URI->path = "/fieldnotes/[$1]";
            $this->routes->URI->template = $this->routes->{'/fieldnotes/[$1]'}["template"];
            $this->routes->URI->page = $this->routes->{'/fieldnotes/[$1]'}["page"];

            /* Adding data to the page index of the data object that is accessible in the templates and pages */
            $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
            $this->page->catalog_path = "/" . $URIx[1] . "/" . $URIx[2];
            $this->page->image_path = $result["image"];
            $this->page->fieldnotes_id = $result["fieldnotes_id"];

            $wildcard =1;

          } else {
            $pass_error_page = true;
          }
          break;

        case "photo":
          /* default for /photo/[$1]; */
          /* Mutating the routes URI so the regEx can be found in the routes JSON object */
          $this->routes->URI->path = "[$1]/[$2]";
          $this->routes->URI->template =
          $this->routes->{'[$1]/[$2]'}["template"];
          $this->routes->URI->page = $this->routes->{'[$1]/[$2]'}["page"];

          /* Adding data to the page index of the data object that is accessible in the templates and pages */
          $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
          $this->page->catalog_path = "/" . $URIx[1];
          // $this->page->photo = $URIx[2];
          $this->page->photo_path = $URIx[2];

          $wildcard =2;
          break;

        case "product":
          /* Mutating the routes URI so the regEx can be found in the routes JSON object */
          $this->routes->URI->path = "/" . $URIx[1] . "/[$1]";
          $this->routes->URI->template = $this->routes->{"/" . $URIx[1] . '/[$1]'}["template"];
          $this->routes->URI->page = $this->routes->{"/" . $URIx[1] . '/[$1]'}["page"];

          /* Adding data to the page index of the data object that is accessible in the templates and pages */
          $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
          $this->page->catalog_path = $URIx[1];
          $this->page->uri = $URIx[2];
          
          $wildcard =1;
          break;

        default:
          /* Mutating the routes URI so the regEx can be found in the routes JSON object */
          $this->routes->URI->path = "[$1]/[$2]";
          $this->routes->URI->template = $this->routes->{'[$1]/[$2]'}["template"];
          $this->routes->URI->page = $this->routes->{'[$1]/[$2]'}["page"];

          /* Adding data to the page index of the data object that is accessible in the templates and pages */
          $this->page->title = ucwords(str_ireplace("-", " ", $URIx[2]));
          $this->page->catalog_path = "/" . $URIx[1];
          // $this->page->photo = $URIx[2];
          $this->page->photo_path = $URIx[2];

          $wildcard =2;
          break;
      }

} else {
    /* Nothing was found so nothing to do but ERROR */
    $pass_error_page = true;
}

    /* Look for an error page result. */
    if ($pass_error_page == true) {
      $this->record_404($_SERVER["REQUEST_URI"]);
      $this->routes->URI->path = "/404";
      $this->page->title = $this->routes->{$this->routes->URI->path}["title"];
      $this->routes->URI->requested_path = $URIx;
      $this->page->catalog_path = "404";
    }

    /* Parse query string */
    if (isset($this->routes->URI->query)) {
      $this->data->routePathQuery = explode("&", $this->routes->URI->query);
      $this->routes->URI->queryvals = explode("=", $this->routes->URI->query);
    } else {
      $this->routes->URI->query = "false";
    }

    /* Assign other vital vars needed to load teplate and page templates */
    if (isset($this->routes->{$this->routes->URI->path}["header"])) {
      $this->page->header = $this->routes->{$this->routes->URI->path}["header"];
    }

    if (isset($this->routes->{$this->routes->URI->path}["controller"])) {
      $this->routes->URI->controllerFile = $this->routes->{$this->routes->URI->path}["controller"];
    }

    /* COMPONENT (.inc.php) FILE */
    if ($this->routes->{$this->routes->URI->path}["component"] == "true") {

      $this->routes->URI->component = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".inc.php";
      $this->routes->URI->SFC_component = $_SERVER["DOCUMENT_ROOT"] . "/view" . $this->routes->URI->path . '/' . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".inc.php";
      
      /* SFC Exceptions for COMPONENT (.inc.php) files */
      if($wildcard == 1) {
        $this->routes->URI->SFC_component = str_replace($wild_needles, "", $this->routes->URI->SFC_component);
      }      
      
      if($wildcard == 2) {
        $this->routes->URI->SFC_component = str_replace($wild_needles, "", $this->routes->URI->SFC_component);
        $this->routes->URI->SFC_component = str_replace("[$2]", $this->routes->URI->page, $this->routes->URI->SFC_component);
      }

      if ($this->routes->URI->alias == "true") {
        $this->routes->URI->SFC_component = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->routes->URI->page . '/' . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".inc.php";
      }

    }

    $this->routes->URI->template = $_SERVER["DOCUMENT_ROOT"] . "/view/__templates/" . $this->config->prefix_template . $this->routes->{$this->routes->URI->path}["template"] . ".php";
    $this->routes->URI->view = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".php";
    $this->routes->URI->SFC_view = $_SERVER["DOCUMENT_ROOT"] . "/view" . $this->routes->URI->path . '/' . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".php";
    
    /* SFC Exceptions for VIEW */
    if($wildcard == 1) {
      $this->routes->URI->SFC_view = str_replace($wild_needles, "", $this->routes->URI->SFC_view);
    }
    
    if($wildcard == 2) {
      $this->routes->URI->SFC_view = str_replace($wild_needles, "", $this->routes->URI->SFC_view);
      $this->routes->URI->SFC_view = str_replace("[$2]", $this->routes->URI->page, $this->routes->URI->SFC_view);
    }

    if ($this->routes->URI->alias == "true") {
      $this->routes->URI->SFC_view = $_SERVER["DOCUMENT_ROOT"] . "/view/" . $this->routes->URI->page . '/' . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".php";
    }

    /* Check for ADMIN routing */
    if($this->routes->{$this->routes->URI->path}["template"] == "admin") {
      
      // Setting both SFC_ and Classic so that warnings and errors are not logged
      $URI_admin = explode("/", ltrim($this->routes->URI->path, '/'));
      $URI_admin_cleaned = str_replace("-add", "", $URI_admin[1]);
      $this->routes->URI->component = $_SERVER["DOCUMENT_ROOT"] . "/view/admin/" . $URI_admin_cleaned . '/' . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".inc.php";
      $this->routes->URI->SFC_component = $_SERVER["DOCUMENT_ROOT"] . "/view/admin/" . $URI_admin_cleaned . '/' . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".inc.php";
      $this->routes->URI->view = $_SERVER["DOCUMENT_ROOT"] . "/view/admin/" . $URI_admin_cleaned . '/' . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".php";
      $this->routes->URI->SFC_view = $_SERVER["DOCUMENT_ROOT"] . "/view/admin/" . $URI_admin_cleaned . '/' . $this->config->prefix_page . $this->routes->{$this->routes->URI->path}["page"] . ".php";

    }

  }

  public function render()
  {
    /* start buffering the page */
    ob_start();

    if (is_file($this->routes->URI->template)) {
      
      /* include the template page specifed in the routes config if the template file is not valid then push to Route 404
      * the template file includes the view */
      include $this->routes->URI->template;

    } else {
      $this->log_watch(array("key" => "core_site", "value" => "Template Not Found : " . $this->routes->URI->template, "type" => "failure"));
    }

    /* Flush the output buffer */
    ob_flush();

    /* Get the template and page data from the buffer */
    $buffer = ob_get_contents();

    /* Output the buffer contents to screen */
    print $buffer;

    /* Flush and dump the buffer */
    ob_get_clean();
  }
  
public function view($view = null) {
   
    $err_View =0;

    /* Check to see if a component file for this view is enabled and then if exists */
    if ($this->routes->{$this->routes->URI->path}["component"] == "true") {

      /* Check to see if this is classic component */
      if (is_file($this->routes->URI->component)) {
        include_once $this->routes->URI->component;
      } else {
        $this->log_watch(array("key" => "core_site", "value" => "CLASSIC_component Not Found : " . $this->routes->URI->component, "type" => "failure"));
      }

      /* Check to see if this is new Single Component Catalog file */
      if (is_file($this->routes->URI->SFC_component)) {
        // $this->console("SFC_Component.Found " . $this->routes->URI->SFC_component);
        include_once $this->routes->URI->SFC_component;
      } else {
        $this->log_watch(array("key" => "core_site", "value" => "SFC_component Not Found : " . $this->routes->URI->SFC_component, "type" => "warning"));
      }

    }

    /* Check to see if this is classic view file */
    if (is_file($this->routes->URI->view)) {
      include $this->routes->URI->view;
    } else {
      $err_View++;
      $this->log_watch(array("key" => "core_site", "value" => "View Not Found : " . $this->routes->URI->view, "type" => "failure"));
    }

    /* Check to see if this is new Single Component Catalog file */
    // $this->console("SFC_View.Found " . $this->routes->URI->SFC_view,1,__LINE__);
    if (is_file($this->routes->URI->SFC_view)) {
      include_once $this->routes->URI->SFC_view;
    } else {
      $err_View++;
      $this->log_watch(array("key" => "core_site", "value" => "SFC_view Not Found : " . $this->routes->URI->SFC_view, "type" => "warning"));
    }

    /* Produce a combined error message and log failure when View fails to be found in both places (this is why value == 2) */
    if($err_View == 2) {
      echo "<div class='pt-64 text-center'><h2>&technicalProblem.Reported(" . $err_View . ")</h2><p class='text-center'>Roses are red, violets are blue, we are oh-so sorry we can not find your view.</p><p class='text-center hidden'>This has been reported to the poet.</p><p class='text-center pt-32'><a href='/'>-- return to homepage --</a></p></div>";
      // $this->console($this->routes->URI);
    }

  }

  public function getJSON($file, $output_var)
  {
    /* Loads JSON filer and then assigns object to passed var */
    $dataJSON = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/" . $file);
    $data = json_decode($dataJSON, true, JSON_UNESCAPED_SLASHES);
    $this->$output_var = (object) $data;

    return $data;
  }

  public function component($component, $props = null)
  {
    // if ( !is_null($props)) { $props = "?" . $props; }
    $file = $_SERVER["DOCUMENT_ROOT"] . "/view/__components/component_" . $component;

    // $this->console($file,0,__LINE__);

    if (is_file($file . ".php")) {
      $result = include_once $file . ".php";
    } else {
      // $this->console("Fail");
    }

    return $result;
  }

  public function getHeaderExtras() {

    $header_html = null;

    /* Look for CSS and JS files to include */
    if(isSet($this->page->header)) {

      if(isSet($this->page->header['css'])) {
        $header_html = '<link rel="stylesheet" type="text/css" href="' . $this->page->header['css'] . '"/>';
      }

      if(isSet($this->page->header['js'])) {
        foreach($this->page->header['js'] as $jsK => $jsV) {
          $header_html .= '<script type="text/javascript" src="' . $jsV . '"></script>';
        }
      }

      if(isSet($this->page->header['font'])) {
        $header_html = '<link href="' . $this->page->header['font'] . '" rel="stylesheet">';
      }
        
    }
      
    // $this->console(htmlentities($header_html));
    return $header_html;
  }

  public function getPartial($partial, $param=null)
  {

    $this->system->$partial = (object) [];

    if (isset($param)) {
      $this->system->$partial->param = $param;
    } else {
      $this->system->$partial->param = '';
    }

    /* Check to see if the partial file has an Include Component with it */
    $file = $_SERVER["DOCUMENT_ROOT"] . "/view/__partials/partial_" . $partial;

    if (is_file($file . ".inc.php")) {
      include_once $file . ".inc.php";
    } 

    /* Include the partial file if exists */
    if (is_file($file . ".php")) {
      include_once $file . ".php";
    }

  }

  public function log_watch($log_data)
  {
    /* extract Data Array */
    extract($log_data, EXTR_PREFIX_SAME, "dup");

    /* Insert into database table: log
     /* Executes SQL and then assigns object to passed var */

    $sql ="INSERT INTO log_watch (`user_id`, `key`, `value`, `type`) VALUES ('" . $_SESSION["uid"] . "','" . $key . "','" . $value . "','" . $type . "');";
    $result = $this->mysqli->query($sql);

    if ($result == true) {
      $data["result"] = "200";
    } else {
      $data["result"] = "400";
    }

    return $data;
  }

  public function uploadFile($fileTypes = ["jpeg"], $ext = "jpg")
  {
    $uploadReady = 0;

    if (!$_POST["file_1_hidden"] || isset($_FILES["file_1"]["name"])) {
      foreach ($_FILES as $key => $value) {
        if ($value["size"] != 0) {
          $_FILES[$key]["path"] = $_POST[$key . "_path"];
          $uploadReady = 1;
        } else {
          $uploadReady = 0;
        }

        if ($_FILES[$key]["path"] == "/view/__catalog/__thumbnail/") {
          $log_loc = "Thumbnail";
        } else {
          $log_loc = "Main";
        }
        $target_file =
          $_SERVER["DOCUMENT_ROOT"] .
          $_FILES[$key]["path"] .
          $_POST["file_name"] .
          "." .
          $ext;

        if (file_exists($target_file)) {
          // $this->log_watch(array("key" => "core", "value" => "Overwriting " . $log_loc . " Photo (" . $_POST['file_name'] . '.' . $ext . ")", "type" => "warning"));
          $uploadReady = 1;

          // need to throw an overwrite flag only if $_FILES[$key]['name']
          if (isset($_FILES[$key]["name"])) {
            $uploadOverwrite = 1;
          }
        } else {
          $uploadReady = 1;
          $uploadOverwrite = 0;
        }

        // Check if $uploadReady is set to 0 by an error
        if ($uploadReady == 0) {
          $this->log_watch([
            "key" => "core",
            "value" => "Failed to Upload / uploadReady=0",
            "type" => "failure",
          ]);
        } else {
          if (move_uploaded_file($_FILES[$key]["tmp_name"], $target_file)) {
            if ($uploadOverwrite == 0) {
              $this->log_watch([
                "key" => "core",
                "value" =>
                  "Upload of " .
                  $log_loc .
                  " Image File (" .
                  $_POST["file_name"] .
                  "." .
                  $ext .
                  ")",
                "type" => "success",
              ]);
            } else {
              $this->log_watch([
                "key" => "core",
                "value" =>
                  "Overwriting " .
                  $log_loc .
                  " Photo (" .
                  $_POST["file_name"] .
                  "." .
                  $ext .
                  ")",
                "type" => "warning",
              ]);
            }
          } else {
            // $this->log_watch(array("key" => "system", "value" => "move_uploaded_file() FAILURE on line " . __LINE__, "type" => "failure"));
          }
        }
      }
    } else {
      $this->log_watch([
        "key" => "core",
        "value" => "uploadFile() SCRIPT FAILURE",
        "type" => "failure",
      ]);
    }
  }

  public function console($val,$exit = 0,$line = __LINE__,$file = __FILE__,$method = __FUNCTION__) {
    if ($this->config_env->env[$this->env]["show_console"] == "true") {
      echo "<div style='position: relative; padding: 10px; background-color: #000; color: Yellow; font-size: 1rem;'>";
      if (gettype($val) == "string") {
        echo "<p>[" . gettype($val) . "] >> " .
          " | " .
          $val .
          "<br ><span class='small lightblue'>File: " .
          $file .
          " :: " . $line . "</span></p>";
      }

      if (gettype($val) == "array" || gettype($val) == "object") {
        echo "[" . gettype($val) . "] >> " .
          $line .
          " | typeof." .
          gettype($val) .
          "<br /><span class='small lightblue'>File: " .
          $file .
          " :: " . $line . "</span><pre style='text-align: left; margin-left: 2rem; border-left: 1px solid #8900ff; padding-left: 1rem;'>";
        var_export($val);
        echo "</pre>";
        echo "JSON: " . json_encode($val);
      }
      echo "</div>";

      if ($exit == 1) {
        exit();
      }
    }
  }

  public function printp_r($value)
  {
    /* Makes a print_r dump a little easier on the brain */
    // echo "<pre style='text-align: left'>"; print_r($value); echo "</pre>";
    echo "<p style='background-color: red; color: #FFF;'>>>>>>> WARNING: " .
      __FUNCTION__ .
      " IS DEPRECATED AS OF v1.4.1 PLEASE USE THE NEW console(msg, true) METHOD</p>";
  }

  public function debugInfo()
  {
    /* Outputs some objects and arrays for debugging */
    if ($this->routes->URI->query == "debug=false") {
      return 0;
    } elseif (
      $this->config_env->env[$this->env]["debug"] == "true" ||
      $this->routes->URI->query == "debug=true"
    ) {
      $result = get_object_vars($this);

      if ($this->config_env->env[$this->env]["exclude_vars"] == "true") {
        unset($result["routes"]);
        unset($result["config_env"]);
        unset($result["mysqli"]);
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
      echo "<div class='debug_trigger' style='background-color: #000; color: Yellow; font-size: 1rem; padding: 2rem;'>";
      echo "<p style='font-size: 1rem;'>>>>>> " .
        $this->env .
        " CONSOLE --start | " .
        date("l jS \of F Y h:i:s A") .
        "</p> </div>";
      echo "<div id='debug_container' style='display:none;'>";
      $this->console($result);
      if (isset($_SESSION)) {
        $this->console($_SESSION);
      }
      echo "<hr />";
      if (isset($_POST)) {
        $this->console($_POST);
      }
      if (isset($_FILES)) {
        $this->console($_FILES);
      }
      echo "<div style='background-color: #000; color: Yellow; font-size: 1rem;'><p class='debug_trigger' style='font-size: 1rem;'>>>>>> CONSOLE --end</p></div>";
      echo "</div>";
    }
  }

  public function record_404($error)
  {
    // Commented out on 7/7/2021
    // Receiving too much email

    // $to = 'system-404@jmgalleries.com';
    // $header_from = "FROM: SysAdmin-jM Galleries <'system-core@jmgalleries.com'>";
    // $reply_to = 'system-core@jmgalleries.com';
    // $subject = '404 ' . $error;
    // $message = "The following page could not be found.\n\n{\nURI: " . $error ."\nSERVER_IP: " . $_SERVER['REMOTE_ADDR'] . "\nREFERR_URI: " . $_SERVER['HTTP_REFERER'] . "\n}";
    // $headers =  $header_from . "\r\n" . 'Reply-To: ' . $reply_to . "\r\n" . 'X-Mailer: PHP/' . phpversion() . '/SysAdmin-jM Galleries';
    // mail($to, $subject, $message, $headers);
  }
}
?>
