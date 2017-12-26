<?php

require_once("model/ArtikelDB.php");
require_once("controller/ArtikliController.php");
require_once("ViewHelper.php");

class ArtikliRESTController {
    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"] . "/";
        echo ViewHelper::renderJSON(ArtikelDB::getAllwithURI(["prefix" => $prefix]));
    }
}
