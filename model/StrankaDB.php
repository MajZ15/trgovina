<?php
class StrankaDB extends AbstractDB {
    
     public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT idstranka, ime, priimek, email, telefon, naslov, aktiviran"
                        . "          CONCAT(:prefix, idstranka) as uri "
                        . "FROM prodajalec "
                        . "ORDER BY idstranka ASC", $prefix);
    }
    
   public static function getAll() {
        return parent::query("SELECT idstranka, ime, priimek, email, telefon, naslov, aktiviran"
                        . " FROM stranka"
                        . " ORDER BY idstranka ASC");
    }
    
    public static function get(array $id) {
        $x = $id["id"];
        $stranke =  parent::query("SELECT idstranka, ime, priimek, email, telefon, naslov, aktiviran"
                        . " FROM stranka"
                        . " WHERE  idstranka = $x");
        
         if (count($stranke) == 1) {
            return $stranke[0];
        } else {
            throw new InvalidArgumentException("Stranka ne obstaja!");
        }
    }
    
    public static function insert(array $params) {
       $params["geslo"] = password_hash($params["geslo"], PASSWORD_BCRYPT);
        return parent::modify("INSERT INTO stranka (ime, priimek, email, geslo, telefon, naslov, aktiviran) "
                        . " VALUES (:ime, :priimek, :email, :geslo, :telefon, :naslov, :aktiviran)", $params);
    }
    
    public static function update(array $params) {
        $params["geslo"] = password_hash($params["geslo"], PASSWORD_BCRYPT);
        return parent::modify("UPDATE stranka SET ime = :ime, priimek = :priimek, "
                        . "email = :email, geslo = :geslo, telefon = :telefon, naslov = :naslov, aktiviran = :aktiviran"
                        . " WHERE idstranka = :id", $params);
    }

    public static function delete(array $id) {
        $x = $id["id"];
        return parent::modify("DELETE FROM stranka WHERE idstranka = :id",$id);
    }
    
    
    
    
    
    
}