<?php

require_once 'model/AbstractDB.php';

class KosariceDB extends AbstractDB {

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT * "
                        . "          CONCAT(:prefix, idartikel_kosarica) as uri "
                        . "FROM kosarice "
                        . "ORDER BY idartikel_kosarica ASC", $prefix);
    }
    
   public static function getAll() {
        return parent::query("SELECT *"
                        . " FROM kosarice"
                        . " ORDER BY idartikel_kosarica ASC");
    }
    
    public static function get(array $id) {
        $x = $id["id"];
        $kosarica =  parent::query("SELECT *"
                        . " FROM kosarice"
                        . " WHERE  idstranka_kosarica = $x");
        
        return $kosarica;
    }
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO kosarice (idstranka_kosarica, idartikel_kosarica, kolicina) "
                        . " VALUES (:idstranka, :idartikel, 1)", $params);
    }
    
    public static function update(array $params) {
        return parent::modify("UPDATE kosarice SET"
                        . " kolicina = :kolicina"
                        . " WHERE idstranka_kosarica = :idstranka"
                        . " AND idartikel_kosarica = :idartikel", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM kosarice"
                . " WHERE idstranka_kosarica = :id", $id);
    }
    
    
}

