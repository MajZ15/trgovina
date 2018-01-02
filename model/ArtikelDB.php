<?php

require_once 'model/AbstractDB.php';

class ArtikelDB extends AbstractDB {
    public static function pridobiArtikleProdajalca($id){
        return parent::query("SELECT *"
                        . " FROM artikel"
                        . " WHERE prodajalec_idprodajalec = :id",$id);

    }
    
    public static function getAll() {
        return parent::query("SELECT idartikel, naziv, slika, cena, kolicina, prodajalec_idprodajalec"
                        . " FROM artikel"
                        . " ORDER BY idartikel ASC");
    }
    
    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT idartikel, naziv, slika, cena, kolicina, prodajalec_idprodajalec, "
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
        return parent::modify("INSERT INTO artikel (naziv, cena, kolicina, prodajalec_idprodajalec) "
                        . " VALUES (:naziv, :cena, :kolicina, :prodajalec_idprodajalec)", $params);
    }
    
    public static function update(array $params) {
        return parent::modify("UPDATE artikel SET naziv = :naziv, cena = :cena, kolicina = :kolicina, "
                        . "prodajalec_idprodajalec = :prodajalec_idprodajalec"
                        . " WHERE idartikel = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM artikel WHERE idartikel = :id", $id);
    }
    
    
    

}
