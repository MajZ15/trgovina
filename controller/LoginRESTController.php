<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
require_once("model/LoginDB.php");
require_once("ViewHelper.php");

class LoginRESTController {
    public static function login() {
        $json = file_get_contents("php://input");
        $obj = json_decode($json,TRUE);
        try {
            echo ViewHelper::renderJSON(LoginDB::get($obj));
        } catch (Exception $e) {
            echo ViewHelper::renderJSON("Napaka: {$e->getMessage()})",400);
        }
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
