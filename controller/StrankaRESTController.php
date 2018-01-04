<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
require_once("model/StrankaDB.php");
require_once("ViewHelper.php");

class StrankaRESTController {
    
    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(StrankaDB::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        ##$prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
        ##        . $_SERVER["REQUEST_URI"] . "/";
        ##var_dump($prefix);
        echo ViewHelper::renderJSON(StrankaDB::getAll());
    }

    public static function add() {
        /*
        $_myPOST = [];
        $json = file_get_contents("php://input");
        $obj = json_decode($json,TRUE);
        $id = StrankaDB::insert($obj);
        echo ViewHelper::renderJSON("", 201);
        ViewHelper::redirect(BASE_URL . "stranka/$id");
        */
        
        $json = file_get_contents("php://input");
        $obj = json_decode($json,TRUE);
        StrankaDB::insert($obj);
        echo ViewHelper::renderJSON("", 200);
        
  
        
    }

    public static function edit($id) {
        // spremenljivka $_PUT ne obstaja, zato jo moremo narediti sami
       
        $_PUT = [];
        $json = file_get_contents("php://input");
        $obj = json_decode($json,TRUE);
        $obj['id'] = $id;
        StrankaDB::update($obj);
        echo ViewHelper::renderJSON("", 200);
         /*
        if (self::checkValues($data)) {
            $data["id"] = $id;
            
            StrankaDB::update($data);
            echo ViewHelper::renderJSON("", 200);
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
         * */
         
    }

    public static function delete($id) {
        // TODO: Implementiraj delete
        // Vrni kodo 200 v primeru uspeha
        // Vrni kodo 400 v primeru napake
        try {
            StrankaDB::delete(["id" => $id]);
            echo ViewHelper::renderJSON("",200);
        } catch (Exception $e) {
            echo ViewHelper::renderJSON("Napaka: {$e->getMessage()})",400);
        }
    }
    
  
    function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }
   
    function getRules() {
        return [
            'ime' => FILTER_SANITIZE_SPECIAL_CHARS,
            'priimek' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_SPECIAL_CHARS,
            'geslo' => FILTER_SANITIZE_SPECIAL_CHARS,
            'telefon' => FILTER_SANITIZE_SPECIAL_CHARS,
            'naslov' => FILTER_SANITIZE_SPECIAL_CHARS,
            'aktiviran' => FILTER_SANITIZE_NUMBER_INT
        ];
    }
    
}