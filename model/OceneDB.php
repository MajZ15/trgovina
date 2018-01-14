<?php

require_once 'model/AbstractDB.php';

class OceneDB extends AbstractDB {
    // se ne uporablja
    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT * "
                        . "          CONCAT(:prefix, idartikel_ocene) as uri "
                        . "FROM ocene "
                        . "ORDER BY idartikel_ocene ASC", $prefix);
    }
   // se ne uporablja
   public static function getAll() {
        return parent::query("SELECT *"
                        . " FROM ocene"
                        . " ORDER BY idartikel_ocene ASC");
    }
    
    public static function get(array $id) {
        $x = $id["id"];
        $ocene =  parent::query("SELECT *"
                        . " FROM ocene"
                        . " WHERE idartikel_ocene = $x");
        
        return $ocene;
    }
    
    public static function getAverage(array $id) {
        $x = $id["id"];
        $ocene =  parent::query("SELECT AVG(ocena) as 'average'"
                        . " FROM ocene"
                        . " WHERE idartikel_ocene = $x");
        
        return $ocene;
    }
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO ocene (idstranka_ocene, idartikel_ocene, ocena) "
                        . " VALUES (:idstranka, :idartikel, :ocena)", $params);
    }
    
    public static function update(array $params) {
        return parent::modify("UPDATE ocene SET"
                        . " ocena = :ocena"
                        . " WHERE idstranka_ocene = :idstranka"
                        . " AND idartikel_ocene = :idartikel", $params);
    }

    public static function delete(array $params) {
        return parent::modify("DELETE FROM ocene"
                . " WHERE idstranka_ocene = :idstranka"
                . " AND idartikel_ocene = :idartikel",$params);
    }
    
    
}

