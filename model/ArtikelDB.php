<?php

require_once 'model/AbstractDB.php';

class ArtikelDB extends AbstractDB {
    
    public static function getAll() {
        return parent::query("SELECT idartikel, naziv, slika, cena, prodajalec_idprodajalec"
                        . " FROM artikel"
                        . " ORDER BY idartikel ASC");
    }
    
    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT idartikel, naziv, slika, cena, prodajalec_idprodajalec, "
                        . "          CONCAT(:prefix, idartikel) as uri "
                        . "FROM artikel "
                        . "ORDER BY idartikel ASC", $prefix);
    }
    

}
