<?php

require_once("model/AdminDB.php");
require_once("model/ProdajalecDB.php");
require_once("model/StrankaDB.php");
require_once("ViewHelper.php");

class LoginController {
    
    
    public static function loginForm($values = [
        "username" => "",
        "password" => "",
    ]) {
        echo ViewHelper::render("view/login.php", $values);
    }

    public static function login() {
        $data = filter_input_array(INPUT_POST, self::getRules());
        
        $admini = AdminDB::getAll();
        $prodajalci = ProdajalecDB::getAll();
        $stranke = StrankaDB::getAll();
        foreach ($admini as $admin) {
            if ($data["username"] == $admin["email"]
                    && $data["password"] == $admin["geslo"]) {
                echo ViewHelper::redirect(BASE_URL . "admin/");
            }
        }
        foreach ($prodajalci as $prodajalec) {
            if ($data["username"] == $prodajalec["email"]
                    && $data["password"] == $prodajalec["geslo"]) {
                echo ViewHelper::redirect(BASE_URL . "prodajalec/");
            }
        }
        foreach ($stranke as $stranka) {
            if ($data["username"] == $stranka["email"]
                    && $data["password"] == $stranka["geslo"]) {
                echo ViewHelper::redirect(BASE_URL . "stranka/");
            }
        }
    }
    
    public static function getRules() {
        return [
            'username' => FILTER_SANITIZE_SPECIAL_CHARS,
            'password' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }
}

