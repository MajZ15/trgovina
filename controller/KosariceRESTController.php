<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
require_once("model/KosariceDB.php");
require_once("ViewHelper.php");

class KosariceRESTController {
    
    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(KosariceDB::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        ##$prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
        ##        . $_SERVER["REQUEST_URI"] . "/";
        ##var_dump($prefix);
        echo ViewHelper::renderJSON(KosariceDB::getAll());
    }

    public static function add() {
        /*
        $_myPOST = [];
        parse_str(file_get_contents("php://input"), $_myPOST);
        $data = filter_var_array($_myPOST, self::getRules());
        
        
        if (self::checkValues($data)) {
            $id = KosariceDB::insert($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "narocilo/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
         * 
         */
          
        $json = file_get_contents("php://input");
        $obj = json_decode($json,TRUE);
        KosariceDB::insert($obj);
        echo ViewHelper::renderJSON("", 200);
        
    }

    public static function edit($id) {
        /*
        // spremenljivka $_PUT ne obstaja, zato jo moremo narediti sami
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, self::getRules());
        if (self::checkValues($data)) {
            $data["id"] = $id;
            
            KosariceDB::update($data);
            echo ViewHelper::renderJSON("", 200);
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
         * 
         */
        
        $json = file_get_contents("php://input");
        $obj = json_decode($json,TRUE);
        $obj['idstranka'] = $id;
        KosariceDB::update($obj);
        echo ViewHelper::renderJSON("", 200);
    }

    public static function delete($id) {
        // TODO: Implementiraj delete
        // Vrni kodo 200 v primeru uspeha
        // Vrni kodo 400 v primeru napake
        try {
            KosariceDB::delete(["id" => $id]);
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
            
            $result = $result && ($value != null);
     
        }
       
        return $result;
    }
   
    function getRules() {
        return [
            'kolicina' => FILTER_VALIDATE_INT,
            'idstranka' => FILTER_VALIDATE_INT,
            'idartikel' => FILTER_VALIDATE_INT,
        ];
    }
    
}
