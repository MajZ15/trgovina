<?php

require_once 'model/AbstractDB.php';

class ProdajalecDB extends AbstractDB {

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT idprodajalec, ime, priimek, email, geslo, aktiviran "
                        . "          CONCAT(:prefix, idprodajalec) as uri "
                        . "FROM prodajalec "
                        . "ORDER BY idprodajalec ASC", $prefix);
    }
    
   public static function getAll() {
        return parent::query("SELECT *"
                        . " FROM prodajalec"
                        . " ORDER BY idprodajalec ASC");
    }
    
    public static function get(array $id) {
        $x = $id["id"];
        $prodajalci =  parent::query("SELECT *"
                        . " FROM prodajalec"
                        . " WHERE  idprodajalec = $x");
        
         if (count($prodajalci) == 1) {
            return $prodajalci[0];
        } else {
            throw new InvalidArgumentException("Prodajalec ne obstaja!");
        }
    }
    
    public static function insert(array $params) {
        return parent::modify("INSERT INTO prodajalec (ime, priimek, email, geslo, aktiviran) "
                        . " VALUES (:ime, :priimek, :email, :geslo, :aktiviran)", $params);
    }
    
    public static function update(array $params) {
        return parent::modify("UPDATE prodajalec SET ime = :ime, priimek = :priimek, "
                        . "email = :email, geslo = :geslo, aktiviran = :aktiviran"
                        . " WHERE idprodajalec = :id", $params);
    }

    public static function delete(array $id) {
        $x = $id["id"];
        return parent::modify("DELETE FROM prodajalec WHERE idprodajalec = :id",$id);
    }
    
    
}

