<?php

require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class ArtikelController {
    public static function index() {
        echo ViewHelper::render("view/anon-home.php", [
            "artikli" => ArtikelDB::getAll()
        ]);
    }
}
