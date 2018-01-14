<?php
header("Access-Control-Allow-Origin: *");
// enables sessions for the entire app
session_start();

require_once("controller/ArtikelRESTController.php");
require_once("controller/ProdajalecRESTController.php");
require_once("controller/StrankaRESTController.php");
require_once("controller/AdminRESTController.php");
require_once("controller/NarociloRESTController.php");
require_once("controller/LoginRESTController.php");
require_once("controller/KosariceRESTController.php");
require_once("controller/OceneRESTController.php");

require_once("ViewHelper.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    # API ROUTER
    ##PRODAJALEC -> CHECKED ! ne dela POST v postmanu v windowsih
    "/^api\/prodajalci\/(\d+)$/" => function ($method, $id = null) {        
        switch ($method) {
            case "PUT":
                ProdajalecRESTController::edit($id);
                break;
            case "DELETE":
                ProdajalecRESTController::delete($id);
                break;
            default: # GET
                ProdajalecRESTController::get($id);
                break;
        }
    },
    "/^api\/prodajalci\/(\d+)\/artikli$/" => function ($method, $id = null) {        
        switch ($method) {
            case "POST":
                ProdajalecRESTController::postArtikli();
                break;
            default: # GET
                ProdajalecRESTController::getArtikli($id);
                break;
        }
    },
    "/^api\/prodajalci$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                ProdajalecRESTController::add();
                break;
            default: # GET
                ProdajalecRESTController::index();
                break;
        }
    },
    ##STRANKA  -> CHECKED ! postman ?
    "/^api\/stranke\/(\d+)$/" => function ($method, $id = null) {
        switch ($method) {
            
            case "PUT":
                
                StrankaRESTController::edit($id);
                break;
            case "DELETE":
                StrankaRESTController::delete($id);
                break;
            default: # GET
                StrankaRESTController::get($id);
                break;
        }
    },
    "/^api\/stranke$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                StrankaRESTController::add();
                break;
            default: # GET
                StrankaRESTController::index();
                break;
        }
    },
    ##Admin -> CHECKED ! postman ?
    "/^api\/admini\/(\d+)$/" => function ($method, $id = null) {        
        switch ($method) {
            case "PUT":
                AdminRESTController::edit($id);
                break;
            case "DELETE":
                AdminRESTController::delete($id);
                break;
            default: # GET
                AdminRESTController::get($id);
                break;
        }
    },
    "/^api\/admini$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                AdminRESTController::add();
                break;
            default: # GET
                AdminRESTController::index();
                break;
        }
    },
    ##AARTIKLI -> CHECKED ! postman ?
    "/^api\/artikli\/(\d+)$/" => function ($method, $id = null) {        
        switch ($method) {
            case "PUT":
                ArtikelRESTController::edit($id);
                break;
            case "DELETE":
                ArtikelRESTController::delete($id);
                break;
            default: # GET
                ArtikelRESTController::get($id);
                break;
        }
    },
    "/^api\/artikli$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                ArtikelRESTController::add();
                break;
            default: # GET
                ArtikelRESTController::index();
                break;
        }
    },
    "/^api\/artikli\/aktivirani$/" => function ($method, $id = null) {
        switch ($method) {
            default: # GET
                ArtikelRESTController::strankaIndex();
                break;
        }
    },
    ##NAROCIA -> CHECKED ! postman ?
    "/^api\/narocila\/(\d+)$/" => function ($method, $id = null) {       
        switch ($method) {
            case "PUT":
                NarociloRESTController::edit($id);
                break;
            case "DELETE":
                NarociloRESTController::delete($id);
                break;
            default: # GET
                NarociloRESTController::get($id);
                break;
        }
    },
    "/^api\/narocila$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                NarociloRESTController::add();
                break;
            default: # GET
                NarociloRESTController::index();
                break;
        }
    }, 
    ##Login -> CHECKED ! postman ?        
    "/^api\/login$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                LoginRESTController::login();
                break;
            default: # GET
                break;
        }
    },
    ##KOSARICE -> CHECKED ! postman ?
    "/^api\/kosarice\/(\d+)$/" => function ($method, $id = null) {       
        switch ($method) {
            case "PUT":
                KosariceRESTController::edit($id);
                break;
            case "DELETE":
                KosariceRESTController::delete($id);
                break;
            default: # GET
                KosariceRESTController::get($id);
                break;
        }
    },
    "/^api\/kosarice$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                KosariceRESTController::add();
                break;
            default: # GET
                KosariceRESTController::index();
                break;
        }
    },
            ##OCENE -> CHECKED ! postman ?
    "/^api\/ocene\/(\d+)$/" => function ($method, $id = null) {       
        switch ($method) {
            case "PUT":
                OceneRESTController::edit($id);
                break;
            case "DELETE":
                OceneRESTController::delete($id);
                break;
            default: # GET
                OceneRESTController::get($id);
                break;
        }
    },
    "/^api\/ocene$/" => function ($method, $id = null) {
        switch ($method) {
            case "POST":
                OceneRESTController::add();
                break;
            default: # GET
                OceneRESTController::index();
                break;
        }
    }
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

echo("NEVEM");
ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);
