<?php

// enables sessions for the entire app
session_start();

require_once("controller/ArtikelRESTController.php");
require_once("controller/ProdajalecRESTController.php");
require_once("controller/StrankaRESTController.php");
require_once("controller/AdminRESTController.php");
require_once("controller/NarociloRESTController.php");

require_once("ViewHelper.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    # HTTP router
    "/^artikli\/?(\d+)?$/" => function ($method, $id = null) {
        echo ViewHelper::render("view/artikel-list.php", []);
    },
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

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);
