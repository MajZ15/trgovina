<?php

require_once 'model/AbstractDB.php';

class ArtikelDB extends AbstractDB {
    
    public static function getAll() {
        return parent::query("SELECT idartikel, naziv, opis, cena, aktiviran"
                        . " FROM artikel"
                        . " ORDER BY idartikel ASC");
    }
    
    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT idartikel, naziv, opis, cena, aktiviran, "
                        . "          CONCAT(:prefix, idartikel) as uri "
                        . "FROM artikel "
                        . "ORDER BY idartikel ASC", $prefix);
    }
    
  
    public static function get(array $id) {
        $x = $id["id"];
        $artikli =  parent::query("SELECT *"
                        . " FROM artikel"
                        . " WHERE  idartikel = $x");
        
         if (count($artikli) == 1) {
            return $artikli[0];
        } else {
            throw new InvalidArgumentException("Artikel ne obstaja!");
        }
    }
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO artikel (naziv, opis, cena, aktiviran) "
                        . " VALUES (:naziv, :opis, :cena, :aktiviran)", $params);
    }
    
    public static function update(array $params) {
        return parent::modify("UPDATE artikel SET naziv = :naziv, opis = :opis, cena = :cena, "
                        . "aktiviran = :aktiviran"
                        . " WHERE idartikel = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM artikel WHERE idartikel = :id", $id);
    }
    
    
    

}
