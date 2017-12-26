<?php

require_once("model/ArtikelDB.php");
require_once("ViewHelper.php");

class ArtikliController {

    public static function index() {
        echo ViewHelper::render("view/artikel-list.php", [
            "artikli" => ArtikelDB::getAll()
        ]);
    }
   
}
