<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
require_once("model/ProdajalecDB.php");
require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class ProdajalecRESTController {
    
    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(ProdajalecDB::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        ##$prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
        ##        . $_SERVER["REQUEST_URI"] . "/";
        ##var_dump($prefix);
        echo ViewHelper::renderJSON(ProdajalecDB::getAll());
    }
    
    
     public static function postArtikli(){
        #TODO
    }

    public static function add() {
        /*
        $_myPOST = [];
        parse_str(file_get_contents("php://input"), $_myPOST);
        ##var_dump($_myPOST);
        ##echo "-------------------------------";
        $data = filter_var_array($_myPOST, self::getRules());
        ##var_dump($data);
        
        ##$this->getRules();
        if (self::checkValues($data)) {
            $id = ProdajalecDB::insert($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "prodajalec/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
        */

        $json = file_get_contents("php://input");
        $obj = json_decode($json,TRUE);
        ProdajalecDB::insert($obj);
        echo ViewHelper::renderJSON("", 200);
    }

    public static function edit($id) {
        // spremenljivka $_PUT ne obstaja, zato jo moremo narediti sami
        /*
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, self::getRules());
        if (self::checkValues($data)) {
            $data["id"] = $id;
            
            ProdajalecDB::update($data);
            echo ViewHelper::renderJSON("", 200);
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
        */
        $json = file_get_contents("php://input");
        $obj = json_decode($json,TRUE);
        $obj['id'] = $id;
        ProdajalecDB::update($obj);
        echo ViewHelper::renderJSON("", 200);
    }

    public static function delete($id) {
        // TODO: Implementiraj delete
        // Vrni kodo 200 v primeru uspeha
        // Vrni kodo 400 v primeru napake
        try {
            ProdajalecDB::delete(["id" => $id]);
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
            'aktiviran' => FILTER_VALIDATE_INT
        ];
    }
    
}